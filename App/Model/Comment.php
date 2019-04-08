<?php
namespace App\Model;

class Comment
{
	private $_id;
	private $_postId;
	private $_author;
	private $_comment;
	private $_commentDate;

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
		return $this->_id;
	}

	public function postId()
	{
		return $this->_postId;
	}

	public function author()
	{
		return $this->_author;
	}

	public function comment()
	{
		return $this->_comment;
	}

	public function commentDate()
	{
		return $this->_commentDate;
	}

	public function setId($id)
	{
		$id = (int) $id;
		if (is_int($id) && $id > 0) {
			$this->_id = $id;
		}
		else {
			trigger_error('L\'id doit etre un nombre entier et superieur à 0', E_USER_WARNING);
		}
	}

	public function setPostId($postId)
	{
		$postId = (int) $postId;
		if (is_int($postId) && $postId > 0) {
			$this->_postId = $postId;
		}
		else {
			trigger_error('L\'id du poste doit etre un nombre entier et superieur à 0', E_USER_WARNING);
		}
	}

	public function setAuthor($author)
	{
		if (is_string($author)) {
			$this->_author = $author;
		}
		else {
			trigger_error('L\'auteur doit etre une chaine de caractères', E_USER_WARNING);
		}
	}

	public function setCommentDate(\DateTime $commentDate)
	{
		$this->_commentDate = $commentDate;
	}

	public function setComment($comment)
	{
		if (is_string($comment)) {
			$this->_comment = $comment;
		}
		else {
			trigger_error('Le commentaire doit etre une chaine de caractères', E_USER_WARNING);
		}
	}
	
}
