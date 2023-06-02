<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Proyecto;
use Authorization\IdentityInterface;

/**
 * Proyecto policy
 */
class ProyectoPolicy
{

	public function canAdd(IdentityInterface $user, Proyecto $proyecto)
	{
	}

	public function canEdit(IdentityInterface $user, Proyecto $proyecto)
	{
	}

	public function canDelete(IdentityInterface $user, Proyecto $proyecto)
	{
	}

	public function canView(IdentityInterface $user, Proyecto $proyecto)
	{
		if($proyecto->delegacione_id == $proyecto->tecnico->delegacione_id)	return true;
		return false;
	}
}
