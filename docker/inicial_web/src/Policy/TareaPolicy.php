<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Tarea;
use Authorization\IdentityInterface;

/**
 * Tarea policy
 */
class TareaPolicy
{

	public function canAdd(IdentityInterface $user, Tarea $tarea)
	{
		return $user->getIdentifier() === 1;
	}

	public function canEdit(IdentityInterface $user, Tarea $tarea)
	{
		return $user->getIdentifier() === 1;
	}

	public function canDelete(IdentityInterface $user, Tarea $tarea)
	{
	}

	public function canView(IdentityInterface $user, Tarea $tarea)
	{
	}

	public function canSemaforoOn(IdentityInterface $user, Tarea $tarea)
	{
		return $user->getIdentifier() === 1;
	}

	public function canSemaforoOff(IdentityInterface $user, Tarea $tarea)
	{
		return $user->getIdentifier() === 1;
	}
	
	public function canLibera(IdentityInterface $user, Tarea $tarea)
	{
		return $user->getIdentifier() === 1;
	}

	public function canAsigna(IdentityInterface $user, Tarea $tarea)
	{
		return $user->getIdentifier() === 1;
	}
}
