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
	protected $password;
	protected $error = [];

	const MAIL_INVALID = 1;
	const PASSWORD_INVALID = 2;
	const FIRSTNAME_INVALID = 3;
	const LASTNAME_INVALID = 4;

	public function hydrate($data)
	{
		foreach ($data as $key => $value)
		{
			$setter = 'set'.ucfirst($key);
			if (method_exists($this, $setter))
			{
				$this->$setter($value);
			}
		}

		return $this;
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

	public function password()
	{
		return $this->password;
	}

	public function error()
	{
		return $this->error;
	}

	public function setId(int $id)
	{
		$this->id = $id;
	}

	public function setFirstname($firstname)
	{
		if (!is_string($firstname) || empty($firstname))
		{
			$this->error[] = self::FIRSTNAME_INVALID;
		}

		$this->firstname = $firstname;
	}

	public function setLastname($lastname)
	{
		if (!is_string($lastname) || empty($lastname))
		{
			$this->error[] = self::LASTNAME_INVALID;
		}

		$this->lastname = $lastname;
	}

	public function setMail($mail)
	{
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL) || empty($mail))
		{
			$this->error[] = self::MAIL_INVALID;
		}

		$this->mail = $mail;
	}

	public function setPassword($password)
	{
		if (!is_string($password) || empty($password))
		{
			$this->error[] = self::PASSWORD_INVALID;
		}

		$this->password = $password;
	}

	public function isValid()
	{
		return !(empty($this->mail) || empty($this->password));
	}


}
