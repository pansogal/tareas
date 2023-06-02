<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\AccionesTable;
use Authorization\IdentityInterface;

/**
 * Acciones policy
 */
class AccionesTablePolicy
{
	public function scopeUser($user, $query)
	{
		return $query;
	}
}
