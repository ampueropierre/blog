<?php
namespace App\Model;

/**
 * 
 */
class User
{
	protected $id;
	protected $firstname;
	protected $lastname;
	protected $mail;

	public function __construct()
	{
		$this->hydrate($data);
	}

	public function hydrate($data)
	{
		foreach ($data as $key => $value)
		{
			$setter = 'set'.ucfirst($key);
			if (method_exists($setter))
			{
				$this->$setter($value);
			}
		}
	}

	public function id()
	{
		return $this->id;
	}

	public function firstname()
	{
		return $this->firstname;
	}

	public function lastname()
	{
		return $this->lastname;
	}

	public function mail()
	{
		return $this->mail;
	}

	public function setId(int $id)
	{
		$this->id = $id;
	}

	public function setFirsname($firstname)
	{
		if (is_string($firstname))
		{
			$this->firstname = $firstname;
		}
	}

	public function setLastname($lastname)
	{
		if (is_string($lastname))
		{
			$this->lastname = $lastname;
		}
	}

	public function setMail($mail)
	{
		if (filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
			$this->mail = $mail;	
		}
	}
}