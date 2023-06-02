<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Confavance;
use Authorization\IdentityInterface;

/**
 * Confavance policy
 */
class ConfavancePolicy
{

	public function canAdd(IdentityInterface $user, Confavance $confavance)
	{
		return $user->getIdentifier() === 1;
	}

	public function canEdit(IdentityInterface $user, Confavance $confavance)
	{
	}

	public function canDelete(IdentityInterface $user, Confavance $confavance)
	{
	}

	public function canView(IdentityInterface $user, Confavance $confavance)
	{
	}

	public function canAsigna(IdentityInterface $user, Confavance $confavance)
	{
		return $user->getIdentifier() === 1;
	}
}
