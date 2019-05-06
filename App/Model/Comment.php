<?php
namespace App\Model;

class Comment
{
	protected $id;
	protected $postId;
	protected $firstname;
	protected $lastname;
	protected $status;
	protected $comment;
	protected $commentDate;

	public function __construct(array $data = [])
	{
		if (!empty($data))
		{
			$this->hydrate($data);
		}
		
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

	public function status()
	{
		return $this->status;
	}

	public function firstname()
	{
		return $this->firstname;
	}

	public function lastname()
	{
		return $this->lastname;
	}

	public function comment()
	{
		return $this->comment;
	}
	
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
	}

	public function setStatus(int $status)
	{
		$this->status = $status;
	}

	public function setPostId($postId)
	{
		$postId = (int) $postId;
		if (is_int($postId) && $postId > 0) {
			$this->postId = $postId;
		}
	}

	public function setFirstname(string $firstname)
	{
		$this->firstname = $firstname;
	}

	public function setLastname(string $lastname)
	{
		$this->lastname = $lastname;
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
