<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher; // Add this line
use Authentication\IdentityInterface;
use Cake\ORM\Entity;

class User extends Entity
{
	protected $_accessible = [
		'email' => true,
		'password' => true,
		'created' => true,
		'modified' => true,
		'esadmin' => true,
		'usuario' => true,
		'tecnico_id' => true,
		'tecnicos' => true,
		'id' => true,
	];

	protected $_hidden = [
		'password',
	];
	
	// Add this method
	protected function _setPassword(string $password) : ?string
	{
		if (strlen($password) > 0) {
			return (new DefaultPasswordHasher())->hash($password);
		}
	}
	
}
