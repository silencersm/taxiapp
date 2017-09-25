<?php

namespace App\Models\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="trips")
 */
class Trip
{
	/**
	 * @ORM\Id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;


	/**
	 * @ORM\Column(name="driverId", type="integer")
	 */
	protected $driverId;


	/**
	 * @ORM\Column(name="customerId", type="integer")
	 */
	protected $customerId;


	/**
	 * @ORM\Column(name="vehicleId", type="integer")
	 */
	protected $vehicleId;


	/**
	 * @ORM\Column(name="sourceAddress", type="string", length=300)
	 */
	protected $sourceAddress;


	/**
	 * @ORM\Column(name="destinationAddress", type="string", length=300)
	 */
	protected $destinationAddress;


	/**
	 * @ORM\Column(name="fair", type="float", length=10)
	 */
	protected $fair;


	/**
	 * @ORM\Column(name="datetime", type="datetime")
	 */
	protected $datetime;


	/**
	 * Get the trip id.
	 *
	 * @ORM\return integer
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * Get the driver id.
	 *
	 * @ORM\return integer
	 */
	public function getDriverId()
	{
		return $this->driverId;
	}


	/**
	 * Get the customer/user id.
	 *
	 * @ORM\return integer
	 */
	public function getCustomerId()
	{
		return $this->customerId;
	}


	/**
	 * Get the vehicle id.
	 *
	 * @ORM\return integer
	 */
	public function getVehicleId()
	{
		return $this->vehicleId;
	}


	/**
	 * Get the source address.
	 *
	 * @ORM\return string
	 */
	public function getSourceAddress()
	{
		return $this->sourceAddress;
	}


	/**
	 * Get the destination address.
	 *
	 * @ORM\return string
	 */
	public function getDestinationAddress()
	{
		return $this->destinationAddress;
	}


	/**
	 * Get the trip fair.
	 *
	 * @ORM\return string
	 */
	public function getFair()
	{
		return $this->fair;
	}


	/**
	 * Get the trip datetime.
	 *
	 * @ORM\return date
	 */
	public function getDatetime()
	{
		return $this->datetime;
	}
}