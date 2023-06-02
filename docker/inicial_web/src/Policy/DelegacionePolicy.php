<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Delegacione;
use Authorization\IdentityInterface;

/**
 * Delegacione policy
 */
class DelegacionePolicy
{
	public function canAdd(IdentityInterface $user, Delegacione $delegacione)
	{
		return $user->getIdentifier() === 1;
	}

	/**
	 * Check if $user can edit Delegacione
	 *
	 * @param \Authorization\IdentityInterface $user The user.
	 * @param \App\Model\Entity\Delegacione $delegacione
	 * @return bool
	 */
	public function canEdit(IdentityInterface $user, Delegacione $delegacione)
	{
		return $user->getIdentifier() === 1;
	}

	/**
	 * Check if $user can delete Delegacione
	 *
	 * @param \Authorization\IdentityInterface $user The user.
	 * @param \App\Model\Entity\Delegacione $delegacione
	 * @return bool
	 */
	public function canDelete(IdentityInterface $user, Delegacione $delegacione)
	{
	}

	/**
	 * Check if $user can view Delegacione
	 *
	 * @param \Authorization\IdentityInterface $user The user.
	 * @param \App\Model\Entity\Delegacione $delegacione
	 * @return bool
	 */
	public function canView(IdentityInterface $user, Delegacione $delegacione)
	{
		if($delegacione->id == $delegacione->tecnico->delegacione_id) return true;
		else{
			if( $user->getIdentifier() == 1 ) return true;
		}
		return false;
	}
}
