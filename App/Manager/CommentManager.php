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
	public function updateComment($commentId, $author, $comment)
	{
		$db = $this->dbConnect();
		$update = $db->prepare('UPDATE comments SET author = ?, comment = ?, comment_date = NOW() WHERE id = ?');
		$affectedLines = $update->execute(array($author,$comment,$commentId));

		return $affectedLines;
	}

	public function getComment($commentId)
	{
		$db = $this->dbConnect();
		$comment = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
		$comment->execute(array($commentId));

		return $comment->fetch();
	}

}