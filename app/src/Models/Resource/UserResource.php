<?php

namespace App\Models\Resource;

use App\Models\Entity\License;
use App\Models\Entity\User;
use App\Models\Entity\Vehicle;

/**
 * Class UserResource.
 */
class UserResource extends AbstractResource
{

	/**
	 * Get user by id.
	 *
	 * @param int  $userId  The user id.
	 *
	 * @return User|null
	 */
	public function findById(int $userId)
	{
		return current($this->_entityManager->getRepository(User::class)->findBy(['id' => $userId]));
	}


	/**
	 * Check if driver has valid license for vehicle.
	 *
	 * @param User     $user    The user.
 	 * @param Vehicle  $vehicle The vehicle.
	 * @return bool
	 */
	public function hasValidLicense(User $user, Vehicle $vehicle)
	{
		$licenses = $this->_entityManager->getRepository(License::class)->findBy(['userId' => $user->getId()]);

		/** @var License $license */
		foreach ($licenses as $license) {
			if ($license->getType() === $vehicle->getType()) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Get user details.
	 *
	 * @param User $user  The user.
	 * @return array
	 */
	public function getDetails(User $user)
	{
		return [
			'id'        => $user->getId(),
			"firstname" => $user->getFirstname(),
			"surname"   => $user->getSurname(),
			"email"     => $user->getEmail(),
			'role'      => $user->getRole()
		];
	}
}