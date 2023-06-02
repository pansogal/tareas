<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class DelegacionesTable extends Table
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

        $this->setTable('delegaciones');
        $this->setDisplayField('delegacion');
        $this->setPrimaryKey('id');

        $this->hasMany('Proyectos', [
            'foreignKey' => 'delegacione_id',
        ]);
        
        $this->hasMany('Tecnicos', [
            'foreignKey' => 'delegacione_id',
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
            ->scalar('delegacion')
            ->maxLength('delegacion', 50)
            ->requirePresence('delegacion', 'create')
            ->notEmptyString('delegacion');

        $validator
            ->scalar('corto')
            ->maxLength('corto', 5)
            ->requirePresence('corto', 'create')
            ->notEmptyString('corto');

        return $validator;
    }
}
