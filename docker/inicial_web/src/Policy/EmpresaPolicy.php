<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Empresa;
use Authorization\IdentityInterface;

/**
 * Empresa policy
 */
class EmpresaPolicy
{
	public function canAdd(IdentityInterface $user, Empresa $empresa)
	{
		return $user->getIdentifier() === 1;    
	}

	public function canEdit(IdentityInterface $user, Empresa $empresa)
	{
		return $user->getIdentifier() === 1;    
	}

	public function canDelete(IdentityInterface $user, Empresa $empresa)
	{
		return $user->getIdentifier() === 1;    
	}

	public function canView(IdentityInterface $user, Empresa $empresa)
	{
		return true;
	}
}
