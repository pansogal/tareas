<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Implicados Model
 *
 * @property \App\Model\Table\AccionesTable&\Cake\ORM\Association\BelongsTo $Acciones
 * @property \App\Model\Table\TecnicosTable&\Cake\ORM\Association\BelongsTo $Tecnicos
 *
 * @method \App\Model\Entity\Implicado newEmptyEntity()
 * @method \App\Model\Entity\Implicado newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Implicado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Implicado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Implicado findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Implicado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Implicado[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Implicado|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Implicado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Implicado[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Implicado[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Implicado[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Implicado[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ImplicadosTable extends Table
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

        $this->setTable('implicados');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Acciones', [
            'foreignKey' => 'accione_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Tecnicos', [
            'foreignKey' => 'tecnico_id',
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
            ->date('fecha_limite')
            ->allowEmptyDate('fecha_limite');

        $validator
            ->date('fecha_inicio')
            ->allowEmptyDate('fecha_inicio');

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
        $rules->add($rules->existsIn(['accione_id'], 'Acciones'), ['errorField' => 'accione_id']);
        $rules->add($rules->existsIn(['tecnico_id'], 'Tecnicos'), ['errorField' => 'tecnico_id']);

        return $rules;
    }
}
