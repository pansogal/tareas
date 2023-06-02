<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\UsersTable;
use Authorization\IdentityInterface;

/**
 * Users policy
 */
class UsersTablePolicy
{
	
	public function scopeTecnico(IdentityInterface $user, $query)
	{
		return $query->where(['Users.id' => $user->getIdentifier()]);
		//return $query;
	}
}
