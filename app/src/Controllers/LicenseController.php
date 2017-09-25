<?php

namespace App\Controllers;

use App\Models\Entity\User;
use App\Models\Entity\Vehicle;
use App\Models\Resource\UserResource;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \App\Models\Resource\TripResource;
use \App\Models\Resource\VehicleResource;


class LicenseController
{
	/** @var VehicleResource */
	private $_vehicleResource;

	/** @var TripResource */
	private $_tripResource;

	/** @var UserResource */
	private $_userResource;


	/**
	 * DriverController constructor.
	 *
	 * @param VehicleResource $vehicleResource The resource for vehicle.
	 * @param TripResource    $tripResource    The resource for trip.
	 * @param UserResource    $userResource    The resource for user.
	 */
	public function __construct(VehicleResource $vehicleResource, TripResource $tripResource, UserResource $userResource)
	{
		$this->_vehicleResource = $vehicleResource;
		$this->_tripResource    = $tripResource;
		$this->_userResource    = $userResource;
	}


	/**
	 * Get the driver details of a trip.
	 *
	 * @param Request   $request   The request body.
	 * @param Response  $response  The response body.
	 *
	 * @return Response
	 */
	public function validateDriverLicenseAction(Request $request, Response $response)
	{
		$vehicleId = filter_var($request->getAttribute('vehicleId'), FILTER_VALIDATE_INT);
		$driverId  = filter_var($request->getAttribute('driverId'), FILTER_VALIDATE_INT);

		if ($vehicleId === false) {
			return $response->withStatus(400, 'Invalid vehicleId id');
		}

		if ($driverId === false) {
			return $response->withStatus(400, 'Invalid driverId id');
		}

		$user = $this->_userResource->findById($driverId);

		if (!($user instanceof User) || ($user->getRole() !== User::ROLE_DRIVER)) {
			return $response->withStatus(404, 'No driver found');
		}

		$vehicle = $this->_vehicleResource->getVehicleById($vehicleId);

		if (!($vehicle instanceof Vehicle)) {
			return $response->withStatus(404, 'No vehicle found');
		}

		$hasValidLicense = $this->_userResource->hasValidLicense($user, $vehicle) ? 'true' : 'false';

		$response->getBody()->write(sprintf('{"validation": %s}', $hasValidLicense));

		return $response->withHeader('Content-Type', 'application/json');
	}
}