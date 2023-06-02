<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contacto Entity
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $persona
 * @property string $rol
 * @property string|null $tlfno_mail
 *
 * @property \App\Model\Entity\Empresa $empresa
 */
class Contacto extends Entity
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
        'empresa_id' => true,
        'persona' => true,
        'rol' => true,
        'tlfno_mail' => true,
        'empresa' => true,
    ];
}
