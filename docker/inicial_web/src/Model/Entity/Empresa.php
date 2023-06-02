<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Empresa Entity
 *
 * @property int $id
 * @property string $empresa
 * @property string|null $provincia
 * @property string|null $direccion
 *
 * @property \App\Model\Entity\Proyecto[] $proyectos
 */
class Empresa extends Entity
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
        'empresa' => true,
        'provincia' => true,
        'direccion' => true,
        'proyectos' => true,
    ];
}
