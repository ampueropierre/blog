<?php
namespace App\Model;

class Post
{
	private $_id,
			$_title,
			$_content,
			$_dateCreation;
	
	function __construct(array $data)
	{
		$this->hydrate($data);
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

	public function id()
	{
		return $this->_id;
	}

	public function title()
	{
		return $this->_title;
	}

	public function content()
	{
		return $this->_content;
	}

	public function dateCreation()
	{
		return $this->_dateCreation;
	}

	public function setId($id)
	{
		$id = (int) $id;

		if (is_int($id) && $id > 0) {
			$this->_id = $id;
		}
		else {
			trigger_error('L\'id doit etre un nombre entier et supérieur à 0', E_USER_WARNING);
		}
	}

	public function setTitle($title)
	{
		if (is_string($title) && strlen($title) <= 100) {
			$this->_title = $title;
		}
		else {
			trigger_error('Le titre doit etre une chaine de caractères et etre inférieur à 100 caractères',E_USER_WARNING);
		}
	}

	public function setContent($content)
	{
		if (is_string($content)) {
			$this->_content = $content;
		}
		else {
			trigger_error('Le contenu doit etre une chaine de caractères',E_USER_WARNING);
		}
	}

	public function setDateCreation(\DateTime $dateCreation)
	{
		$this->_dateCreation = $dateCreation;
	}

}