<?php
namespace App\Validator;

use App\Manager\UserManager;

/**
 * 
 */
class UserValidator
{
	protected $errors = [];

	const FIRSTNAME_INVALID = 1;
	const LASTNAME_INVALID = 2;
	const MAIL_INVALID = 3;
	const PASSWORD_INVALID = 4;
	const MAIL_EXIST = 5;
	const PASSWORD_LENGHT = 6;

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

	public function setFirstname($firstname)
	{
		if (empty($firstname)) {
			$this->errors[] = self::FIRSTNAME_INVALID;
		}
	}

	public function setLastname($lastname)
	{
		if (empty($lastname)) {
			$this->errors[] = self::LASTNAME_INVALID;
		}
	}

	public function setMail($mail)
	{
		$userManager = new UserManager();

		if (empty($mail)) {
			$this->errors[] = self::MAIL_INVALID;
		} elseif ($userManager->mailExist($mail)) {
			$this->errors[] = self::MAIL_EXIST;
		}
	}

	public function setPassword($password)
	{
		if (empty($password)) {
			$this->errors[] = self::PASSWORD_INVALID;
		} elseif (strlen($password) < 8) {
			$this->errors[] = self::PASSWORD_LENGHT;
		}
	}

}

