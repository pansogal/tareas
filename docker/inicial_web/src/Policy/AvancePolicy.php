<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Avance;
use Authorization\IdentityInterface;

/**
 * Avance policy
 */
class AvancePolicy
{
	public function canAdd(IdentityInterface $user, Avance $avance)
	{
	}

	public function canEdit(IdentityInterface $user, Avance $avance)
	{
	}

	public function canDelete(IdentityInterface $user, Avance $avance)
	{
	}

	public function canView(IdentityInterface $user, Avance $avance)
	{
	}
	
	public function canArbol(IdentityInterface $user, Avance $avance)
	{
		return $user->getIdentifier() === 1;
	}
	
}
