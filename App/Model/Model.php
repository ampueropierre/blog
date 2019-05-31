<?php

namespace App\Model;

/**
 * Class Model classe parente
 */
abstract class Model
{
	/**
	 * l'id de la classe
	 * @var int
	 */
	protected $id;

	/**
	 * Permet d'hydrater l'objet
	 * @param array $data récupère un tableau de donnée
	 */
	function __construct(array $data = [])
	{
		$this->hydrate($data);
	}

	/**
	 * Fonction hydrate
	 * @param array $data
	 * @return method retourne la methode en fonction de la valeur récupérer
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
	 * Retourne l'id
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * constructeur de l'id
	 * @param int $id
	 */
	public function setId(int $id)
	{
		$this->id = $id;
	}
}
