<?php
namespace App\Validator;

use App\Manager\UserManager;

/**
 * 
 */
class UserValidator extends Validator
{
	const FIRSTNAME_EMPTY = 'Le champ est vide';
	const LASTNAME_EMPTY = 'Le champ est vide';
	const MAIL_EMPTY = 'Le champ est vide';
	const PASSWORD_EMPTY = 'Le champ est vide';
	const MAIL_EXIST = 'Ce mail existe déjà';
	const PASSWORD_LENGHT = 'Le mot de passe doit être supérieur ou égal à 8 caractères';

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
		} elseif ($userManager->mailExist($mail)) {
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

}

