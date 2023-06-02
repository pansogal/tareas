<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Confavance Entity
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $lft
 * @property int|null $rght
 * @property string|null $prefijo
 * @property string $cavance
 * @property string|null $explicacion
 *
 * @property \App\Model\Entity\Confavance $parent_confavance
 * @property \App\Model\Entity\Confavance[] $child_confavances
 * @property \App\Model\Entity\Tarea[] $tareas
 */
class Confavance extends Entity
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
        'prefijo' => true,
        'cavance' => true,
        'explicacion' => true,
        'parent_confavance' => true,
        'child_confavances' => true,
        'tareas' => true,
    ];
}
