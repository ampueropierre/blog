<?php

namespace App\Validator;

/**
 * Classe abstract Validator
 * Permet de vérifier les données envoyés avant de les traités
 */
abstract class Validator
{
	protected $errors = [];

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function getErrors()
	{
		return $this->errors;
	}

	public function hydrate($data)
	{
		foreach ($data as $key => $value) {
			$setter = 'check'.ucfirst($key);
			if (method_exists($this, $setter)) {
				$this->$setter($value);
			}
		}
	}
}
