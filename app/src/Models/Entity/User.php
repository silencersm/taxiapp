<?php

namespace App\Models\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
	const ROLE_CUSTOMER = 1;
	const ROLE_DRIVER   = 2;


	/**
	 * @ORM\Id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;


	/**
	 * @ORM\Column(name="firstname", type="string", length=40)
	 */
	protected $_firstname;


	/**
	 * @ORM\Column(name="surname", type="string", length=40)
	 */
	protected $_surname;


	/**
	 * @ORM\Column(name="email", type="string", length=100)
	 */
	protected $_email;


	/**
	 * @ORM\Column(name="role", type="integer", length=2)
	 */
	protected $_role;


	/**
	 * @ORM\Column(name="password", type="string", length=20)
	 */
	protected $_password;


	/**
	 * @ORM\Column(name="authtoken", type="string", length=20)
	 */
	protected $_authtoken;


	/**
	 * @ORM\Column(name="tokenexpiration", type="datetime")
	 */
	protected $_tokenexpiration;



	/**
	 * Get user id
	 *
	 * @ORM\return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get users's firstname.
	 *
	 * @ORM\return string
	 */
	public function getFirstname()
	{
		return $this->_firstname;
	}


	/**
	 * Get users's surname.
	 *
	 * @ORM\return string
	 */
	public function getSurname()
	{
		return $this->_surname;
	}


	/**
	 * Get users's email.
	 *
	 * @ORM\return string
	 */
	public function getEmail()
	{
		return $this->_email;
	}


	/**
	 * Get users's role.
	 *
	 * @ORM\return integer
	 */
	public function getRole()
	{
		return $this->_role;
	}


	/**
	 * Get users's password.
	 *
	 * @ORM\return string
	 */
	public function getPassword()
	{
		return $this->_password;
	}


	/**
	 * Get users's auth token.
	 *
	 * @ORM\return string
	 */
	public function getAuthToken()
	{
		return $this->_authtoken;
	}


	/**
	 * Get users's auth token.
	 *
	 * @ORM\return datetime
	 */
	public function getTokenepiration()
	{
		return $this->_tokenexpiration;
	}
}