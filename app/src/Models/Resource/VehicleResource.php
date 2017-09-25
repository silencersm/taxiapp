<?php

namespace App\Models\Resource;

use App\Models\Entity\Vehicle;

/**
 * Class VehicleResource.
 */
class VehicleResource extends AbstractResource
{

	/**
	 * Get vehicle by id.
	 *
	 * @param int  $vehicleId  The vehicle id.
	 *
	 * @return Vehicle|null
	 */
	public function getVehicleById(int $vehicleId)
	{
		return current($this->_entityManager->getRepository(Vehicle::class)->findBy(['id' => $vehicleId]));
	}
}