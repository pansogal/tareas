<?php
declare(strict_types=1);

namespace App\Controller;


class UsersController extends AppController
{
	public function index()
	{
		$this->Authorization->skipAuthorization(); // no Auth

		$this->paginate = [
			'contain' => ['Tecnicos', 'Tecnicos.Delegaciones'],
		];
		$users = $this->paginate($this->Users);

		$this->set(compact('users'));
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
	
	// Panel de control del usuario logeado
	public function panel($f1 = null, $f1d=null,$f2 = null, $f2d=null){
		$usr = $this->request->getAttribute('identity');
		$usr->tech = $this->dameUserTec();

		// filtros
		if( !is_null($f1) && !is_null($f1d)){
			if( $f1 == 'proy'){
				$this->set('proy', $f1d); 
				$usr->tech->proy = $f1d;
				$this->loadModel('Proyectos');
				$pr = $this->Proyectos->get($f1d);
				$this->set('pr', $pr); 
			}
			if( $f1 == 'luzverde')  $usr->tech->luzverde = $f1d;
			if( $f1 == 'iniciada')  $usr->tech->iniciada = $f1d;
			if( $f1 == 'finalizada')  $usr->tech->finalizada = $f1d;
		}
		if( !is_null($f2) && !is_null($f2d)){
			if( $f2 == 'luzverde') $usr->tech->luzverde = $f2d;
			if( $f2 == 'iniciada')  $usr->tech->iniciada = $f2d;
			if( $f2 == 'finalizada')  $usr->tech->finalizada = $f2d;
		}
		// tareas
		$this->loadModel('Implicados');
		
		$query = $usr->applyScope('panel', $this->Implicados->find('all',  [
			'contain' => ['Acciones','Acciones.Avances','Acciones.Avances.Proyectos', 'Tecnicos'],
		]));
		$implicas = $this->paginate($query);
		$this->set(compact( 'usr','implicas'));
	}

	public function view($id = null)
	{
		$user = $this->Users->get($id, [
			'contain' => ['Tecnicos'],
		]);
		$this->Authorization->authorize($user);
		$this->set(compact('user'));
	}

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

	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$user = $this->Users->get($id);
		$this->Authorization->authorize($user);
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
				$this->Flash->error(__('email/contraseña incorrectos'));
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
