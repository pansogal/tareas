<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class NotasTable extends Table
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

        $this->setTable('notas');
        $this->setDisplayField('titulo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('ParentNotas', [
            'className' => 'Notas',
            'foreignKey' => 'parent_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Acciones', [
            'foreignKey' => 'accione_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ChildNotas', [
            'className' => 'Notas',
            'foreignKey' => 'parent_id',
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
            ->integer('parent_id')
            ->allowEmptyString('parent_id');

        $validator
            ->integer('left')
            ->allowEmptyString('left');

        $validator
            ->integer('right')
            ->allowEmptyString('right');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('accione_id')
            ->notEmptyString('accione_id');

        $validator
            ->scalar('titulo')
            ->maxLength('titulo', 200)
            ->notEmptyString('titulo');

        $validator
            ->scalar('texto')
            ->allowEmptyString('texto');

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
        $rules->add($rules->existsIn('parent_id', 'ParentNotas'), ['errorField' => 'parent_id']);
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('accione_id', 'Acciones'), ['errorField' => 'accione_id']);

        return $rules;
    }
}
