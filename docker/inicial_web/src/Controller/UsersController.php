<?php
declare(strict_types=1);

namespace App\Controller;


class UsersController extends AppController
{
	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|null|void Renders view
	 */
	public function index()
	{
		$this->Authorization->skipAuthorization(); // no Auth

		$this->paginate = [
			'contain' => ['Tecnicos'],
		];
		$users = $this->paginate($this->Users);

		$this->set(compact('users'));
	}

	/**
	 * View method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Http\Response|null|void Renders view
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$user = $this->Users->get($id, [
			'contain' => ['Tecnicos'],
		]);
		$this->Authorization->authorize($user);
		$this->set(compact('user'));
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$user = $this->Users->newEmptyEntity();
		$this->Authorization->authorize($user);
		
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			//$this->Authorization->authorize($user);
			if ($this->Users->save($user)) {
				$this->Flash->success(__('The user has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
		 $tecnicos = $this->Users->Tecnicos->find('list', ['limit' => 200])->all();
		$this->set(compact('user', 'tecnicos'));
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$user = $this->Users->get($id, [
			'contain' => ['Tecnicos'],
		]);

		$this->Authorization->authorize($user);

		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			$this->Authorization->authorize($user);
			if ($this->Users->save($user)) {
				$this->Flash->success(__('The user has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
		$tecnicos = $this->Users->Tecnicos->find('list', ['limit' => 200])->all();
		$this->set(compact('user', 'tecnicos'));
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Http\Response|null|void Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$user = $this->Users->get($id);
		if ($this->Users->delete($user)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
	
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		// Configure the login action to not require authentication, preventing
		// the infinite redirect loop issue
		$this->Authentication->addUnauthenticatedActions(['login']);
	}

	public function login()
	{
		$this->Authorization->skipAuthorization(); // no Auth
		
		$this->request->allowMethod(['get', 'post']);
		$result = $this->Authentication->getResult();
		// regardless of POST or GET, redirect if user is logged in
		if ($result && $result->isValid()) {
				// redirect to /articles after login success
				$redirect = $this->request->getQuery('redirect', [
						'controller' => 'Users',
						'action' => 'index',
				]);

				return $this->redirect($redirect);
		}
		// display error if user submitted and authentication failed
		if ($this->request->is('post') && !$result->isValid()) {
				$this->Flash->error(__('Invalid username or password'));
		}
	}
	
	// in src/Controller/UsersController.php
	public function logout()
	{
		$this->Authorization->skipAuthorization(); // no Auth

		$result = $this->Authentication->getResult();
		// regardless of POST or GET, redirect if user is logged in
		if ($result && $result->isValid()) {
				$this->Authentication->logout();
				return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}
	}

}
