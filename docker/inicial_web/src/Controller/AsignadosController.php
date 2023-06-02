<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Asignados Controller
 *
 * @property \App\Model\Table\AsignadosTable $Asignados
 * @method \App\Model\Entity\Asignado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AsignadosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tareas', 'Tecnicos'],
        ];
        $asignados = $this->paginate($this->Asignados);

        $this->set(compact('asignados'));
    }

    /**
     * View method
     *
     * @param string|null $id Asignado id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $asignado = $this->Asignados->get($id, [
            'contain' => ['Tareas', 'Tecnicos'],
        ]);

        $this->set(compact('asignado'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $asignado = $this->Asignados->newEmptyEntity();
        if ($this->request->is('post')) {
            $asignado = $this->Asignados->patchEntity($asignado, $this->request->getData());
            if ($this->Asignados->save($asignado)) {
                $this->Flash->success(__('The asignado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asignado could not be saved. Please, try again.'));
        }
        $tareas = $this->Asignados->Tareas->find('list', ['limit' => 200]);
        $tecnicos = $this->Asignados->Tecnicos->find('list', ['limit' => 200]);
        $this->set(compact('asignado', 'tareas', 'tecnicos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Asignado id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $asignado = $this->Asignados->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $asignado = $this->Asignados->patchEntity($asignado, $this->request->getData());
            if ($this->Asignados->save($asignado)) {
                $this->Flash->success(__('The asignado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asignado could not be saved. Please, try again.'));
        }
        $tareas = $this->Asignados->Tareas->find('list', ['limit' => 200]);
        $tecnicos = $this->Asignados->Tecnicos->find('list', ['limit' => 200]);
        $this->set(compact('asignado', 'tareas', 'tecnicos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Asignado id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $asignado = $this->Asignados->get($id);
        if ($this->Asignados->delete($asignado)) {
            $this->Flash->success(__('The asignado has been deleted.'));
        } else {
            $this->Flash->error(__('The asignado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
