<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Asignados Model
 *
 * @property \App\Model\Table\TareasTable&\Cake\ORM\Association\BelongsTo $Tareas
 *
 * @method \App\Model\Entity\Asignado newEmptyEntity()
 * @method \App\Model\Entity\Asignado newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Asignado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Asignado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Asignado findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Asignado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Asignado[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Asignado|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Asignado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Asignado[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Asignado[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Asignado[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Asignado[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AsignadosTable extends Table
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

        $this->setTable('asignados');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Tareas', [
            'foreignKey' => 'tarea_id',
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
        $rules->add($rules->existsIn(['tarea_id'], 'Tareas'), ['errorField' => 'tarea_id']);
        $rules->add($rules->existsIn(['tecnico_id'], 'Tecnicos'), ['errorField' => 'tecnico_id']);

        return $rules;
    }
}
