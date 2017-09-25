<?php

namespace App\Models\Resource;

use Doctrine\ORM\EntityManager;

abstract class AbstractResource
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $_entityManager = null;

	/**
	 * AbstractResource constructor.
	 *
	 * @param EntityManager  $entityManager  The doctrine entity manager.
	 */
	public function __construct(EntityManager $entityManager)
	{
		$this->_entityManager = $entityManager;
	}


	/**
	 * Get the entity manager.
	 *
	 * @return EntityManager
	 */
	public function getEntityManager()
	{
		return $this->_entityManager;
	}
}