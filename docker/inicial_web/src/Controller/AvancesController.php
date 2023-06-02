<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Avances Controller
 *
 * @property \App\Model\Table\AvancesTable $Avances
 * @method \App\Model\Entity\Avance[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AvancesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ParentAvances', 'Proyectos'],
        ];
        $avances = $this->paginate($this->Avances);

        $this->set(compact('avances'));
    }

	public function arbol($proid = null){
		//Carga el proyecto
		$this->loadModel('Proyectos');
		$proy = $this->Proyectos->get($proid,[
			'contain' => ['Delegaciones', 'Avances', 'Avances.Acciones', 'Avances.Acciones.Tecnicos'],
		]);
		
		$this->set('avances', $proy->avances);
		
		// borra luego
		$this->loadModel('Tareas');
		$tt01 = $this->Tareas->find('all',[
				'contain' => ['Tecnicos'],
				'conditions' => ['codigo' =>'00.1'] ,
			])->first();
		$this->set('tt01', $tt01);
		
		// carga de tareas
		$this->loadModel('Tareas');
		$ttareas = $this->Tareas->find('all', [
			'contain' => ['Tecnicos', 'Tecnicos.Acciones', 'Tecnicos.Delegaciones'],
			])->all();
		$this->set('ttareas', $ttareas);
		
		// avances, leer la configuración
		$this->loadModel('Confavances');
		
		$todos = $this->Confavances->find('all',[
			'contain' => ['Tareas', 'ParentConfavances', ],
			'conditions' => ['Confavances.id >'=>1, ],
		])->all();
		 $this->set('todos', $todos);
		
		$this->loadModel("Acciones");
		
		// iterar para crear la estructura
		foreach($todos as $cav){
			$this->confToAvance($cav, $proy); // creación

			// busco ahora
			$avance = $this->busca_en($proy->avances, 'prefix', $cav->prefijo);
			
			if( is_null($avance) ){
				$this->Flash->error("AVANCE: No encontré ". $cav->prefijo);
			} else{ // existe y creamos las acciones si toca
				if( !isset($avance->acciones) ) $avance->acciones = []; // por si no existe el array
				foreach($cav->tareas as $tt){
					$existe = $this->busca_en($avance->acciones, 'code', $tt->codigo);
					if( is_null($existe) ) { // hay que crear la accion
						$acc = $this->Acciones->newEmptyEntity();
						$acc->avance_id = $avance->id;
						$acc->code = $tt->codigo;
						$acc->accion = $tt->tarea;
						$acc->descripcion = $tt->descripcion;
						$acc->documentar = $tt->documentar;
						$this->Acciones->save($acc);
						array_push($avance->acciones, $acc);
					}
				}
			} // fin creación de acciones
		}
		
		// asignación automática de técnicos.
		$this->loadModel('Implicados');
		
		foreach($proy->avances as $av){
				foreach($av->acciones as $acc){
					$tt = $this->busca_en($ttareas, 'codigo', $acc->code);
					if( !is_null($tt) ){
						foreach($tt->tecnicos as $tec){
							if($proy->delegacione_id == $tec->delegacione_id  || $tec->central ){
								$existe = $this->busca_en($acc->tecnicos, 'id', $tec->id);
								if( is_null($existe) ){
									//echo "----------------------------------->>>>>>>>>>>>  CREAR<br />";
									$impli = $this->Implicados->newEmptyEntity();
									$impli->accione_id = $acc->id;
									$impli->tecnico_id = $tec->id;
									$this->Implicados->save($impli);
								}
							}
						}
					}
				}
		}
		
		
		
		return $this->redirect(['controller' => 'Proyectos','action' => 'view', $proid]);
		
		/*$proy = $this->Proyectos->get($proid,[
			'contain' => ['Avances', 'Avances.Acciones',],
		]);
		 $this->set('proyecto', $proy);*/
		
	}
	
	// Toma una configuración de avance y la desarrolla sobre el proyecto
	private function confToAvance($cav, $proy){
		// mirar si existe un avance con el mismo prefix
		$existe = $this->busca_en($proy->avances, 'prefix', $cav->prefijo);
		if( is_null($existe) ){ // no existe, creamos
			$avance = $this->Avances->newEmptyEntity();
			if( is_null($cav->parent_id) ) $avance->parent_id = NULL;
			else{ // buscamos parent via prefijo
				$padre = $this->busca_en($proy->avances, 'prefix', $cav->parent_confavance->prefijo);
				if( !is_null($padre) ){
					$avance->parent_id = $padre->id;
				}else $this->Flash->error('No encontrado un avance anterior con prefix ' . $cav->parent_confavance->prefijo);
			}
			$avance->prefix = $cav->prefijo;
			$avance->proyecto_id = $proy->id;
			$avance->avance = $cav->cavance;
			$this->Avances->save($avance);
			
			array_push($proy->avances, $avance);
		}else{ // ya existe
		}
		
	}

	// BUSCADOR ///////////////////////////
	private function busca_en ( $array, $key, $value ){
		foreach($array as $obj){
			if( $obj->$key  == $value) return $obj;
		}
		return null;
	}

    /**
     * View method
     *
     * @param string|null $id Avance id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $avance = $this->Avances->get($id, [
            'contain' => ['ParentAvances', 'Proyectos', 'Acciones', 'ChildAvances'],
        ]);

        $this->set(compact('avance'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $avance = $this->Avances->newEmptyEntity();
        if ($this->request->is('post')) {
            $avance = $this->Avances->patchEntity($avance, $this->request->getData());
            if ($this->Avances->save($avance)) {
                $this->Flash->success(__('The avance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The avance could not be saved. Please, try again.'));
        }
        $parentAvances = $this->Avances->ParentAvances->find('list', ['limit' => 200]);
        $proyectos = $this->Avances->Proyectos->find('list', ['limit' => 200]);
        $this->set(compact('avance', 'parentAvances', 'proyectos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Avance id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $avance = $this->Avances->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $avance = $this->Avances->patchEntity($avance, $this->request->getData());
            if ($this->Avances->save($avance)) {
                $this->Flash->success(__('The avance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The avance could not be saved. Please, try again.'));
        }
        $parentAvances = $this->Avances->ParentAvances->find('list', ['limit' => 200]);
        $proyectos = $this->Avances->Proyectos->find('list', ['limit' => 200]);
        $this->set(compact('avance', 'parentAvances', 'proyectos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Avance id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $avance = $this->Avances->get($id);
        if ($this->Avances->delete($avance)) {
            $this->Flash->success(__('The avance has been deleted.'));
        } else {
            $this->Flash->error(__('The avance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
