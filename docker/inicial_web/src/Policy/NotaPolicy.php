<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Nota;
use Authorization\IdentityInterface;

/**
 * Nota policy
 */
class NotaPolicy
{

	public function canAdd(IdentityInterface $user, Nota $nota)
	{
		return $user->getIdentifier() === 1;
	}

	public function canEdit(IdentityInterface $user, Nota $nota)
	{
		return $user->getIdentifier() === 1;
	}

	public function canDelete(IdentityInterface $user, Nota $nota)
	{
		return $user->getIdentifier() === 1;
	}

	public function canView(IdentityInterface $user, Nota $nota)
	{
		return $user->getIdentifier() === 1;
	}
}
