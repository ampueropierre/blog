<?php
namespace App\Model;

class Post extends Model
{
    protected $title;
    protected $authorId;
    protected $author;
    protected $chapo;
    protected $img;
    protected $content;
    protected $dateCreation;
    protected $dateModification;

	public function getTitle()
	{
		return $this->title;
	}

	public function getAuthorId()
	{
		return $this->authorId;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getChapo()
	{
		return $this->chapo;
	}

	public function getImg()
	{
		return $this->img;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getDateCreation()
	{
		return $this->dateCreation;
	}

	public function getDateModification()
	{
		return $this->dateModification;
	}

	public function setId(int $id)
	{
		$this->id = $id;
	}

	public function setAuthorId(int $authorId)
	{
		$this->authorId = $authorId;
	}

	public function setAuthor(User $user)
	{
		$this->author = $user;
	}

	public function setTitle(string $title)
	{

		$this->title = $title;
	}

	public function setChapo(string $chapo)
	{
		$this->chapo = $chapo;
	}

	public function setImg(string $img)
	{
		$this->img = $img;
	}

	public function setContent(string $content)
	{

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
