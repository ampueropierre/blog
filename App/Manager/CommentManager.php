<?php
namespace App\Manager;

use App\Model\Comment;
use App\Manager\UserManager;

class CommentManager extends Manager
{
	public function getCommentsValide($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, post_id AS postId, author_id AS authorId, status, comment, comment_date AS commentDate FROM comments WHERE post_id = :id AND status = 1 ORDER BY commentDate DESC');
		$req->bindValue(':id', $postId);
		$req->execute();
		$req->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, 'App\Model\Comment');
		$comments =	$req->fetchAll();

		$userManager = new UserManager();

		foreach ($comments as $comment) {
			$comment->setCommentDate(new \DateTime($comment->getCommentDate()));
			$comment->setAuthor($userManager->getUser($comment->getAuthorId()));
		}

		return $comments;
	}

	public function add(Comment $comment)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO comments(post_id, author_id, comment, comment_date) VALUES (:post_id, :author_id, :comment, NOW())');
		$req->bindValue(':post_id', $comment->getPostId());
		$req->bindValue(':author_id', $comment->getAuthorId());
		$req->bindValue(':comment', $comment->getComment());
		
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
		$req->bindValue(':id', $id, /PDO::PARAM_INT);
		$req->execute();
	}

	public function getComment($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, post_id AS postId, author_id AS authorId, status, comment, comment_date AS commentDate FROM comments WHERE id = :id');
		$req->bindValue(':id', $id);
		$req->execute();
		$req->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, 'App\Model\Comment');
		$comment =	$req->fetch();

		$userManager = new UserManager();

		$comment->setCommentDate(new \DateTime($comment->getCommentDate()));
		$comment->setAuthor($userManager->getUser($comment->getAuthorId()));

		return $comment;
	}

	public function listComment()
	{	
		$db = $this->dbConnect();
		$req = $db->query('SELECT id, author_id, status, comment, comment_date as commentDate FROM comments ORDER BY commentDate DESC');
		$req->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, 'App\Model\Comment');
		$comments =	$req->fetchAll();
		
		foreach ($comments as $comment) {
			$comment->setCommentDate(new \DateTime($comment->getCommentDate()));
		}

		return $comments;
	}


}