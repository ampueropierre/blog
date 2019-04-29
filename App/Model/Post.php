<?php
namespace App\Model;

class Post
{
	protected $id;
    protected $title;
    protected $content;
    protected $dateCreation;
    protected $error = [];

    const TITLE_INVALID = 1;
    const CONTENT_INVALID = 2;
	
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

	public function error()
	{
		return $this->error;
	}

	public function setId($id)
	{
		$id = (int) $id;

		if (is_int($id) && $id > 0) {
			$this->id = $id;
		}
	}

	public function setTitle($title)
	{
		if (!is_string($title) || empty($title))
		{
			$this->error[] = self::TITLE_INVALID;
		}

		$this->title = $title;
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

}
