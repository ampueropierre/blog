<?php

namespace App\Validator;

/**
 * 
 */
class ConnexionValidator
{
	
	protected $errors = [];

	const MAIL_INVALID = 1;
	const PASSWORD_INVALID = 2;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function errors()
	{
		return $this->errors;
	}

	public function hydrate($data)
	{
		foreach ($data as $key => $value) {
			$setter = 'set'.ucfirst($key);
			if (method_exists($this, $setter)) {
				$this->$setter($value);
			}
		}
	}

	public function setMail($mail)
	{
		if (empty($mail)) {
			$this->errors[] = self::MAIL_INVALID;
		}
	}

	public function setPassword($password)
	{
		if (empty($password)) {
			$this->errors[] = self::PASSWORD_INVALID;
		}
	}



}