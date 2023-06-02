<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Valore Entity
 *
 * @property int $id
 * @property int $parametro_id
 * @property int $proyecto_id
 * @property string $valor
 * @property string $siguiente
 *
 * @property \App\Model\Entity\Parametro $parametro
 * @property \App\Model\Entity\Proyecto $proyecto
 */
class Valore extends Entity
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
        'parametro_id' => true,
        'proyecto_id' => true,
        'valor' => true,
        'siguiente' => true,
        'parametro' => true,
        'proyecto' => true,
    ];
}
