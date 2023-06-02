<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller
{
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('RequestHandler');
		$this->loadComponent('Flash');
		
		// Add this line to check authentication result and lock your site
		$this->loadComponent('Authentication.Authentication');
		$this->loadComponent('Authorization.Authorization');

		/*
		 * Enable the following component for recommended CakePHP form protection settings.
		 * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
		 */
		//$this->loadComponent('FormProtection');
	}
	
	// in src/Controller/AppController.php
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		
/*		$data = $this->Authentication->getResult()->getData(); //actual user entity, null when not logged in
		$this->isLoggedIn = $this->Authentication->getResult()->isValid();
		$this->loggedInID = $this->isLoggedIn ? $data->id : -1;
		$this->loggedInEmail = $this->isLoggedIn ? h($data->email) : "";
		$this->loggedInUsuario = $this->isLoggedIn ? h($data->usuario) : ""; // h() to sanitise
		$this->adminLevel = $this->isLoggedIn ? $data->esadmin : 0;
		$this->set(['isLoggedIn' => $this->isLoggedIn,
					'loggedInID' => $this->loggedInID,
					'loggedInEmail' => $this->loggedInEmail,
					'loggedInUsuario' => $this->loggedInUsuario,
					'adminLevel' => $this->adminLevel
				  ]);
		*/
		
		// for all controllers in our application, make index and view
		// actions public, skipping the authentication check
		
		//$this->Authentication->addUnauthenticatedActions(['index', 'view']);

	}

	 public function beforeRender(\Cake\Event\EventInterface $event){
		 
		//	$this->set('logged_user',$this->user);
	 }

}
