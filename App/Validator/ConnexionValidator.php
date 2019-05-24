<?php

namespace App\Validator;

/**
 * 
 */
class ConnexionValidator extends Validator
{
	const MAIL_EMPTY = '*Le champ mail est vide';
	const PASSWORD_EMPTY = '*Le champ mot de passe est vide';

	public function checkMail($mail)
	{
		if (empty($mail)) {
			$this->errors[] = self::MAIL_EMPTY;
		}
	}

	public function checkPassword($password)
	{
		if (empty($password)) {
			$this->errors[] = self::PASSWORD_EMPTY;
		}
	}



}