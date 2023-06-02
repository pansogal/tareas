<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tecnicos Controller
 *
 * @property \App\Model\Table\TecnicosTable $Tecnicos
 * @method \App\Model\Entity\Tecnico[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TecnicosController extends AppController
{
	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|null|void Renders view
	 */
	public function index($deleid=null)
	{
	$this->Authorization->skipAuthorization(); // no Auth
	$tecnico = $this->dameUserTec();
	   if(!is_null( $deleid) ){
		   $cond = ['delegacione_id' =>$deleid,];
		   $dele = $this->Tecnicos->Delegaciones->get($deleid);
		   $this->set('dele', $dele);
	   }else $cond=[];
		$this->paginate = [
			'contain' => ['Delegaciones', 'Tareas'],
			'conditions' => $cond,
		];
		$tecnicos = $this->paginate($this->Tecnicos);

		$this->set(compact('tecnicos', 'tecnico'));
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


	/**
	 * View method
	 *
	 * @param string|null $id Tecnico id.
	 * @return \Cake\Http\Response|null|void Renders view
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$tecnico = $this->Tecnicos->get($id, [
			'contain' => ['Delegaciones', 'Asignados', 'Implicados'],
		]);

		$this->set(compact('tecnico'));
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$tecnico = $this->Tecnicos->newEmptyEntity();
		$this->Authorization->authorize($tecnico);
		
		if ($this->request->is('post')) {
			$tecnico = $this->Tecnicos->patchEntity($tecnico, $this->request->getData());
			if ($this->Tecnicos->save($tecnico)) {
				$this->Flash->success(__('The tecnico has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The tecnico could not be saved. Please, try again.'));
		}
		$delegaciones = $this->Tecnicos->Delegaciones->find('list', ['limit' => 200]);
		$this->set(compact('tecnico', 'delegaciones'));
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Tecnico id.
	 * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$tech = $this->dameUserTec();
		
		$tecnico = $this->Tecnicos->get($id, [
			'contain' => ['Users'],
		]);
		$tecnico->tech = $tech;
		
		//$this->Flash->success('user_tec: '.$tech->id." tecnico: ".$tecnico->id);

		if($tecnico->id  != $tech->id && $tech->user != 1){
			$this->Flash->error($tecnico->nombre.' no eres tú, no puedes modificar los datos de otros.');
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Authorization->authorize($tecnico);
		
		if ($this->request->is(['patch', 'post', 'put'])) {
			$tecnico_c = $tecnico->central;
			$tecnico_d = $tecnico->delegacione_id;
			
			$tecnico = $this->Tecnicos->patchEntity($tecnico, $this->request->getData());
			if( $tech->user != 1 && ($tecnico_c != $tecnico->central || $tecnico_d != $tecnico->delegacione_id) ){
				$this->Flash->error('No puedes cambiar las pertenencia a las delegaciones');
				return $this->redirect(['action' => 'edit', $id]);
			}
			if ($this->Tecnicos->save($tecnico)) {
				$this->Flash->success(__('The tecnico has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The tecnico could not be saved. Please, try again.'));
		}
		$delegaciones = $this->Tecnicos->Delegaciones->find('list', ['limit' => 200]);
		$this->set(compact('tecnico', 'tech','delegaciones'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Tecnico id.
	 * @return \Cake\Http\Response|null|void Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$tecnico = $this->Tecnicos->get($id);
		if ($this->Tecnicos->delete($tecnico)) {
			$this->Flash->success(__('The tecnico has been deleted.'));
		} else {
			$this->Flash->error(__('The tecnico could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
