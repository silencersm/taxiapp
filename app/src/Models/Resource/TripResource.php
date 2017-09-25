<?php

namespace App\Models\Resource;

use App\Models\Entity\Trip;
use App\Models\Entity\User;
use DateTime;

/**
 * Class TripResource.
 */
class TripResource extends AbstractResource
{


	/**
	 * Get the driver of a trip.
	 *
	 * @param int                 $vehicleId  The vehicle id.
	 * @param \DateTimeImmutable  $dateTime   The datetime of trip.
	 *
	 * @return User|null
	 */
	public function getTripDriver(int $vehicleId, \DateTimeImmutable $dateTime)
	{
		$query = $this->_entityManager->getRepository(Trip::class)
			->createQueryBuilder('i')
			->select()
			->where('date(i.datetime) = :dateString')
			->andWhere('i.vehicleId = :vehicleId')
			->setParameter('dateString', $dateTime->format('Y-m-d'))
			->setParameter('vehicleId', $vehicleId)
			->getQuery();

		//Needs custom function for sql Date() function.

		return current($this->_entityManager->getRepository(User::class)->findBy(['id' => $trip->getDriverId()]));
	}


	/**
	 * Get trips by user.
	 *
	 * @param User $user
	 *
	 * @return Trip[]
	 *
	 * @throws \Exception Invalid search id column specified.
	 */
	public function getTripsByUser(User $user)
	{
		$userIdColumn = $user->getRole() === User::ROLE_CUSTOMER ? 'customerId' : 'driverId';
		$criteria = [$userIdColumn => $user->getId()];

		return $this->_entityManager->getRepository(Trip::class)->findBy($criteria);
	}
}