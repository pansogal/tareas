<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tareas Controller
 *
 * @property \App\Model\Table\TareasTable $Tareas
 * @method \App\Model\Entity\Tarea[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TareasController extends AppController
{

    public function index($deleid=null)    {
	  $this->Authorization->skipAuthorization(); // no Auth
	  
	  $tecnico = $this->dameUserTec();
	  
	  if(!is_null( $deleid) ){
		   $cond = ['Tecnico.delegacione_id' =>$deleid,];
		   $this->loadModel('Delegaciones');
		   $dele = $this->Delegaciones->get($deleid);
		   $this->set('dele', $dele);
	   }
	    
	 $this->paginate = [
            'contain' => ['Tecnicos', 'Tecnicos.Delegaciones', 'Limitantes'],
            'order' => ['codigo' => 'ASC',],
            //'conditions' =>$cond,
            'limit' => 100,
        ];
        $tareas = $this->paginate($this->Tareas);
        
         // Preparación de tareas /////////////////////////////////
	 $todas=$this->Tareas->find('all',[
		'contain' => [ 'Limitantes'],
		])->all();
	 $todas2=$this->Tareas->find('all',[
		'contain' => [ 'Limitantes'],
		])->all();
	$semaforos=[];
         foreach( $todas as $ta){
		 //$this->Flash->success('Vu '.json_encode($ta->limitantes));
		 $idx=0;
		foreach( $ta->limitantes as $ro){
			$cual = $ro->_joinData->noantesde;
			foreach($todas2 as $una){
				if($una->id == $cual){ // $una es limitante de $ta
					$semaforos[$ta->id][$idx++] = $una;		
				}
			}
		}
	 }

        $this->set(compact('tareas', 'todas', 'semaforos','tecnico'));
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
		$tecnico->user = $datos->id;
		return $tecnico;
	}

    
    public function view($id = null)    {
        $tarea = $this->Tareas->get($id, [
            'contain' => ['Tecnicos'],
        ]);

        $this->set(compact('tarea'));
    }

    public function add()    {
        $tarea = $this->Tareas->newEmptyEntity();
        $this->Authorization->authorize($tarea);
        if ($this->request->is('post')) {
            $tarea = $this->Tareas->patchEntity($tarea, $this->request->getData());
            if ($this->Tareas->save($tarea)) {
                $this->Flash->success(__('The tarea has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tarea could not be saved. Please, try again.'));
        }
        $tecnicos = $this->Tareas->Tecnicos->find('list', ['limit' => 200]);
        $this->set(compact('tarea', 'tecnicos'));
    }

    public function edit($id = null)    {
	 $tech = $this->dameUserTec();
	 
	 if($tech->user != 1 ){ // no es admin
		 $this->Flash->error('Solo los administradores pueden configurar los técnicos y semáforos de una tarea.');
		 return $this->redirect(['action' => 'index']);
	 }
	 
        $tarea = $this->Tareas->get($id, [
            'contain' => ['Tecnicos', 'Tecnicos.Delegaciones' , 'Limitantes'],
        ]);
        $this->Authorization->authorize($tarea);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $tarea = $this->Tareas->patchEntity($tarea, $this->request->getData());
            if ($this->Tareas->save($tarea)) {
                $this->Flash->success(__('The tarea has been saved.'));

                return $this->redirect(['action' => 'edit', $id]);
            }
            $this->Flash->error(__('The tarea could not be saved. Please, try again.'));
        }
        
        // filtrar técnicos ////////////////////////////
        $tecnicos = [];
        $tecraw = $this->Tareas->Tecnicos->find('all', [
		'contain' => ['Delegaciones', 'Tareas',],
		'limit' => 200,
        ])->all();
        foreach( $tecraw as $tec){
		 $tec->hay = false;
		 foreach( $tec->tareas as $tare){
			 if($tare->id == $id)  $tec->hay = true;
		 }
		 array_push($tecnicos, $tec);
	 }
	 
	 // Semáforos de tareas /////////////////////////////////
	 $ttareas=[];
	 $tareasrw = $this->Tareas->find('all', [
            'contain' => [ 'Limitantes',],
            'order' =>['codigo' =>'ASC'],
        ])->all();
        foreach( $tareasrw as $ta){
		 $ta->hay = false; $ta->salto = false; 
		  if($tarea->id == $ta->id)  $ta->salto = true;
		 foreach( $tarea->limitantes as $ro){
			 if($ro->_joinData->noantesde == $ta->id)  $ta->hay = true;
		 } 
		 array_push($ttareas, $ta);
	 }
        
        $this->set(compact('tarea', 'tecnicos', 'ttareas'));
    }
    
	public function semaforoOn($propioid=null, $noantesid=null)    {
		 $tarea = $this->Tareas->newEmptyEntity();
		$this->Authorization->authorize($tarea);
        
		$this->loadModel('Rojos');
		$rojo = $this->Rojos->newEmptyEntity();
		$rojo->propio = $propioid;
		$rojo->noantesde = $noantesid;
		$this->Rojos->save($rojo);
		
		return $this->redirect(['action' => 'edit', $propioid]);

	}
	
	public function semaforoOff($propioid=null, $noantesid=null)    {
		$tarea = $this->Tareas->newEmptyEntity();
		$this->Authorization->authorize($tarea);
		
		$this->loadModel('Rojos');
		$rojo = $this->Rojos->find('all',[
			'conditions' => ['propio' => $propioid, 'noantesde' => $noantesid, ],
		])->first();
		
		if ($this->Rojos->delete($rojo)) {
			//$this->Flash->success('Se ha eliminado la restricción de la tarea');
		} else {
			$this->Flash->error('Hay algún error en la tarea de desasignación.');
		}
		
		return $this->redirect(['action' => 'edit', $propioid]);
	}

	public function asigna($taid=null, $teid=null){
		$tarea = $this->Tareas->newEmptyEntity();
		$this->Authorization->authorize($tarea);

		$this->loadModel('Asignados');
		
		$asignado = $this->Asignados->newEmptyEntity();
		$asignado->tarea_id = $taid;
		$asignado->tecnico_id = $teid;
		$this->Asignados->save($asignado);
		
		return $this->redirect(['action' => 'edit', $taid]);
		
	}

	public function libera($taid=null, $teid=null){
		$tarea = $this->Tareas->newEmptyEntity();
		$this->Authorization->authorize($tarea);
		
		$this->loadModel('Asignados');
		$asignado = $this->Asignados->find('all',[
			'conditions' => ['tarea_id' => $taid, 'tecnico_id' => $teid, ],
		])->first();
		
		if ($this->Asignados->delete($asignado)) {
			//$this->Flash->success('El técnico ha sido liberado de la tarea');
		} else {
			$this->Flash->error('Hay algún error en la tarea de desasignación.');
		}
		
		return $this->redirect(['action' => 'edit', $taid]);
	}
    /**
     * Delete method
     *
     * @param string|null $id Tarea id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tarea = $this->Tareas->get($id);
        if ($this->Tareas->delete($tarea)) {
            $this->Flash->success(__('The tarea has been deleted.'));
        } else {
            $this->Flash->error(__('The tarea could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    	// BUSCADOR ///////////////////////////
	private function busca_en ( $array, $key, $value ){
		foreach($array as $obj){
			if( $obj->$key  == $value) return $obj;
		}
		return null;
	}
    
    // Transpone los limitantes dentro de las tareas, para que apunten correctamente
    public function traspone(){
	     $ta1s = $this->Tareas->find('all',[
			'contain' => ['Limitantes',],
		])->all();

	     $ta2s = $this->Tareas->find('all',[
			'contain' => ['Limitantes',],
		])->all();
		
		foreach($ta1s as $ta1){
			$nuevo= [];
			foreach($ta1->limitantes as $talim){
				$lim = $this->busca_en($ta2s, 'id',  $talim->_joinData->noantesde);
				if(! is_null($lim) ){
					array_push($nuevo,$lim);
				}
			}
			$ta1->limitantes = $nuevo; 
		}
		
		return $ta1s;
    }
    
}
