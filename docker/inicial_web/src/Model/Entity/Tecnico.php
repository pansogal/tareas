<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tecnico Entity
 *
 * @property int $id
 * @property int $delegacione_id
 * @property string $nombre
 *
 * @property \App\Model\Entity\Delegacione $delegacione
 * @property \App\Model\Entity\Asignado[] $asignados
 * @property \App\Model\Entity\Implicado[] $implicados
 */
class Tecnico extends Entity
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
        'delegacione_id' => true,
        'nombre' => true,
        'cargo' => true,
        'central' => true,
        'delegacione' => true,
        'asignados' => true,
        'implicados' => true,
    ];
}
