<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Rojos Controller
 *
 * @property \App\Model\Table\RojosTable $Rojos
 * @method \App\Model\Entity\Rojo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RojosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $rojos = $this->paginate($this->Rojos);

        $this->set(compact('rojos'));
    }

    /**
     * View method
     *
     * @param string|null $id Rojo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rojo = $this->Rojos->get($id, [
            'contain' => ['Esperas'],
        ]);

        $this->set(compact('rojo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rojo = $this->Rojos->newEmptyEntity();
        if ($this->request->is('post')) {
            $rojo = $this->Rojos->patchEntity($rojo, $this->request->getData());
            if ($this->Rojos->save($rojo)) {
                $this->Flash->success(__('The rojo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rojo could not be saved. Please, try again.'));
        }
        $this->set(compact('rojo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rojo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rojo = $this->Rojos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rojo = $this->Rojos->patchEntity($rojo, $this->request->getData());
            if ($this->Rojos->save($rojo)) {
                $this->Flash->success(__('The rojo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rojo could not be saved. Please, try again.'));
        }
        $this->set(compact('rojo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rojo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rojo = $this->Rojos->get($id);
        if ($this->Rojos->delete($rojo)) {
            $this->Flash->success(__('The rojo has been deleted.'));
        } else {
            $this->Flash->error(__('The rojo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
