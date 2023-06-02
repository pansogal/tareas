<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Nota extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'parent_id' => true,
        'left' => true,
        'right' => true,
        'user_id' => true,
        'accione_id' => true,
        'titulo' => true,
        'texto' => true,
        'created' => true,
        'modified' => true,
        'parent_nota' => true,
        'user' => true,
        'accione' => true,
        'child_notas' => true,
    ];
}
