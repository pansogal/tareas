<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tarea Entity
 *
 * @property int $id
 * @property string $tarea
 *
 * @property \App\Model\Entity\Asignado[] $asignados
 * @property \App\Model\Entity\Tecnico[] $tecnicos
 */
class Tarea extends Entity
{
	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * Note that when '*' is set to true, this allows all unspecified fields to
	 * be mass assigned. For security purposes, it is advised to set '*' to false
	 * (or remove it), and explicitly make individual fields accessible as needed.
	 *
	 * @var array
	 */
	protected $_accessible = [
		'tarea' => true,
		'codigo' => true,
		'descripcion' => true,
		'documentar' => true,
		'asignados' => true,
		'tecnicos' => true,
		'dura_tipico' => true,

	];
}
