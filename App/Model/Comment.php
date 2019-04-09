<?php
namespace App\Model;

class Comment
{
	protected $id;
	protected $postId;
	protected $author;
	protected $comment;
	protected $commentDate;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function hydrate(array $data)
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

	public function postId()
	{
		return $this->postId;
	}

	public function author()
	{
		return $this->author;
	}

	public function comment()
	{
		return $this->comment;
	

	public function commentDate()
	{
		return $this->commentDate;
	}

	public function setId($id)
	{
		$id = (int) $id;
		if (is_int($id) && $id > 0) {
			$this->id = $id;
		}
		else {
			trigger_error('L\'id doit etre un nombre entier et superieur à 0', E_USER_WARNING);
		}
	}

	public function setPostId($postId)
	{
		$postId = (int) $postId;
		if (is_int($postId) && $postId > 0) {
			$this->postId = $postId;
		}
		else {
			trigger_error('L\'id du poste doit etre un nombre entier et superieur à 0', E_USER_WARNING);
		}
	}

	public function setAuthor($author)
	{
		if (is_string($author)) {
			$this->author = $author;
		}
		else {
			trigger_error('L\'auteur doit etre une chaine de caractères', E_USER_WARNING);
		}
	}

	public function setCommentDate(\DateTime $commentDate)
	{
		$this->commentDate = $commentDate;
	}

	public function setComment($comment)
	{
		if (is_string($comment)) {
			$this->comment = $comment;
		}
		else {
			trigger_error('Le commentaire doit etre une chaine de caractères', E_USER_WARNING);
		}
	}
	
}
