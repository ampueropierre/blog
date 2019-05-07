<?php
namespace App\Model;

/**
 * 
 */
class User extends Model
{
	protected $firstname;
	protected $lastname;
	protected $mail;
	protected $password;

	public function getFirstname()
	{
		return $this->firstname;
	}

	public function getLastname()
	{
		return $this->lastname;
	}

	public function getMail()
	{
		return $this->mail;
	}

	public function getPassword()
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

	public function setLastname(string $lastname)
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
