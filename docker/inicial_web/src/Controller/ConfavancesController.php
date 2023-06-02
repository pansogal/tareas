<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Confavances Controller
 *
 * @property \App\Model\Table\ConfavancesTable $Confavances
 * @method \App\Model\Entity\Confavance[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConfavancesController extends AppController
{
	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|null|void Renders view
	 */
	public function index()
	{
		$this->Authorization->skipAuthorization(); // no Auth
		$tech = $this->dameUserTec();
				
		// cogemos todos
		$todos = $this->Confavances->find('all',[
			'contain' => ['Tareas'],
			'conditions' => ['Confavances.id >'=>1, ],
		])->all();
		
		// buscamos los principios, con NULL
		$iniciales = $this->Confavances->find('all',[
			'contain' => ['Tareas'],
			'conditions' => ['Confavances.id >'=>1, 'parent_id IS' => NULL],
		])->all();
		
		foreach($iniciales as $ini){
			$ini->hijos= $this->rellena($ini, $todos);
		}
		
		$arbol = $this->Confavances->find('treeList',[
			'contain' => ['Tareas'],
			'conditions' => ['Confavances.id >'=>1, ],
		])->toArray();
		
		$this->set(compact('iniciales', 'arbol', 'tech'));
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


	// dado un avance, rellena sus hijos a partir de un array
	private function rellena($uno, $todos){
		$hijos = $this->busca_multiple_en($todos, 'parent_id', $uno->id);
		foreach($hijos as $hijo){
			$hijo->hijos = $this->rellena($hijo, $todos);
		}
		return $hijos;
	}

	// BUSCADOR ///////////////////////////
	private function busca_en ( $array, $key, $value ){
		foreach($array as $obj){
			if( $obj->$key  == $value) return $obj;
		}
		return null;
	}
	
	// BUSCADOR  MULTIPLE ///////////////////////////
	private function busca_multiple_en ( $array, $key, $value ){
		$valores=[];
		foreach($array as $obj){
			if( $obj->$key  == $value) array_push($valores, $obj);
		}
		return $valores;
	}
	
	public function asigna($cavid=null, $tid=null){
		$tech = $this->dameUserTec();
		if($tech->user != 1){
			$this->Flash->error('No estás autorizado para reasignar la configuración de avances');
			return $this->redirect(['action' => 'index']);
		}
		
		// tareas no asignadas
		$this->loadModel('Tareas');
		$libres = $this->Tareas->find('all',[
			'conditions' => ['confavance_id'=>1, ],
			'order' =>['codigo' => 'ASC'],
		])->all();
		
		$cavance =  $this->Confavances->get($cavid,[
			'contain' => ['Tareas'],
		]);
		$this->Authorization->authorize($cavance);

		
		if( !is_null($tid) ){ // hay una asignación
			// comprobar si es de las libres
			$eslibre = $this->busca_en($libres, 'id', $tid);
			if( !is_null($eslibre) ){ // es una libre, asignamos
				$tarea = $this->Tareas->get($tid);
				$tarea->confavance_id = $cavid;
				$this->Tareas->save($tarea);
			}
			// comprobar si ya estaba asignada, para liberar
			$estaba = $this->busca_en($cavance->tareas, 'id', $tid);
			if( !is_null($estaba) ){ // es una libre, asignamos
				$tarea = $this->Tareas->get($tid);
				$tarea->confavance_id = 1;
				$this->Tareas->save($tarea);
			}
			
			//reset 
			return $this->redirect(['action' => 'asigna', $cavid]);
		}
		
		$this->set(compact('libres', 'cavance'));
		
	}
	
	/**
	 * View method
	 *
	 * @param string|null $id Confavance id.
	 * @return \Cake\Http\Response|null|void Renders view
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$confavance = $this->Confavances->get($id, [
			'contain' => ['ParentConfavances', 'ChildConfavances', 'Tareas'],
		]);

		$this->set(compact('confavance'));
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$confavance = $this->Confavances->newEmptyEntity();
		$this->Authorization->authorize($confavance);

		if ($this->request->is('post')) {
			$confavance = $this->Confavances->patchEntity($confavance, $this->request->getData());
			if ($this->Confavances->save($confavance)) {
				$this->Flash->success(__('The confavance has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The confavance could not be saved. Please, try again.'));
		}
		$parentConfavances = $this->Confavances->ParentConfavances->find('list', ['limit' => 200]);
		$this->set(compact('confavance', 'parentConfavances'));
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Confavance id.
	 * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$confavance = $this->Confavances->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$confavance = $this->Confavances->patchEntity($confavance, $this->request->getData());
			if ($this->Confavances->save($confavance)) {
				$this->Flash->success(__('The confavance has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The confavance could not be saved. Please, try again.'));
		}
		$parentConfavances = $this->Confavances->ParentConfavances->find('list', ['limit' => 200]);
		$this->set(compact('confavance', 'parentConfavances'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Confavance id.
	 * @return \Cake\Http\Response|null|void Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$confavance = $this->Confavances->get($id);
		if ($this->Confavances->delete($confavance)) {
			$this->Flash->success(__('The confavance has been deleted.'));
		} else {
			$this->Flash->error(__('The confavance could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
