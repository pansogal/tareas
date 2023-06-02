<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Implicados Controller
 *
 * @property \App\Model\Table\ImplicadosTable $Implicados
 * @method \App\Model\Entity\Implicado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ImplicadosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Acciones', 'Tecnicos'],
        ];
        $implicados = $this->paginate($this->Implicados);

        $this->set(compact('implicados'));
    }

    /**
     * View method
     *
     * @param string|null $id Implicado id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $implicado = $this->Implicados->get($id, [
            'contain' => ['Acciones', 'Tecnicos'],
        ]);

        $this->set(compact('implicado'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
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

    /**
     * Edit method
     *
     * @param string|null $id Implicado id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $implicado = $this->Implicados->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
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

    /**
     * Delete method
     *
     * @param string|null $id Implicado id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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
