<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TareasTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tareas');
        $this->setDisplayField('tarea');
        $this->setPrimaryKey('id');

        $this->hasMany('Asignados', [
            'foreignKey' => 'tarea_id',
        ]);
        
        $this->belongsTo('Confavances', [
            'foreignKey' => 'confavance_id ',
        ]);
        
         $this->belongsToMany('Tecnicos',  [
            'joinTable' => 'asignados',
        ]);
        
        $this->belongsToMany('Limitantes', [
			'className' => 'Tareas',
			'joinTable' => 'Rojos',
			'bindingKey' => 'id',
//			'foreignKey' => 'noantesde',
			'foreignKey' => 'propio',
			'targetForeignKey' => 'propio',  // ojooooooooo
//			'targetForeignKey' => 'id',
//			'targetForeignKey' => 'noantesde',
			'order' => ['codigo' => 'ASC'],
		]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('tarea')
            ->maxLength('tarea', 30)
            ->requirePresence('tarea', 'create')
            ->notEmptyString('tarea');

        $validator
            ->scalar('codigo')
            ->maxLength('codigo', 30)
            ->requirePresence('codigo', 'create')
            ->notEmptyString('codigo');

        $validator
            ->scalar('descripcion')
            ->allowEmptyString('descripcion');

        $validator
            ->scalar('documentar')
            ->allowEmptyString('documentar');

        return $validator;
    }
}
