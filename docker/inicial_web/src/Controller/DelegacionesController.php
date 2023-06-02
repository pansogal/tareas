<?php
declare(strict_types=1);

namespace App\Controller;


class DelegacionesController extends AppController
{
	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|null|void Renders view
	 */
	public function index()
	{
		$this->Authorization->skipAuthorization(); // no Auth
		$tecnico = $this->dameUserTec();
		
		$delegaciones = $this->paginate($this->Delegaciones);

		$this->set(compact('delegaciones', 'tecnico'));
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
	 * @param string|null $id Delegacione id.
	 * @return \Cake\Http\Response|null|void Renders view
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$tecnico = $this->dameUserTec();
		
		$delegacione = $this->Delegaciones->get($id, [
			'contain' => ['Proyectos', 'Proyectos.Empresas'],
		]);
		$delegacione->tecnico = $tecnico;
		
		if($delegacione->id  != $tecnico->delegacione_id && $tecnico->user != 1){
			$this->Flash->error($delegacione->delegacion.' no es tu delegación, no puedes listar los proyectos');
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Authorization->authorize($delegacione);

		$this->set(compact('delegacione', 'tecnico'));
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$delegacione = $this->Delegaciones->newEmptyEntity();
		$this->Authorization->authorize($delegacione);
		
		if ($this->request->is('post')) {
			$delegacione = $this->Delegaciones->patchEntity($delegacione, $this->request->getData());
			if ($this->Delegaciones->save($delegacione)) {
				$this->Flash->success(__('The delegacione has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The delegacione could not be saved. Please, try again.'));
		}
		$this->set(compact('delegacione'));
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Delegacione id.
	 * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$delegacione = $this->Delegaciones->get($id, [
			'contain' => [],
		]);
		$this->Authorization->authorize($delegacione);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$delegacione = $this->Delegaciones->patchEntity($delegacione, $this->request->getData());
			if ($this->Delegaciones->save($delegacione)) {
				$this->Flash->success(__('The delegacione has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The delegacione could not be saved. Please, try again.'));
		}
		$this->set(compact('delegacione'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Delegacione id.
	 * @return \Cake\Http\Response|null|void Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$delegacione = $this->Delegaciones->get($id);
		if ($this->Delegaciones->delete($delegacione)) {
			$this->Flash->success(__('The delegacione has been deleted.'));
		} else {
			$this->Flash->error(__('The delegacione could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
