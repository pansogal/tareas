<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class RojosTable extends Table
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

        $this->setTable('rojos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        $this->hasMany('Tareas', [
		'className' => 'Tareas',
		'foreignKey' => 'noantesde',
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
            ->integer('propio')
            ->requirePresence('propio', 'create')
            ->notEmptyString('propio');

        $validator
            ->integer('noantesde')
            ->requirePresence('noantesde', 'create')
            ->notEmptyString('noantesde');

        return $validator;
    }
    
        public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['propio'], 'Tareas'), ['errorField' => 'propio']);
        $rules->add($rules->existsIn(['noantesde'], 'Tareas'), ['errorField' => 'noantesde']);

        return $rules;
    }
}
