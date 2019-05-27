<?php

namespace App\Validator;

class ContactValidator extends Validator
{
	const NAME_EMPTY = 'Le champ Nom est vide';
	const MAIL_EMPTY = 'Le champ Mail est vide';
	const MAIL_INVALID = 'L\'adresse mail est invalide';
	const MESSAGE_EMPTY = 'Le champ Message est vide';

	public function checkName($name) {
		if (empty($name)) {
			$this->errors[] = self::NAME_EMPTY;
		}
	}

	public function checkMail($mail) {
		if (empty($mail)) {
			$this->errors[] = self::MAIL_EMPTY;
		}
		elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			$this->errors[] = self::MAIL_INVALID;
		}
	}

	public function checkMessage($message) {
		if (empty($message)) {
			$this->errors[] = self::MESSAGE_EMPTY;
		}
	}

}
