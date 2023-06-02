<?php
declare(strict_types=1);

namespace App\Controller;


class ProyectosController extends AppController
{

	public function index()    {	 
	//$this->Authorization->skipAuthorization(); // no Auth

	$tecnico = $this->dameUserTec();
	
	$user = $this->request->getAttribute('identity');
	if($tecnico->central || $user->id == 1 ){ // está en todas las delegaciones
		$cond = [];
	}else{
		$cond = ['Proyectos.delegacione_id' => $tecnico->delegacione_id,];
	}
	
	$query = $user->applyScope('user', $this->Proyectos->find('all',  [
			'contain' => ['Delegaciones', 'Delegaciones.Tecnicos','Delegaciones.Tecnicos.Users', 'Empresas'],
			'conditions' => $cond,
		]));
	
	$proyectos = $this->paginate($query);

		$this->set(compact('proyectos','tecnico'));
	}

	// devuelve el técnico correspondiente al user logeado
	private function dameUserTec(){
		$user = $this->request->getAttribute('identity');
	
		$this->loadModel('Users');
		$miquery = $user->applyScope('tecnico', $this->Users->find('all',  [
			'contain' => ['Tecnicos'],
		]));
		$datos = $miquery->first();
		$tecnico = $datos->tecnico;
		return $tecnico;
	}
	
	public function view($id = null)    {
		//$this->Authorization->skipAuthorization(); // no Auth
		
		$tecnico = $this->dameUserTec();

		$proyecto = $this->Proyectos->get($id, [
			'contain' => ['Delegaciones', 'Empresas', 'Avances', 'Avances.Acciones',  'Avances.Acciones.Tecnicos', 'Avances.Acciones.Tecnicos.Delegaciones', 'Valores', 'Valores.Parametros'],
		]);
		$proyecto->tecnico = $tecnico;
		
		$this->Authorization->authorize($proyecto, 'view');
		
		// obtenemos los semáforos en acciones 
		$tactrl = new TareasController;
		$ttareas = $tactrl->traspone();
		$this->set('limitantes', $ttareas->last()->limitantes);

	// todas las acciones
	$tacc = [];
	foreach($proyecto->avances as $av){
		foreach($av->acciones as $acc){
			array_push($tacc, $acc);
		}
	}
	$this->loadModel('Acciones');
	foreach($proyecto->avances as $av){
		$algun_rojo_en_acciones = false;
		foreach($av->acciones as $acc){
			if( !$acc->realizada && $acc->critico) $algun_rojo_en_acciones = true;
			$acc->semaforos = [];
			$ta = $this->busca_en($ttareas, 'codigo', $acc->code);
			if( !is_null($ta) ){ // tenemos limitantes // capturamos semáforos para cada acción
				$acc->limitantes = $ta->limitantes;
				foreach($acc->limitantes as $tlimi){
					// busco las acciones
					$at = $this->busca_en($tacc, 'code', $tlimi->codigo);
					//$at = $this->busca_en($tacc, 'code', $tlimi->_joinData->noantesde->codigo);
					if( !is_null($at) ){
						$sema['accid'] = $at->id;
						$sema['accion'] = $at->accion;
						$sema['code'] = $at->code;
						$sema['realizada'] = $at->realizada;
						$sema['color'] = $at->color;
						array_push($acc->semaforos, $sema);
					} 
				}
			} 
			// marcamos luzverde la acción si sus semáforos son verdes
			$verde = true;
			foreach($acc->semaforos as $sema){
				$verde &= $sema['realizada'];
			}
			if($acc->luzverde != $verde){
				$acc->luzverde = $verde;
				$this->Acciones->save($acc);
			}
			
		} // fin foreach acciones
		if( !$algun_rojo_en_acciones) {
			$av->completado = 1;
		}else{
			$av->completado = 0;
		}
		$this->Proyectos->Avances->save($av);
	} // fin foreach avances
	
	$proyecto->gantt = $this->creaGantt($proyecto, $tacc);  // $tacc = todas las acciones
	
	$this->set('avances',$proyecto->avances);
//        $this->set(compact('proyecto', 'ttareas','tacc'));
	$this->set(compact('proyecto'));
}
	
	// Obtiene la estructura para tener luego el gráfico gantt
	//
	private function creaGantt($proy=null, $tacc=null){ // $tacc = todas las acciones
		$tasks = [];
		foreach($proy->avances as $av){
			foreach($av->acciones as $acc){
				$ana = $this->genFechasGantt($acc, $tacc);
				$tar['id'] = $acc->code;
				$tar['name']='/'.$acc->code.'/ '.$acc->accion;
				
				if( !is_null($acc->iniciada) ){ // existe inicio
					$tar['start'] = $acc->iniciada;
					if( !is_null($acc->finalizada) ) $tar['end'] = $acc->finalizada;
					else{
						if( !is_null($ana) ){ // preferencia el análisis
							$tar['end'] = $ana->addDays($acc->dura_prevista);
						}else{
							$tar['end'] = $tar['start']->addDays($acc->dura_prevista);
						}
					}
				}else { // no existe inicio
					if( !is_null($ana) ){
						$tar['start'] = $ana;
						$tar['end'] = $ana->addDays($acc->dura_prevista);
					}
				}
				
				
				/*else if( !is_null($acc->iniciada) ){
					 $tar['end'] = $acc->iniciada->addDays($acc->dura_prevista);
				 }*/
				if($acc->realizada) $tar['progress']=100;
				else $tar['progress']=0;
				
				foreach($acc->semaforos as $sema){
					if( isset($depen) ) $depen.=',';
					else $depen='';
					$depen.=$sema['code'];
				}
				if( isset($depen) ){
					$tar['dependencies'] = $depen;
				}
				array_push($tasks, $tar);
				$acc->task = $tar;
				unset($depen);
			}
		}
		return json_encode($tasks);
	}
	
	// Generador de fechas para el gráfico Gantt
	private function genFechasGantt($acc, $acciones){ 
		$res = null;
		// busca las tareas limitantes dentro de $acciones
		foreach($acc->limitantes as $li){ // li es una tarea
			$cual =  $this->busca_en ( $acciones, 'code', $li->codigo ); // cual es acción, con el mismo código/code
			if( !is_null($cual) ){
				$ini = !is_null($cual->iniciada);
				$fin = !is_null($cual->finalizada);
				if( $ini & $fin){ // hay principio y fin
					// el fin marca el mínimo comienzo para la accion
					if( !is_null($res) ){
						if($cual->finalizada > $res ) { $res = $cual->finalizada; }
					} else $res = $cual->finalizada;
				}
				else if( $ini & !$fin){ // hay principio pero no ha finalizado
					// le sumamos los días previstos típicos antes de comparar
					$comp = $cual->iniciada->addDays($cual->dura_prevista); // añadimos los días previsibles
					if( !is_null($res ) ){
						if($comp > $res ) { $res = $comp; }
					} else $res = $comp;
				}else{ // no hay ninguna fecha en el limitante, necesitamos la planificación preemptiva (con las tasks)
					if( !is_null($cual->task) ){ // ha sido establecida previamente, es lo esperable
						$ini = !is_null($cual->task['start']);
						$fin = !is_null($cual->task['end']);
						if( $ini & $fin){ // hay principio y fin en la task
							// el fin marca el mínimo comienzo para la accion
							if( !is_null($res ) ){
								if( $cual->task['end'] > $res ) { $res = $cual->task['end']; }
							} else $res = $cual->task['end'];
						} // else{} no es posible que haya algo diferente
					}
				} // fin no hay fecha alguna real en el limitante 
			} // fin existe acción correspondiente a tarea
			else{
				$this->Flash->error('Error al ancontrar acc con code="'.$li->codigo.'"' );
			}
		} // fin recorrido limitantes
		return $res;
	}


	// BUSCADOR ///////////////////////////
	private function busca_en ( $array, $key, $value ){
		foreach($array as $obj){
			if( $obj->$key  == $value) return $obj;
		}
		return null;
	}

	public function parametros($id) {
		$proyecto = $this->Proyectos->get($id, [
		'contain' => ['Delegaciones', 'Empresas', 'Avances', 'Parametros'],
		]);

		$this->set(compact('proyecto'));
	}

	public function add()
	{
		$this->Authorization->skipAuthorization(); // no Auth
		$user = $this->request->getAttribute('identity');
		if( $user->id != 1 ){
			$this->Flash->error('Tu usuario no está autorizado a crear nuevo proyecto');
			return $this->redirect(['action' => 'index']);
		}
		
		$proyecto = $this->Proyectos->newEmptyEntity();
		$this->Authorization->authorize($proyecto);

		if ($this->request->is('post')) {
			$proyecto = $this->Proyectos->patchEntity($proyecto, $this->request->getData());
			if ($this->Proyectos->save($proyecto)) {
				$this->Flash->success(__('The proyecto has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The proyecto could not be saved. Please, try again.'));
		}
		$delegaciones = $this->Proyectos->Delegaciones->find('list', ['limit' => 200]);
		$empresas = $this->Proyectos->Empresas->find('list', ['limit' => 200]);
		$this->set(compact('proyecto', 'delegaciones', 'empresas'));
	}

	public function edit($id = null)
	{
		$proyecto = $this->Proyectos->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$proyecto = $this->Proyectos->patchEntity($proyecto, $this->request->getData());
			if ($this->Proyectos->save($proyecto)) {
				$this->Flash->success(__('The proyecto has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The proyecto could not be saved. Please, try again.'));
		}
		$delegaciones = $this->Proyectos->Delegaciones->find('list', ['limit' => 200]);
		$empresas = $this->Proyectos->Empresas->find('list', ['limit' => 200]);
		$this->set(compact('proyecto', 'delegaciones', 'empresas'));
	}

	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$proyecto = $this->Proyectos->get($id, [
			'contain' => ['Delegaciones', 'Empresas', 'Avances', 'Avances.Acciones',  'Avances.Acciones.Tecnicos', 'Avances.Acciones.Tecnicos.Delegaciones', 'Valores', 'Valores.Parametros'],
		]);
		$this->Authorization->authorize($proyecto);
		
		// borramos los avances y acciones
		foreach($proyecto->avances as $av){
			foreach($av->acciones as $acc){
				if( $this->Proyectos->Avances->Acciones->delete($acc) ) {
					//$this->Flash->success('accion borrada');
				}else{
					//$this->Flash->error('no pude borrar acción');
				}
			} // fin recorre acciones
			if( $this->Proyectos->Avances->delete($av) ) {
				//$this->Flash->success('accion borrada');
			}else{
				//$this->Flash->error('no pude borrar acción');
			}
		} // fin recorre avances
		
		if ($this->Proyectos->delete($proyecto)) {
			$this->Flash->success(__('The proyecto has been deleted.'));
		} else {
			$this->Flash->error(__('The proyecto could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
