<?php
namespace App\Validator;

/**
 * 
 */
class PostValidator
{
	protected $errors = [];

	const TITLE_INVALID = 1;
	const CONTENT_INVALID = 2;

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

	public function setTitle($title)
	{
		if (empty($title)) {
			$this->errors[] = self::TITLE_INVALID;
		}
	}

	public function setContent($content)
	{
		if (empty($content)) {
			$this->errors[] = self::CONTENT_INVALID;
		}
	}
}