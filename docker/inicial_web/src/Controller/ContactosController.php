<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Contactos Controller
 *
 * @property \App\Model\Table\ContactosTable $Contactos
 * @method \App\Model\Entity\Contacto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Empresas'],
        ];
        $contactos = $this->paginate($this->Contactos);

        $this->set(compact('contactos'));
    }

    /**
     * View method
     *
     * @param string|null $id Contacto id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contacto = $this->Contactos->get($id, [
            'contain' => ['Empresas'],
        ]);

        $this->set(compact('contacto'));
    }

    /**
     * Add method
     */
    public function add($empid=null)  {
	  
	  if( !is_null($empid) ){
		  $this->loadModel('Empresas');
		  $empresa = $this->Empresas->get($empid);
		  $this->set('empresa', $empresa);
	  }
	  	    
        $contacto = $this->Contactos->newEmptyEntity();
        if ($this->request->is('post')) {
            $contacto = $this->Contactos->patchEntity($contacto, $this->request->getData());
            if ($this->Contactos->save($contacto)) {
                $this->Flash->success(__('The contacto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contacto could not be saved. Please, try again.'));
        }
        $empresas = $this->Contactos->Empresas->find('list', ['limit' => 200]);
        $this->set(compact('contacto', 'empresas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contacto id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contacto = $this->Contactos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contacto = $this->Contactos->patchEntity($contacto, $this->request->getData());
            if ($this->Contactos->save($contacto)) {
                $this->Flash->success(__('The contacto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contacto could not be saved. Please, try again.'));
        }
        $empresas = $this->Contactos->Empresas->find('list', ['limit' => 200]);
        $this->set(compact('contacto', 'empresas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contacto id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contacto = $this->Contactos->get($id);
        if ($this->Contactos->delete($contacto)) {
            $this->Flash->success(__('The contacto has been deleted.'));
        } else {
            $this->Flash->error(__('The contacto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
