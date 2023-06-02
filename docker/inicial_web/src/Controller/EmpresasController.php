<?php
declare(strict_types=1);

namespace App\Controller;

class EmpresasController extends AppController
{
	public function index()
	{
		$this->Authorization->skipAuthorization(); // no Auth
		
		$empresas = $this->paginate($this->Empresas);

		$this->set(compact('empresas'));
	}

	public function view($id = null)
	{
		$empresa = $this->Empresas->get($id, [
			'contain' => ['Contactos', 'Proyectos', 'Proyectos.Delegaciones'],
		]);
		$this->Authorization->authorize($empresa);

		$this->set(compact('empresa'));
	}

	public function add()
	{
		$empresa = $this->Empresas->newEmptyEntity();
		$this->Authorization->authorize($empresa);
		
		if ($this->request->is('post')) {
			$empresa = $this->Empresas->patchEntity($empresa, $this->request->getData());
			if ($this->Empresas->save($empresa)) {
				$this->Flash->success(__('The empresa has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The empresa could not be saved. Please, try again.'));
		}
		$this->set(compact('empresa'));
	}

	public function edit($id = null)
	{
		$empresa = $this->Empresas->get($id, [
			'contain' => [],
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$empresa = $this->Empresas->patchEntity($empresa, $this->request->getData());
			if ($this->Empresas->save($empresa)) {
				$this->Flash->success(__('The empresa has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The empresa could not be saved. Please, try again.'));
		}
		$this->set(compact('empresa'));
	}

	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$empresa = $this->Empresas->get($id);
		if ($this->Empresas->delete($empresa)) {
			$this->Flash->success(__('The empresa has been deleted.'));
		} else {
			$this->Flash->error(__('The empresa could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
