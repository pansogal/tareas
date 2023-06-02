<?php
declare(strict_types=1);

namespace App\Controller;

class ValoresController extends AppController
{
    public function index()    {
        $this->paginate = [
            'contain' => ['Parametros', 'Proyectos'],
        ];
        $valores = $this->paginate($this->Valores);

        $this->set(compact('valores'));
    }

    public function view($id = null)    {
        $valore = $this->Valores->get($id, [
            'contain' => ['Parametros', 'Proyectos'],
        ]);

        $this->set(compact('valore'));
    }

    public function add()    {
        $valore = $this->Valores->newEmptyEntity();
        if ($this->request->is('post')) {
            $valore = $this->Valores->patchEntity($valore, $this->request->getData());
            if ($this->Valores->save($valore)) {
                $this->Flash->success(__('The valore has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The valore could not be saved. Please, try again.'));
        }
        $parametros = $this->Valores->Parametros->find('list', ['limit' => 200]);
        $proyectos = $this->Valores->Proyectos->find('list', ['limit' => 200]);
        $this->set(compact('valore', 'parametros', 'proyectos'));
    }


    public function otro($pid=null, $paid=null)  {
	    // numerar los anteriores
		$valores = $this->Valores->find('all', [
				'conditions' =>['parametro_id'=>$paid, 'proyecto_id'=>$pid, ],
				'order'=>['id'=>'ASC'],
			])->all();
		$cuenta=1;
		foreach($valores as $v){
			$v->siguiente = $cuenta;
			$this->Valores->save($v);
			$cuenta++;
		}
	    // crear el nuevo
		$valo = $this->Valores->newEmptyEntity();
		$valo->parametro_id = $paid;
		$valo->proyecto_id = $pid;
		$valo->siguiente = $cuenta;
		$this->Valores->save($valo);
		
		return $this->redirect(['controller'=>'Proyectos', 'action' => 'parametros',$pid]);
    }
    public function quitar($pid=null, $vid=null, $paid=null){
		// borrar
		$valore = $this->Valores->get($vid);
		$this->Valores->delete($valore);
		
		// numerar los anteriores
		$valores = $this->Valores->find('all', [
				'conditions' =>['parametro_id'=>$paid, 'proyecto_id'=>$pid, ],
				'order'=>['id'=>'ASC'],
			])->all();
		
		if( count($valores) == 1) $cuenta=0;
		else $cuenta=1;
		
		foreach($valores as $v){
			$v->siguiente = $cuenta;
			$this->Valores->save($v);
			$cuenta++;
		}
		return $this->redirect(['controller'=>'Proyectos', 'action' => 'parametros',$pid]);
    }
    
	// Quita todos los parámetros de un proyecto
      public function reset($pid=null){
	      $valores = $this->Valores->find('all', [
				'conditions' =>['proyecto_id'=>$pid, ],
			])->all();
		foreach($valores as $v){
			$this->Valores->delete($v);
		}
		return $this->redirect(['controller'=>'Parametros', 'action' => 'desde_proyecto',$pid]);
      }
    
    
    
    /**
     * Edit method
     *
     * @param string|null $id Valore id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $valore = $this->Valores->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $valore = $this->Valores->patchEntity($valore, $this->request->getData());
            if ($this->Valores->save($valore)) {
                $this->Flash->success(__('The valore has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The valore could not be saved. Please, try again.'));
        }
        $parametros = $this->Valores->Parametros->find('list', ['limit' => 200]);
        $proyectos = $this->Valores->Proyectos->find('list', ['limit' => 200]);
        $this->set(compact('valore', 'parametros', 'proyectos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Valore id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $valore = $this->Valores->get($id);
        if ($this->Valores->delete($valore)) {
            $this->Flash->success(__('The valore has been deleted.'));
        } else {
            $this->Flash->error(__('The valore could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
