<?php
declare(strict_types=1);

namespace App\Controller;


class ProyectosController extends AppController
{

	public function index()    {	 
	//$this->Authorization->skipAuthorization(); // no Auth

	$tecnico = $this->dameUserTec();
	
	$user = $this->request->getAttribute('identity');
	
	$query = $user->applyScope('user', $this->Proyectos->find('all',  [
			'contain' => ['Delegaciones', 'Delegaciones.Tecnicos','Delegaciones.Tecnicos.Users', 'Empresas'],
			'conditions' => ['Proyectos.delegacione_id' => $tecnico->delegacione_id,],
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
	
	foreach($proyecto->avances as $av){
		$algun_rojo_en_acciones = false;
		foreach($av->acciones as $acc){
			if( !$acc->realizada && $acc->critico) $algun_rojo_en_acciones = true;
			$acc->semaforos = [];
			$ta = $this->busca_en($ttareas, 'codigo', $acc->code);
			if( !is_null($ta) ){ // tenemos limitantes
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
						array_push($acc->semaforos, $sema);
					} 
				}
			}
		} // fin foreach acciones
		if( !$algun_rojo_en_acciones) {
			$av->completado = 1;
		}else{
			$av->completado = 0;
		}
		$this->Proyectos->Avances->save($av);
	} // fin foreach avances
	
	
	$this->set('avances',$proyecto->avances);
//        $this->set(compact('proyecto', 'ttareas','tacc'));
		$this->set(compact('proyecto'));
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
		$proyecto = $this->Proyectos->newEmptyEntity();
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

	/**
	 * Edit method
	 *
	 * @param string|null $id Proyecto id.
	 * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
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

	/**
	 * Delete method
	 *
	 * @param string|null $id Proyecto id.
	 * @return \Cake\Http\Response|null|void Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$proyecto = $this->Proyectos->get($id);
		if ($this->Proyectos->delete($proyecto)) {
			$this->Flash->success(__('The proyecto has been deleted.'));
		} else {
			$this->Flash->error(__('The proyecto could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
