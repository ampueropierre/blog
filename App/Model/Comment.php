<?php
namespace App\Model;

use App\Datetime\DateTimeFrench;

class Comment extends Model
{
	protected $postsId;
	protected $usersId;
	protected $author;
	protected $status;
	protected $content;
	protected $commentDate;

	public function getPostsId()
	{
		return $this->postsId;
	}

	public function getUsersId()
	{
		return $this->usersId;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getContent()
	{
		return $this->content;
	}
	
	public function getCommentDate()
	{
		return $this->commentDate;
	}

	public function setStatus(int $status)
	{
		$this->status = $status;
	}

	public function setPostsId(int $postsId)
	{
		$this->postsId = $postsId;
	}

	public function setUsersId(int $usersId)
	{
		$this->usersId = $usersId;
	}

	public function setAuthor(User $user)
	{
		$this->author = $user;
	}

	public function setCommentDate(DateTimeFrench $commentDate)
	{
		$this->commentDate = $commentDate;
	}

	public function setContent(string $comment)
	{
		$this->comment = $comment;
	}
}
