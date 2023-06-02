<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Notas Controller
 *
 * @property \App\Model\Table\NotasTable $Notas
 * @method \App\Model\Entity\Nota[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotasController extends AppController
{
	public function index()
	{
		$this->paginate = [
			'contain' => ['ParentNotas', 'Users', 'Acciones'],
		];
		$notas = $this->paginate($this->Notas);

		$this->set(compact('notas'));
	}

	public function view($id = null)
	{
		$nota = $this->Notas->get($id, [
			'contain' => ['ParentNotas', 'Users', 'Acciones', 'ChildNotas'],
		]);

		$this->set(compact('nota'));
	}

	public function add($accid=null)
	{

		$nota = $this->Notas->newEmptyEntity();
		$this->Authorization->authorize($nota);

		if(is_null($accid)){
			return $this->redirect(['controller'=>'Proyectos','action' => 'index']);
		}		

		if ($this->request->is('post')) {
			$nota = $this->Notas->patchEntity($nota, $this->request->getData());
			if ($this->Notas->save($nota)) {
				$this->Flash->success(__('The nota has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The nota could not be saved. Please, try again.'));
		}
		$acc = $this->Notas->Acciones->get($accid);
		$this->set(compact('nota', 'acc'));
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Nota id.
	 * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$nota = $this->Notas->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$nota = $this->Notas->patchEntity($nota, $this->request->getData());
			if ($this->Notas->save($nota)) {
				$this->Flash->success(__('The nota has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The nota could not be saved. Please, try again.'));
		}
		$parentNotas = $this->Notas->ParentNotas->find('list', ['limit' => 200])->all();
		$users = $this->Notas->Users->find('list', ['limit' => 200])->all();
		$acciones = $this->Notas->Acciones->find('list', ['limit' => 200])->all();
		$this->set(compact('nota', 'parentNotas', 'users', 'acciones'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Nota id.
	 * @return \Cake\Http\Response|null|void Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$nota = $this->Notas->get($id);
		if ($this->Notas->delete($nota)) {
			$this->Flash->success(__('The nota has been deleted.'));
		} else {
			$this->Flash->error(__('The nota could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
