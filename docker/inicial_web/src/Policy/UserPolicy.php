<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * User policy
 */
class UserPolicy
{
	public function canAdd(IdentityInterface $user, User $resource)
	{
		return $user->getIdentifier() === 1;
	}

	public function canEdit(IdentityInterface $user, User $resource)
	{
		return $user->getIdentifier() === 1;
	}

	public function canDelete(IdentityInterface $user, User $resource)
	{
		return $user->getIdentifier() === 1;
	}

	public function canView(IdentityInterface $user, User $resource)
	{
		return true;
	}
	
/*	protected function isAdmin(IdentityInterface $user,  User $resource)
	{
	
		return $user->getIdentifier() === 1;
	}
	*/
}
