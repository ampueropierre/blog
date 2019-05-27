<?php

namespace App\Validator;

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
