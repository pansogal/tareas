<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Tecnico;
use Authorization\IdentityInterface;

/**
 * Tecnico policy
 */
class TecnicoPolicy
{

	public function canAdd(IdentityInterface $user, Tecnico $tecnico)
	{
		return $user->getIdentifier() === 1;
	}

	/**
	 * Check if $user can edit Tecnico
	 *
	 * @param \Authorization\IdentityInterface $user The user.
	 * @param \App\Model\Entity\Tecnico $tecnico
	 * @return bool
	 */
	public function canEdit(IdentityInterface $user, Tecnico $tecnico)
	{
		if($tecnico->tech->id == $tecnico->id ) return true;
		return $user->getIdentifier() === 1;
	}

	/**
	 * Check if $user can delete Tecnico
	 *
	 * @param \Authorization\IdentityInterface $user The user.
	 * @param \App\Model\Entity\Tecnico $tecnico
	 * @return bool
	 */
	public function canDelete(IdentityInterface $user, Tecnico $tecnico)
	{
		return true;
	}

	/**
	 * Check if $user can view Tecnico
	 *
	 * @param \Authorization\IdentityInterface $user The user.
	 * @param \App\Model\Entity\Tecnico $tecnico
	 * @return bool
	 */
	public function canView(IdentityInterface $user, Tecnico $tecnico)
	{
		return true;
	}
}
