<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class AvancesTable extends Table
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

        $this->setTable('avances');
        $this->setDisplayField('avance');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('ParentAvances', [
            'className' => 'Avances',
            'foreignKey' => 'parent_id',
        ]);
        $this->belongsTo('Proyectos', [
            'foreignKey' => 'proyecto_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Acciones', [
            'foreignKey' => 'avance_id',
        ]);
        $this->hasMany('ChildAvances', [
            'className' => 'Avances',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('avance')
            ->maxLength('avance', 70)
            ->requirePresence('avance', 'create')
            ->notEmptyString('avance');

        $validator
            ->scalar('prefix')
            ->maxLength('prefix', 10)
            ->allowEmptyString('prefix');

        $validator
            ->boolean('completado')
            ->notEmptyString('completado');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentAvances'), ['errorField' => 'parent_id']);
        $rules->add($rules->existsIn(['proyecto_id'], 'Proyectos'), ['errorField' => 'proyecto_id']);

        return $rules;
    }
}
