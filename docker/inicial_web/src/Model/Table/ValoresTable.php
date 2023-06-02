<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ValoresTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('valores');
        $this->setDisplayField('valor');
        $this->setPrimaryKey('id');

        $this->belongsTo('Parametros', [
            'foreignKey' => 'parametro_id',
            // 'order' => ['indice'=>'ASC'],
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Proyectos', [
            'foreignKey' => 'proyecto_id',
            'joinType' => 'INNER',
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
            ->scalar('valor')
            ->maxLength('valor', 100)
            ->notEmptyString('valor');

        $validator
            ->scalar('siguiente')
            ->maxLength('siguiente', 100)
            ->notEmptyString('siguiente');

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
        $rules->add($rules->existsIn(['parametro_id'], 'Parametros'), ['errorField' => 'parametro_id']);
        $rules->add($rules->existsIn(['proyecto_id'], 'Proyectos'), ['errorField' => 'proyecto_id']);

        return $rules;
    }
}
