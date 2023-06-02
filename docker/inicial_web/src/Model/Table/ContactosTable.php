<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contactos Model
 *
 * @property \App\Model\Table\EmpresasTable&\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\Contacto newEmptyEntity()
 * @method \App\Model\Entity\Contacto newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Contacto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contacto get($primaryKey, $options = [])
 * @method \App\Model\Entity\Contacto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Contacto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Contacto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contacto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contacto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contacto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Contacto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Contacto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Contacto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ContactosTable extends Table
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

        $this->setTable('contactos');
        $this->setDisplayField('persona');
        $this->setPrimaryKey('id');

        $this->belongsTo('Empresas', [
            'foreignKey' => 'empresa_id',
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
            ->scalar('persona')
            ->maxLength('persona', 100)
            ->requirePresence('persona', 'create')
            ->notEmptyString('persona');

        $validator
            ->scalar('rol')
            ->maxLength('rol', 30)
            ->notEmptyString('rol');

        $validator
            ->scalar('tlfno_mail')
            ->maxLength('tlfno_mail', 255)
            ->allowEmptyString('tlfno_mail');

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
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'), ['errorField' => 'empresa_id']);

        return $rules;
    }
}
