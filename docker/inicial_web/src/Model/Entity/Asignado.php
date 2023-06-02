<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Asignado Entity
 *
 * @property int $id
 * @property int $tarea_id
 * @property int $tecnico_id
 *
 * @property \App\Model\Entity\Tarea $tarea
 */
class Asignado extends Entity
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
        'tarea_id' => true,
        'tecnico_id' => true,
        'tarea' => true,
    ];
}
