<?php

namespace App\Model;

use App\Datetime\DateTimeFrench;

/**
 * Class enfant Comment de la classe Model 
 */
class Comment extends Model
{
	/**
	 * l'id du Poste
	 * @var int
	 */
	protected $postsId;
	/**
	 * L'id de l'utilisateur
	 * @var int
	 */
	protected $usersId;
	/**
	 * Classe User
	 * @var object
	 */
	protected $author;
	/**
	 * Le status du commentaire (Valide ou pas)
	 * @var int
	 */
	protected $status;
	/**
	 * Le contenu du commentaire
	 * @var string
	 */
	protected $content;
	/**
	 * Date du commentaire avec la classe DateTime
	 * @var object
	 */
	protected $commentDate;

	/**
	 * Affiche le poste Id du commentaire
	 * @return int
	 */
	public function getPostsId()
	{
		return $this->postsId;
	}

	/**
	 * Affiche l'id de l'utilisateur du poste
	 * @return int
	 */
	public function getUsersId()
	{
		return $this->usersId;
	}

	/**
	 * Retourne la classe User
	 * @return object
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * Retourne le status du commentaire
	 * @return int
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Retourne le conetenu du commentaire
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}
	
	/**
	 * Retourne le date du commentaire
	 * @return object DateTimeFrench
	 */
	public function getCommentDate()
	{
		return $this->commentDate;
	}

	/**
	 * Constuit le status de l'object
	 * @param int $status le status du commentaire
	 */
	public function setStatus(int $status)
	{
		$this->status = $status;
	}

	/**
	 * Construit le poste Id de l'objet
	 * @param int $postsId poste id du commentaire
	 */
	public function setPostsId(int $postsId)
	{
		$this->postsId = $postsId;
	}

	/**
	 * Construit le user id
	 * @param int $userId
	 */
	public function setUsersId(int $usersId)
	{
		$this->usersId = $usersId;
	}

	/**
	 * Récupère le classe User
	 * @param User $user classe User 
	 */
	public function setAuthor(User $user)
	{
		$this->author = $user;
	}

	/**
	 * Construit la date du commentaire
	 * @param DateTimeFrench $commentDate
	 */
	public function setCommentDate(DateTimeFrench $commentDate)
	{
		$this->commentDate = $commentDate;
	}

	/**
	 * Constuit le contenu du commentaire
	 * @param string $content
	 */
	public function setContent(string $content)
	{
		$this->content = $content;
	}
}
