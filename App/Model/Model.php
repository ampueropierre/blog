<?php

namespace App\Model;

/**
 * Class Model
 */
abstract class Model
{
	/**
	 * Id of class
	 * @var int
	 */
	protected $id;

	/**
	 * Create instance
	 * @param array $data
	 */
	function __construct(array $data = [])
	{
		$this->hydrate($data);
	}

	/**
	 * hydrate object
	 * @param array $data
	 * @return
	 */
	public function hydrate($data)
	{
		foreach ($data as $key => $value)
		{
			$setter = 'set'.ucfirst($key);
			if (method_exists($this, $setter))
			{
				$this->$setter($value);
			}
		}

		return $this;
	}

	/**
	 * Get Id
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Construct id
	 * @param int $id
	 */
	public function setId(int $id)
	{
		$this->id = $id;
	}
}
