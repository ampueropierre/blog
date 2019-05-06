<?php
namespace App\Model;

/**
 * 
 */
abstract class Model
{
	protected $id;

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
}