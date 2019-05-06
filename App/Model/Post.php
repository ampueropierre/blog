<?php
namespace App\Model;

class Post
{
	protected $id;
    protected $title;
    protected $authorId;
    protected $firstname;
    protected $lastname;
    protected $chapo;
    protected $content;
    protected $dateCreation;
    protected $dateModification;
	
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

	public function authorId()
	{
		return $this->authorId;
	}

	public function firstname()
	{
		return $this->firstname;
	}

	public function lastname()
	{
		return $this->lastname;
	}

	public function chapo()
	{
		return $this->chapo;
	}

	public function content()
	{
		return $this->content;
	}

	public function dateCreation()
	{
		return $this->dateCreation;
	}

	public function dateModification()
	{
		return $this->dateModification;
	}

	public function setId($id)
	{
		$id = (int) $id;

		if (is_int($id) && $id > 0) {
			$this->id = $id;
		}
	}

	public function setAuthorId(int $authorId)
	{
		$this->authorId = $authorId;
	}

	public function setFirstname(string $firstname)
	{
		$this->firstname = $firstname;
	}

	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
	}

	public function setTitle($title)
	{
		if (!is_string($title) || empty($title))
		{
			$this->error[] = self::TITLE_INVALID;
		}

		$this->title = $title;
	}

	public function setChapo(string $chapo)
	{
		$this->chapo = $chapo;
	}

	public function setContent($content)
	{
		if (!is_string($content) || empty($content))
		{
			$this->error[] = self::CONTENT_INVALID;
		}

		$this->content = $content;

	}

	public function setDateCreation(\DateTime $dateCreation)
	{
		$this->dateCreation = $dateCreation;
	}

	public function setDateModification(\DateTime $dateModification)
	{
		$this->dateModification = $dateModification;
	}

}
