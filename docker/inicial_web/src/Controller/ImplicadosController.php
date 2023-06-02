<?php
declare(strict_types=1);

namespace App\Controller;

class ImplicadosController extends AppController
{

	public function index()
	{
		$this->paginate = [
			'contain' => ['Acciones', 'Tecnicos'],
		];
		$implicados = $this->paginate($this->Implicados);

		$this->set(compact('implicados'));
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
		$tecnico->usrid = $user->id;
		
		return $tecnico;
	}

	public function view($id = null)
	{
		$implicado = $this->Implicados->get($id, [
			'contain' => ['Acciones', 'Tecnicos'],
		]);

		$this->set(compact('implicado'));
	}

	public function add()
	{
		$implicado = $this->Implicados->newEmptyEntity();
		if ($this->request->is('post')) {
			$implicado = $this->Implicados->patchEntity($implicado, $this->request->getData());
			if ($this->Implicados->save($implicado)) {
				$this->Flash->success(__('The implicado has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The implicado could not be saved. Please, try again.'));
		}
		$acciones = $this->Implicados->Acciones->find('list', ['limit' => 200]);
		$tecnicos = $this->Implicados->Tecnicos->find('list', ['limit' => 200]);
		$this->set(compact('implicado', 'acciones', 'tecnicos'));
	}

	public function edit($id = null)
	{
		$tech = $this->dameUserTec();
		
		$implicado = $this->Implicados->get($id, [
			'contain' => [],
		]);
		$implicado->tech = $tech;
		$this->Authorization->authorize($implicado);
		
		if ($this->request->is(['patch', 'post', 'put'])) {
			$implicado = $this->Implicados->patchEntity($implicado, $this->request->getData());
			if ($this->Implicados->save($implicado)) {
				$this->Flash->success(__('The implicado has been saved.'));

				return $this->redirect(['controller'=>'Users', 'action' => 'panel']);
			}
			$this->Flash->error(__('The implicado could not be saved. Please, try again.'));
		}
		$acciones = $this->Implicados->Acciones->find('list', ['limit' => 200]);
		$tecnicos = $this->Implicados->Tecnicos->find('list', ['limit' => 200]);
		$this->set(compact('implicado', 'acciones', 'tecnicos'));
	}

	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$implicado = $this->Implicados->get($id);
		if ($this->Implicados->delete($implicado)) {
			$this->Flash->success(__('The implicado has been deleted.'));
		} else {
			$this->Flash->error(__('The implicado could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
