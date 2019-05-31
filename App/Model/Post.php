<?php

namespace App\Model;

use App\Datetime\DateTimeFrench;

/**
 * Classe Post
 */
class Post extends Model
{
	/**
	 * Propriété de la classe Poste
	 * @var string $title le titre du poste
	 * @var int $usersId l'id de l'utilisateur
	 * @var User $author la class User
	 * @var string $chapo le chapo du poste
	 * @var string $img le path de l'image
	 * @var string $content le contenu du poste
	 * @var DateTime $dateCreation la date de création
	 * @var DateTime $dateModification la date de la dernière modification
	 */
    protected $title;
    protected $usersId;
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

	public function getUsersId()
	{
		return $this->usersId;
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

	public function setUsersId(int $usersId)
	{
		$this->usersId = $usersId;
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

	public function setDateCreation(DateTimeFrench $dateCreation)
	{
		$this->dateCreation = $dateCreation;
	}

	public function setDateModification(DateTimeFrench $dateModification)
	{
		$this->dateModification = $dateModification;
	}
}
