<?php
namespace App\Model;

class Comment extends Model
{
	protected $postId;
	protected $authorId;
	protected $author;
	protected $status;
	protected $comment;
	protected $commentDate;

	public function getId()
	{
		return $this->id;
	}

	public function getPostId()
	{
		return $this->postId;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getAuthorId()
	{
		return $this->authorId;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getComment()
	{
		return $this->comment;
	}
	
	public function getCommentDate()
	{
		return $this->commentDate;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setStatus(int $status)
	{
		$this->status = $status;
	}

	public function setPostId(int $postId)
	{
		$this->postId = $postId;
	}

	public function setAuthorId(int $authorId)
	{
		$this->authorId = $authorId;
	}

	public function setAuthor(User $user)
	{
		$this->author = $user;
	}

	public function setCommentDate(\DateTime $commentDate)
	{
		$this->commentDate = $commentDate;
	}

	public function setComment(string $comment)
	{
		$this->comment = $comment;
	}
	
}
