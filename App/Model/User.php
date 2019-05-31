<?php

namespace App\Model;

/**
 * Classe User
 */
class User extends Model
{
	/**
	 * Propriété de la classe User
	 * @var string le prénom de l'utilisateur
	 * @var string le nom de l'utilisateur
	 * @var string le mail
	 * @var string le mot de passe
	 * @var int l'id du rôle
	 * @var string le non du rôle
	 */
	protected $firstname;
	protected $lastname;
	protected $mail;
	protected $password;
	protected $rolesId;
	protected $roleName;

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

	public function getRolesId()
	{
		return $this->rolesId;
	}

	public function getRoleName()
	{
		return $this->roleName;
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

	public function setRolesId(int $rolesId)
	{
		$this->rolesId = $rolesId;
	}

	public function setRoleName(string $roleName)
	{
		$this->roleName = $roleName;
	}
}
