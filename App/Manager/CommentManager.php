<?php

namespace App\Manager;

use App\Model\Comment;
use App\Datetime\DateTimeFrench;

class CommentManager extends Manager
{
	public function getListOfValide($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, posts_id AS postsId, users_id AS usersId, status, content, comment_date AS commentDate FROM comments WHERE posts_id = :postsid AND status = :status ORDER BY commentDate DESC');
		$req->bindValue(':postsid', $postId);
		$req->bindValue(':status', 1);
		$req->execute();
		$req->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, 'App\Model\Comment');
		$comments =	$req->fetchAll();
		
		$userManager = new UserManager();

		foreach ($comments as $comment) {
			$comment->setCommentDate(new DateTimeFrench($comment->getCommentDate()));
			$comment->setAuthor($userManager->getUser($comment->getUsersId()));
		}

		return $comments;
	}

	public function add(Comment $comment)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO comments(posts_id, users_id, content, comment_date) VALUES (:posts_id, :users_id, :content, NOW())');
		$req->bindValue(':posts_id', $comment->getPostsId());
		$req->bindValue(':users_id', $comment->getUsersId());
		$req->bindValue(':content', $comment->getContent());
		
		$req->execute();
	}

	public function update(Comment $comment)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE comments SET status = :status WHERE id = :id');
		$req->bindValue(':status', $comment->getStatus());
		$req->bindValue(':id', $comment->getId());
		$req->execute();
	}

	public function delete(int $id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comments WHERE id = :id');
		$req->bindValue(':id', $id, \PDO::PARAM_INT);
		$req->execute();
	}

	public function getComment($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, posts_id AS postsId, users_id AS usersId, status, content, comment_date AS commentDate FROM comments WHERE id = :id');
		$req->bindValue(':id', $id);
		$req->execute();
		$req->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, 'App\Model\Comment');
		$comment =	$req->fetch();

		$userManager = new UserManager();

		$comment->setCommentDate(new DateTimeFrench($comment->getCommentDate()));
		$comment->setAuthor($userManager->getUser($comment->getUsersId()));

		return $comment;
	}

	public function getListOf()
	{	
		$db = $this->dbConnect();
		$req = $db->query('SELECT id, status, content, comment_date as commentDate FROM comments ORDER BY commentDate DESC');
		$req->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, 'App\Model\Comment');
		$comments =	$req->fetchAll();
		
		foreach ($comments as $comment) {
			$comment->setCommentDate(new DateTimeFrench($comment->getCommentDate()));
		}

		return $comments;
	}
}
