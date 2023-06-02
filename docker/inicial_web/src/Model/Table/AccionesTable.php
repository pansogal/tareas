<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AccionesTable extends Table
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

        $this->setTable('acciones');
        $this->setDisplayField('accion');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Avances', [
            'foreignKey' => 'avance_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Implicados', [
            'foreignKey' => 'accione_id',
        ]);
        $this->hasMany('Notas', [
            'foreignKey' => 'accione_id',
        ]);

        
         $this->belongsToMany('Tecnicos', ['joinTable' => 'Implicados']);
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
            ->scalar('accion')
            ->maxLength('accion', 50)
            ->requirePresence('accion', 'create')
            ->notEmptyString('accion');

        $validator
            ->scalar('code')
            ->maxLength('code', 30)
            ->requirePresence('code', 'create')
            ->notEmptyString('code');

        $validator
            ->boolean('realizada')
            ->notEmptyString('realizada');

        $validator
            ->boolean('luzverde')
            ->notEmptyString('luzverde');

        $validator
            ->date('iniciada')
            ->allowEmptyDate('iniciada');

        $validator
            ->date('finalizada')
            ->allowEmptyDate('finalizada');

        $validator
            ->scalar('descripcion')
            ->allowEmptyString('descripcion');

        $validator
            ->scalar('documentar')
            ->allowEmptyString('documentar');

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
        $rules->add($rules->existsIn(['avance_id'], 'Avances'), ['errorField' => 'avance_id']);

        return $rules;
    }
}
