<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Proyecto Entity
 *
 * @property int $id
 * @property int $delegacione_id
 * @property string $lugar
 * @property int $empresa_id
 * @property string $proyecto
 * @property string $codigo
 * @property string $corto
 * @property bool $es_fv
 * @property bool $es_clima
 * @property bool $es_industrial
 * @property bool $es_residencial
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Delegacione $delegacione
 * @property \App\Model\Entity\Empresa $empresa
 * @property \App\Model\Entity\Avance[] $avances
 */
class Proyecto extends Entity
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
        'lugar' => true,
        'empresa_id' => true,
        'proyecto' => true,
        'codigo' => true,
        'corto' => true,
        'es_fv' => true,
        'es_clima' => true,
        'es_industrial' => true,
        'es_residencial' => true,
        'created' => true,
        'modified' => true,
        'delegaciones' => true,
        'empresas' => true,
        'avances' => true,
    ];
}
