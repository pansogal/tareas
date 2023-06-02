<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class TecnicosTable extends Table
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

        $this->setTable('tecnicos');
        $this->setDisplayField('nombre');
        $this->setPrimaryKey('id');

        $this->belongsTo('Delegaciones', [
            'foreignKey' => 'delegacione_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Asignados', [
            'foreignKey' => 'tecnico_id',
        ]);
        $this->hasMany('Implicados', [
            'foreignKey' => 'tecnico_id',
        ]);

        $this->hasMany('Users', [
            'foreignKey' => 'tecnico_id',
        ]);
        
         $this->belongsToMany('Tareas',  [
            'joinTable' => 'asignados',
        ]);
        
        $this->belongsToMany('Acciones',  [
            'joinTable' => 'implicados',
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
            ->scalar('nombre')
            ->maxLength('nombre', 80)
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre');
        
        $validator
            ->scalar('cargo')
            ->maxLength('cargo', 80)
            ->requirePresence('cargo', 'create')
            ->notEmptyString('cargo');

	  $validator
            ->boolean('central')
            ->notEmptyString('central');
            
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['delegacione_id'], 'Delegaciones'), ['errorField' => 'delegacione_id']);

        return $rules;
    }
}
