<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class ConfavancesTable extends Table
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

        $this->setTable('confavances');
        $this->setDisplayField('cavance');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('ParentConfavances', [
            'className' => 'Confavances',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildConfavances', [
            'className' => 'Confavances',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('Tareas', [
            'foreignKey' => 'confavance_id',
            'sort' => ['codigo' => 'ASC'],
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
            ->scalar('prefijo')
            ->maxLength('prefijo', 10)
            ->allowEmptyString('prefijo');

        $validator
            ->scalar('cavance')
            ->maxLength('cavance', 80)
            ->requirePresence('cavance', 'create')
            ->notEmptyString('cavance');

        $validator
            ->scalar('explicacion')
            ->allowEmptyString('explicacion');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentConfavances'), ['errorField' => 'parent_id']);

        return $rules;
    }
}
