<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Avance Entity
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $lft
 * @property int|null $rght
 * @property int $proyecto_id
 * @property string $avance
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $completado
 *
 * @property \App\Model\Entity\Proyecto $proyecto
 * @property \App\Model\Entity\Accione[] $acciones
 */
class Avance extends Entity
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
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'proyecto_id' => true,
        'avance' => true,
	'prefix' => true,
	'created' => true,
        'modified' => true,
        'completado' => true,
        'proyecto' => true,
        'acciones' => true,
    ];
}
