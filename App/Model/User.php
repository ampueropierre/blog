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

	const MAIL_INVALID = 1;
	const PASSWORD_INVALID = 2;
	const FIRSTNAME_INVALID = 3;

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

	public function setId(int $id)
	{
		$this->id = $id;
	}

	public function setFirstname($firstname)
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
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL) || empty($mail))
		{
			$error = self::MAIL_INVALID;
		}

		$this->mail = $mail;
	}

	public function setPassword($password)
	{
		if (!is_string($password) || empty($password))
		{
			$error = self::PASSWORD_INVALID;
		}

		$this->password = $password;
	}

	public function isValid()
	{
		return !(empty($this->mail) || empty($this->password));
	}


}
