<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProyectosTable extends Table
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

		$this->setTable('proyectos');
		$this->setDisplayField('corto');
		$this->setPrimaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('Delegaciones', [
			'foreignKey' => 'delegacione_id',
		]);
		$this->belongsTo('Empresas', [
			'foreignKey' => 'empresa_id',
		]);
		$this->hasMany('Avances', [
			'dependent' => true,
			'cascadeCallbacks' => true,
			'foreignKey' => 'proyecto_id',
		]);
		$this->hasMany('Valores', [
			'dependent' => true,
			'foreignKey' => 'proyecto_id',
		]);
		$this->belongsToMany('Parametros', [
			'dependent' => true,
			'joinTable' => 'Valores',
			'sort' => ['familia'=>'ASC', 'indice'=>'ASC',],
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
			->scalar('lugar')
			->maxLength('lugar', 80)
			->requirePresence('lugar', 'create')
			->notEmptyString('lugar');

		$validator
			->scalar('proyecto')
			->maxLength('proyecto', 255)
			->requirePresence('proyecto', 'create')
			->notEmptyString('proyecto');

		$validator
			->scalar('codigo')
			->maxLength('codigo', 10)
			->requirePresence('codigo', 'create')
			->notEmptyString('codigo');

		$validator
			->scalar('corto')
			->maxLength('corto', 50)
			->requirePresence('corto', 'create')
			->notEmptyString('corto');

		$validator
			->boolean('es_fv')
			->notEmptyString('es_fv');

		$validator
			->boolean('es_clima')
			->notEmptyString('es_clima');

		$validator
			->boolean('es_industrial')
			->notEmptyString('es_industrial');

		$validator
			->boolean('es_residencial')
			->notEmptyString('es_residencial');

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
		$rules->add($rules->existsIn(['delegacione_id'], 'Delegaciones'), ['errorField' => 'delegacione_id']);
		$rules->add($rules->existsIn(['empresa_id'], 'Empresas'), ['errorField' => 'empresa_id']);

		return $rules;
	}
}
