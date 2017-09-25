<?php

namespace App\Models\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicles")
 */
class Vehicle
{
	const TYPE_CAR = 1;
	const TYPE_BUS = 2;

	/**
	 * @ORM\Id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(name="registration", type="string", length=10)
	 */
	protected $registration;

	/**
	 * @ORM\Column(name="type", type="integer", length=2)
	 */
	protected $type;

	/**
	 * @ORM\Column(name="model", type="string", length=100)
	 */
	protected $model;

	/**
	 * @ORM\Column(name="make", type="string", length=100)
	 */
	protected $make;


	/**
	 * Get vehicle id
	 *
	 * @ORM\return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get vehicvle registration
	 *
	 * @ORM\return string
	 */
	public function getRegistration()
	{
		return $this->registration;
	}


	/**
	 * Get vehicle type
	 *
	 * @ORM\return int
	 */
	public function getType()
	{
		return $this->type;
	}


	/**
	 * Get vehicle model
	 *
	 * @ORM\return string
	 */
	public function getModel()
	{
		return $this->model;
	}


	/**
	 * Get vehicle make
	 *
	 * @ORM\return string
	 */
	public function getMake()
	{
		return $this->make;
	}
}