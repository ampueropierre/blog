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

	public function setFirstname(string $firstname)
	{
		$this->firstname = $firstname;
	}

	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
	}

	public function setMail(string $mail)
	{
		$this->mail = $mail;
	}

	public function setPassword(string $password)
	{
		$this->password = $password;
	}

}
