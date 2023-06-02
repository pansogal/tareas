<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Implicado Entity
 *
 * @property int $id
 * @property int $accione_id
 * @property int $tecnico_id
 * @property \Cake\I18n\FrozenDate|null $fecha_limite
 * @property \Cake\I18n\FrozenDate|null $fecha_inicio
 *
 * @property \App\Model\Entity\Accione $accione
 * @property \App\Model\Entity\Tecnico $tecnico
 */
class Implicado extends Entity
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
        'accione_id' => true,
        'tecnico_id' => true,
        'fecha_limite' => true,
        'fecha_inicio' => true,
        'accione' => true,
        'tecnico' => true,
    ];
}
