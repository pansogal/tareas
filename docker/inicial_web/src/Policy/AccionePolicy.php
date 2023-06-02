<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Accione;
use Authorization\IdentityInterface;

/**
 * Accione policy
 */
class AccionePolicy
{

	public function canAdd(IdentityInterface $user, Accione $accione)
	{
	}

	public function canEdit(IdentityInterface $user, Accione $accione)
	{
		foreach($accione->tecnicos as $asignado){
			if( $accione->usertec->id == $asignado->id) return true;
		}
		return $user->getIdentifier() === 1;
	}

	public function canDelete(IdentityInterface $user, Accione $accione)
	{
	}

	public function canView(IdentityInterface $user, Accione $accione)
	{
		return $user->getIdentifier() === 1;
	}
}
