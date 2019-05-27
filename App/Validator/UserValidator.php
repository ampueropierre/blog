<?php

namespace App\Validator;

use App\Manager\UserManager;

class UserValidator extends Validator
{
	const FIRSTNAME_EMPTY = '*Le champ prénom est vide';
	const LASTNAME_EMPTY = '*Le champ nom est vide';
	const MAIL_EMPTY = '*Le champ mail est vide';
	const PASSWORD_EMPTY = '*Le champ mot de passe est vide';
	const MAIL_EXIST = 'Ce mail existe déjà';
	const PASSWORD_LENGHT = '*Le mot de passe doit être supérieur ou égal à 8 caractères';
	const ROLE_NOTEXIST = 'Ce role n\'existe pas';

	public function checkFirstname($firstname)
	{
		if (empty($firstname)) {
			$this->errors[] = self::FIRSTNAME_EMPTY;
		}
	}

	public function checkLastname($lastname)
	{
		if (empty($lastname)) {
			$this->errors[] = self::LASTNAME_EMPTY;
		}
	}

	public function checkMail($mail)
	{
		$userManager = new UserManager();

		if (empty($mail)) {
			$this->errors[] = self::MAIL_EMPTY;
		}
	}

	public function checkMailExist($mail)
	{
		$userManager = new UserManager();
		if ($userManager->mailExist($mail)) {
			$this->errors[] = self::MAIL_EXIST;
		}
	}

	public function checkPassword($password)
	{
		if (empty($password)) {
			$this->errors[] = self::PASSWORD_EMPTY;
		} elseif (strlen($password) < 8) {
			$this->errors[] = self::PASSWORD_LENGHT;
		}
	}

	public function checkRole(int $role)
	{
		if ($role != 2 AND $role != 3) {
			$this->errors[] = self::ROLE_NOTEXIST;
		}
	}

}

