<?php
namespace App\Manager;

use App\Model\Comment;

class CommentManager extends Manager
{
	public function getComments($postId)
	{
		$tab = [];
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, author, comment, comment_date AS commentDate FROM comments WHERE post_id = ? ORDER BY commentDate DESC');
		$comments->execute(array($postId));

		while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
			$data['commentDate'] = new \DateTime($data['commentDate']);
			$tab[] = new Comment($data);
		}

		return $tab;
	}

	public function postComment($postId, $author, $comment)
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES (?,?,?,NOW())');
		$affectedLines = $comments->execute(array($postId,$author,$comment));

		return $affectedLines;
	}

	// Modifier des commentaire
	public function updateComment(Comment $comment)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE comments SET author = :author, comment = :comment, comment_date = NOW() WHERE id = :id');
		$req->bindValue(':author', $comment->author());
		$req->bindValue(':comment', $comment->comment());
		$req->bindValue(':id', $comment->id());

		$req->execute();

	}

	public function getComment($commentId)
	{
		$db = $this->dbConnect();
		$q = $db->prepare('SELECT id, post_id AS postId, author, comment, comment_date AS commentDate FROM comments WHERE id = :id');
		$q->bindValue(':id', $commentId);
		$q->execute();

		$tab = $q->fetch(\PDO::FETCH_ASSOC);

		$tab['commentDate'] = new \DateTime($tab['commentDate']);

		$comment = new Comment($tab);

		return $comment;
	}

}