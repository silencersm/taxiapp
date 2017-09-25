<?php

namespace App\Controllers;

use App\Models\Renderer\TripsJsonRenderer;
use App\Models\Resource\TripResource;
use App\Models\Resource\UserResource;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Models\Entity\User;


/**
 * Class TripController.
 */
class TripController
{
	/** @var TripResource */
	private $_tripResource;

	/** @var UserResource */
	private $_userResource;

	/**
	 * TripController constructor.
	 *
	 * @param TripResource  $tripResource  The resource for trip.
	 * @param UserResource  $userResource  The resource for user.
	 */
	public function __construct(TripResource $tripResource, UserResource $userResource)
	{
		$this->_tripResource    = $tripResource;
		$this->_userResource    = $userResource;
	}


	/**
	 * Get trips based on driver id.
	 *
	 * @param Request   $request   The request.
	 * @param Response  $response  The response.
	 *
	 * @return Response
	 */
	public function getDriverTripsAction(Request $request, Response $response)
	{
		$id = filter_var($request->getAttribute('driverId'), FILTER_VALIDATE_INT);

		if ($id === false) {
			return $response->withStatus(400, 'Invalid driverId id');
		}

		return $this->_getTripsByUserRole($id, User::ROLE_DRIVER, $response);
	}


	/**
	 * Get trips based on customer id.
	 *
	 * @param Request   $request   The request.
	 * @param Response  $response  The response.
	 *
	 * @return Response
	 */
	public function getCustomerTripsAction(Request $request, Response $response)
	{
		$id = filter_var($request->getAttribute('customerId'), FILTER_VALIDATE_INT);

		if ($id === false) {
			return $response->withStatus(400, 'Invalid customer id');
		}

		return $this->_getTripsByUserRole($id, User::ROLE_CUSTOMER, $response);
	}


	/**
	 * Get the driver details of a trip.
	 *
	 * @param Request   $request   The request body.
	 * @param Response  $response  The response body.
	 *
	 * @return Response
	 */
	public function getCarDriverDetailsAction(Request $request, Response $response)
	{
		$vehicleId = filter_var($request->getAttribute('vehicleId'), FILTER_VALIDATE_INT);

		if ($vehicleId === false) {
			return $response->withStatus(400, 'Invalid vehicleId id');
		}
		$datetime = null;
		$params   = $request->getQueryParams();
		$timezone = new \DateTimeZone('Europe/London');

		if (isset($params['datetime'])) {
			$datetime = \DateTimeImmutable::createFromFormat(
				'd-m-Y H:i:s',
				$params['datetime'],
				$timezone
			);
		} else {
			$datetime = new \DateTimeImmutable('now', $timezone);
		}

		if ($datetime === false) {
			return $response->withStatus(400, 'Invalid datetime');
		}

		$driver = $this->_tripResource->getTripDriver($vehicleId, $datetime);

		$return = $driver === null ? null : $this->_userResource->getDetails($driver);

		$response->getBody()->write(json_encode($return));

		return $response->withHeader('Content-Type', 'application/json');
	}


	/**
	 * Get trips by user role.
	 *
	 * @param int       $userId    The user id.
	 * @param int       $userRole  The user role.
	 * @param Response  $response  The response.
	 *
	 * @return Response
	 */
	protected function _getTripsByUserRole(int $userId, int $userRole, Response $response)
	{
		$user = $this->_userResource->findById($userId);

		if (!($user instanceof User) || ($user->getRole() !== $userRole)) {
			$role = $userRole === User::ROLE_DRIVER ? 'driver' : 'customer';

			return $response->withStatus(404, sprintf('No %s found', $role));
		}

		$tripsRenderer = new TripsJsonRenderer($this->_tripResource->getEntityManager());

		$response->getBody()->write(
			$tripsRenderer->render($this->_tripResource->getTripsByUser($user))
		);

		return $response->withHeader('Content-Type', 'application/json');
	}
}