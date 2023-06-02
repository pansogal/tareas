<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\ProyectosTable;
use Authorization\IdentityInterface;

/**
 * Proyectos policy
 */
class ProyectosTablePolicy
{
	public function scopeUser($user, $query)
	{
		return $query;
	}

	public function scopeActividades($user, $query)
	{
		if($user->tecnico->central ||  $user->getIdentifier() === 1) return $query;
		return $query->where( 
				[ 'delegacione_id'=>$user->tecnico->delegacione_id]
			);
	}

}
