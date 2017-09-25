<?php

namespace App\Models\Renderer;

use App\Models\Entity\Trip;
use App\Models\Entity\User;
use App\Models\Entity\Vehicle;
use Doctrine\ORM\EntityManager;

class TripsJsonRenderer
{
	/** @var EntityManager  */
	private $_entityManager;

	/** @var \Doctrine\ORM\EntityRepository  */
	private $_userRepository;

	/** @var \Doctrine\ORM\EntityRepository  */
	private $_vehicleRepository;

	/**
	 * AbstractResource constructor.
	 *
	 * @param EntityManager  $entityManager  The doctrine entity manager.
	 */
	public function __construct(EntityManager $entityManager)
	{
		$this->_entityManager = $entityManager;

		/** @var \Doctrine\ORM\EntityRepository $userRepository */
		$this->_userRepository   = $this->_entityManager->getRepository(User::class);
		$this->_vehicleRepository = $this->_entityManager->getRepository(Vehicle::class);
	}


	/**
	 * Render trips to json.
	 *
	 * @param Trip[] $trips
	 *
	 * @return string
	 */
	public function render(array $trips)
	{
		$result = [];

		/** @var Trip $trip */
		foreach ($trips as $trip) {
//			/** @var User $driverUser */
//			$driverUser = $this->_userRepository->findBy(['id' => $trip->getDriverId()]);
//
//			/** @var User $customerUser */
//			$customerUser = $this->_userRepository->findBy(['id' => $trip->getCustomerId()]);
//
//			$vehicle = $this->_vehicleRepository->findBy(['id' => $trip->getVehicleId());

			$result[] = [
				'id'         => $trip->getId(),
				'driverId'   => $trip->getDriverId(),
				'customerId' => $trip->getCustomerId(),
				'vehicleId'  => $trip->getVehicleId(),
				'fair'       => $trip->getFair(),
				'sourceAddress' => $trip->getSourceAddress(),
				'destinationAddress' => $trip->getDestinationAddress(),
			];
		}

		return json_encode($result);
	}
}