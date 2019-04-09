<?php
namespace App\Model;

class Post
{
	protected $id;
    protected $title;
    protected $content;
    protected $dateCreation;
	
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
		return $this->id;
	}

	public function title()
	{
		return $this->title;
	}

	public function content()
	{
		return $this->content;
	}

	public function dateCreation()
	{
		return $this->dateCreation;
	}

	public function setId($id)
	{
		$id = (int) $id;

		if (is_int($id) && $id > 0) {
			$this->id = $id;
		}
		else {
			trigger_error('L\'id doit etre un nombre entier et supérieur à 0', E_USER_WARNING);
		}
	}

	public function setTitle($title)
	{
		if (is_string($title) && strlen($title) <= 100) {
			$this->title = $title;
		}
		else {
			trigger_error('Le titre doit etre une chaine de caractères et etre inférieur à 100 caractères',E_USER_WARNING);
		}
	}

	public function setContent($content)
	{
		if (is_string($content)) {
			$this->content = $content;
		}
		else {
			trigger_error('Le contenu doit etre une chaine de caractères',E_USER_WARNING);
		}
	}

	public function setDateCreation(\DateTime $dateCreation)
	{
		$this->dateCreation = $dateCreation;
	}

}
