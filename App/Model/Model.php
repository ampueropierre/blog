<?php
namespace App\Model;

/**
 * 
 */
abstract class Model
{
	protected $id;

	function __construct(array $data = [])
	{
		$this->hydrate($data);
	}

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

	public function getId()
	{
		return $this->id;
	}

	public function setId(int $id)
	{
		$this->id = $id;
	}
}