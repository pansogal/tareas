<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parametros Model
 *
 * @property \App\Model\Table\ValoresTable&\Cake\ORM\Association\HasMany $Valores
 *
 * @method \App\Model\Entity\Parametro newEmptyEntity()
 * @method \App\Model\Entity\Parametro newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Parametro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Parametro get($primaryKey, $options = [])
 * @method \App\Model\Entity\Parametro findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Parametro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Parametro[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Parametro|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parametro saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parametro[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parametro[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parametro[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parametro[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ParametrosTable extends Table
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

        $this->setTable('parametros');
        $this->setDisplayField('parametro');
        $this->setPrimaryKey('id');

        $this->hasMany('Valores', [
            'foreignKey' => 'parametro_id',
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
            ->scalar('familia')
            ->maxLength('familia', 20)
            ->notEmptyString('familia');

        $validator
            ->integer('indice')
            ->notEmptyString('indice');

        $validator
            ->scalar('parametro')
            ->maxLength('parametro', 255)
            ->requirePresence('parametro', 'create')
            ->notEmptyString('parametro');

        $validator
            ->boolean('requiere_doc')
            ->notEmptyString('requiere_doc');

        $validator
            ->boolean('puede_otro')
            ->notEmptyString('puede_otro');

        $validator
            ->scalar('describe')
            ->requirePresence('describe', 'create')
            ->notEmptyString('describe');

        return $validator;
    }
}
