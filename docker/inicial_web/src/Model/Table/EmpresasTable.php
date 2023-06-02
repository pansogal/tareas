<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EmpresasTable extends Table
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

        $this->setTable('empresas');
        $this->setDisplayField('empresa');
        $this->setPrimaryKey('id');

        $this->hasMany('Contactos', [
            'foreignKey' => 'empresa_id',
        ]);
        $this->hasMany('Proyectos', [
            'foreignKey' => 'empresa_id',
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
            ->scalar('empresa')
            ->maxLength('empresa', 80)
            ->requirePresence('empresa', 'create')
            ->notEmptyString('empresa');

        $validator
            ->scalar('provincia')
            ->maxLength('provincia', 30)
            ->allowEmptyString('provincia');

        $validator
            ->scalar('direccion')
            ->maxLength('direccion', 30)
            ->allowEmptyString('direccion');

        return $validator;
    }
}
