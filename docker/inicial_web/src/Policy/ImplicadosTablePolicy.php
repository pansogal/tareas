<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\ImplicadosTable;
use Authorization\IdentityInterface;

/**
 * Implicados policy
 */
class ImplicadosTablePolicy
{
	// solo podemos listar las acciones cuyo técnico se corresponda con usuario
	public function scopePanel($user, $query)
	{
		if(!is_null($user->tech->proy))	$query = $query->where(['proyecto_id'=>$user->tech->proy]);
		if(!is_null($user->tech->luzverde)) $query = $query->where(['luzverde'=>$user->tech->luzverde]);
		if(!is_null($user->tech->iniciada)){
			if($user->tech->iniciada == 0) $query = $query->where(['iniciada'=>'NULL']);
			else $query = $query->where(['iniciada <>'=>'NULL']);
		 }
		if(!is_null($user->tech->finalizada)){
			if($user->tech->finalizada == 0) $query = $query->where(['finalizada'=>'NULL']);
			else $query = $query->where(['finalizada <>'=>'NULL']);
		 }

		return $query->where( 
				[ 'tecnico_id'=>$user->tech->id]
			);
	}
}
