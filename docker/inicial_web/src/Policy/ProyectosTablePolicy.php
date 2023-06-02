<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\ProyectosTable;
use Authorization\IdentityInterface;

/**
 * Proyectos policy
 */
class ProyectosTablePolicy
{
	public function scopeUser($user, $query)
	{
		return $query;
	}
}
