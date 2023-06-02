<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Implicado;
use Authorization\IdentityInterface;

class ImplicadoPolicy
{
	public function canAdd(IdentityInterface $user, Implicado $implicado)
	{
	}

	public function canEdit(IdentityInterface $user, Implicado $implicado)
	{
		if( $user->getIdentifier() == $implicado->tech->usrid) return true;
		
		return $user->getIdentifier() === 1;
	}

	public function canDelete(IdentityInterface $user, Implicado $implicado)
	{
	}

	public function canView(IdentityInterface $user, Implicado $implicado)
	{
	}
}
