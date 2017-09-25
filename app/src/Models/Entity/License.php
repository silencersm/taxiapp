<?php

namespace App\Models\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="licences")
 */
class License
{
	const LICENSE_TYPE_CAR = 1;
	const LICENSE_TYPE_BUS = 2;


	/**
	 * @ORM\Id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;


	/**
	 * @ORM\Column(name="userId", type="integer", length=10)
	 */
	protected $userId;


	/**
	 * @ORM\Column(name="type", type="integer", length=2)
	 */
	protected $type;


	/**
	 * Get the license id.
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * Get the user id.
	 *
	 * @return integer
	 */
	public function getUserId()
	{
		return $this->userId;
	}


	/**
	 * Get the licence type.
	 *
	 * @return integer
	 */
	public function getType()
	{
		return $this->type;
	}
}