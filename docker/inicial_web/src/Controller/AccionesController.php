<?php
declare(strict_types=1);

namespace App\Controller;


class AccionesController extends AppController
{

	public function index()  {
		$tecnico = $this->dameUserTec();
		$user = $this->request->getAttribute('identity');
		$user->tecnico = $tecnico;
		
		$this->loadModel('Proyectos');
		$query = $user->applyScope('actividades', $this->Proyectos->find('all',  [
			'contain' => ['Avances', 'Avances.Acciones', 'Avances.Acciones.Tecnicos' ],
			//'conditions' => $cond,
		]));

		$actis = $this->paginate($query);

		$this->set(compact('actis'));
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
		$tecnico->user = $datos->id;
		return $tecnico;
	}

	public function view($id = null) {
		$accione = $this->Acciones->get($id, [
			'contain' => ['Avances', 'Tecnicos'],
		]);

		$this->set(compact('accione'));
	}

	public function add() {
		$accione = $this->Acciones->newEmptyEntity();
		if ($this->request->is('post')) {
			$accione = $this->Acciones->patchEntity($accione, $this->request->getData());
			if ($this->Acciones->save($accione)) {
				$this->Flash->success(__('The accione has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The accione could not be saved. Please, try again.'));
		}
		$avances = $this->Acciones->Avances->find('list', ['limit' => 200]);
		$tecnicos = $this->Acciones->Tecnicos->find('list', ['limit' => 200]);
		$this->set(compact('accione', 'avances', 'tecnicos'));
	}

	public function implicar($aid=null, $proid=null){
		// el proyecto
		$this->loadModel('Proyectos');
		$proyecto = $this->Proyectos->get($proid,[
			'contain' =>['Delegaciones'],
		]);
		
		// la acción
		 $accion = $this->Acciones->get($aid, [
			'contain' => ['Avances', 'Tecnicos',  'Tecnicos.Delegaciones'],
		]);

		// Asignables
		$this->loadModel('Tareas');
		$tarea = $this->Tareas->find('all',[
				'contain' => ['Tecnicos', 'Tecnicos.Acciones', 'Tecnicos.Delegaciones'],
				'conditions' => ['codigo' =>$accion->code, ], 
			])->first();
		$usados = [];
		foreach($accion->tecnicos as $atec){
			array_push($usados, $atec);
		}
		// técnicos de la acción (tarea) habilitados. sin incluir los asignados ya a la acción
		$tdeles = []; 
		foreach($tarea->tecnicos as $ttec){
			$busco = $this->busca_en($usados, 'id', $ttec->id);
			if( is_null($busco) ){ // no usado
				array_push($usados, $ttec);
				array_push($tdeles, $ttec);
			}
		}
		// otros técnicos de cualquier delegación no clasificados antes
		$techs = [];
		 $this->loadModel('Tecnicos');
		 $tecnicos = $this->Tecnicos->find('all',  [
				'contain' => ['Delegaciones',],
				'order' =>['Delegaciones.id' => 'ASC'],
			])->all();
		foreach($tecnicos as $te){
			$busco = $this->busca_en($usados, 'id', $te->id);
			if( is_null($busco) ){ // no usado
				array_push($usados, $te);
				array_push($techs, $te);
			}
		}
		 
		
		$this->set(compact('proyecto', 'accion', 'tarea', 'tdeles', 'techs' ));
	}
	
	// Asignar un técnico a una acción
	public function asignar($tid=null, $aid=null) {
		// la acción
		 $accion = $this->Acciones->get($aid, [
			'contain' => ['Avances', 'Tecnicos',  'Tecnicos.Delegaciones'],
		]);
		
		// mirar si ya estuviera asignado
		$busco = $this->busca_en($accion->tecnicos, 'id', $tid);
		if( is_null($busco) ){ // no usado, creo
			$this->loadModel('Implicados');
			$impli = $this->Implicados->newEmptyEntity();
			$impli->accione_id = $aid;
			$impli->tecnico_id = $tid;
			$this->Implicados->save($impli);
		}
		
		return $this->redirect(['action' => 'implicar', $accion->id, $accion->avance->proyecto_id]);
	}
	
	// retirar la implicación de un técnico
	public function desimplicar($tid=null, $aid=null){
		// la acción
		 $accion = $this->Acciones->get($aid, [
			'contain' => ['Avances', 'Tecnicos',  'Tecnicos.Delegaciones'],
		]);
		
		// busco el registro
		$this->loadModel('Implicados');
		$cual = $this->Implicados->find('all',[
			'conditions' => ['accione_id' => $aid, 'tecnico_id' =>$tid],
		])->first();
		if( !is_null($cual) ){
			$this->Implicados->delete($cual);
		}
		return $this->redirect(['action' => 'implicar', $accion->id, $accion->avance->proyecto_id]);
		
	}
	
		// BUSCADOR ///////////////////////////
	private function busca_en ( $array, $key, $value ){
		foreach($array as $obj){
			if( $obj->$key  == $value) return $obj;
		}
		return null;
	}

	public function edit($id = null, $proid=null) {
	

		$accione = $this->Acciones->get($id, [
			'contain' => ['Tecnicos', 'Avances', 'Notas'],
		]);
	   $tech = $this->dameUserTec();
	$accione->usertec = $tech;
		$autorizado=false;
		foreach($accione->tecnicos as $asignado){
		if( $accione->usertec->id == $asignado->id) $autorizado=true;
	}
	if(!$autorizado  && $tech->user != 1){
		$this->Flash->error($tech->nombre.', No puedes cambiar la acción "'.$accione->accion.'", no estás asignado a ella.');
		return $this->redirect(['controller'=>'Proyectos', 'action' => 'view', $accione->avance->proyecto_id]);
	}
	
	$this->Authorization->authorize($accione);
		
		if ($this->request->is(['patch', 'post', 'put'])) {
			$accione = $this->Acciones->patchEntity($accione, $this->request->getData());
			if( !is_null($accione->iniciada) && !is_null($accione->finalizada) ){
			 $accione->realizada = 1;
		 }else{
			 $accione->realizada = 0;
		 }
			if ($this->Acciones->save($accione)) {
				$this->Flash->success(__('The accione has been saved.'));
		 if( !is_null($proid) ){
			 return $this->redirect(['controller'=>'Proyectos', 'action' => 'view', $proid]);
		 }
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The accione could not be saved. Please, try again.'));
		}
		$avances = $this->Acciones->Avances->find('list', ['limit' => 200]);
		$tecnicos = $this->Acciones->Tecnicos->find('list', ['limit' => 200]);
		$this->set(compact('accione', 'avances', 'tecnicos'));
	}

	public function delete($id = null)  {
		$this->request->allowMethod(['post', 'delete']);
		$accione = $this->Acciones->get($id);
		if ($this->Acciones->delete($accione)) {
			$this->Flash->success(__('The accione has been deleted.'));
		} else {
			$this->Flash->error(__('The accione could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
