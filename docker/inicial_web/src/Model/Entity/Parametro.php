<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Parametro Entity
 *
 * @property int $id
 * @property string $familia
 * @property int $indice
 * @property string $parametro
 * @property bool $requiere_doc
 * @property bool $puede_otro
 * @property string $describe
 *
 * @property \App\Model\Entity\Valore[] $valores
 */
class Parametro extends Entity
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
        'familia' => true,
        'indice' => true,
        'parametro' => true,
        'requiere_doc' => true,
        'puede_otro' => true,
        'describe' => true,
        'valores' => true,
    ];
}
