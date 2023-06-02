<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Parametros Controller
 *
 * @property \App\Model\Table\ParametrosTable $Parametros
 * @method \App\Model\Entity\Parametro[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ParametrosController extends AppController
{
	
    public function index()    {
        $parametros = $this->paginate($this->Parametros);

        $this->set(compact('parametros'));
    }

    public function view($id = null)   {
        $parametro = $this->Parametros->get($id, [
            'contain' => ['Valores'],
        ]);

        $this->set(compact('parametro'));
    }

    public function desdeProyecto($pid=null) {
	    $this->loadModel('Proyectos');
	    
	    $proyecto = $this->Proyectos->get($pid,[
		'contain' =>[ 'Valores', 'Valores.Parametros', ],
	    ]);
	    
	    if( $proyecto->es_fv  && count($proyecto->valores) == 0 ){ // creamos valores
		    $this->loadModel('Valores');
		    $cargar = [1,2,3,4,5,6,7,8];
		    foreach($cargar as $c){
			    $valo = $this->Valores->newEmptyEntity();
			    $valo->parametro_id = $c;
			    $valo->proyecto_id = $pid;
			    $this->Valores->save($valo);
		    }
		    $proyecto = $this->Proyectos->get($pid,[
				'contain' =>[ 'Valores', 'Valores.Parametros', ],
			]);
	    }
	
	return $this->redirect(['controller'=>'Proyectos', 'action' => 'parametros', $pid]);    
	    
	$this->set(compact('proyecto'));
	
    }

    public function add()    {
        $parametro = $this->Parametros->newEmptyEntity();
        if ($this->request->is('post')) {
            $parametro = $this->Parametros->patchEntity($parametro, $this->request->getData());
            if ($this->Parametros->save($parametro)) {
                $this->Flash->success(__('The parametro has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The parametro could not be saved. Please, try again.'));
        }
        $this->set(compact('parametro'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Parametro id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $parametro = $this->Parametros->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parametro = $this->Parametros->patchEntity($parametro, $this->request->getData());
            if ($this->Parametros->save($parametro)) {
                $this->Flash->success(__('The parametro has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The parametro could not be saved. Please, try again.'));
        }
        $this->set(compact('parametro'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Parametro id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parametro = $this->Parametros->get($id);
        if ($this->Parametros->delete($parametro)) {
            $this->Flash->success(__('The parametro has been deleted.'));
        } else {
            $this->Flash->error(__('The parametro could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
