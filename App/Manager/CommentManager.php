<?php
namespace App\Manager;

use App\Model\Comment;

class CommentManager extends Manager
{
	public function getCommentsValide($postId)
	{
		$tab = [];

		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT comments.id, firstname, lastname, status, comment, comment_date AS commentDate FROM comments INNER JOIN users ON comments.author_id = users.id WHERE post_id = :id AND status = 1 ORDER BY commentDate DESC');

		$comments->bindValue(':id', $postId);

		$comments->execute();

		while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
			$data['commentDate'] = new \DateTime($data['commentDate']);
			$tab[] = new Comment($data);
		}

		return $tab;
	}

	public function add($postId, $authorId, $comment)
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('INSERT INTO comments(post_id, authorId, comment, comment_date) VALUES (?,?,?,NOW())');
		$affectedLines = $comments->execute(array($postId,$author,$comment));

		return $affectedLines;
	}

	// Modifier des commentaire
	public function update(array $comment)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE comments SET status = :status WHERE id = :id');
		$req->bindValue(':status', $comment['status']);
		$req->bindValue(':id', $comment['id']);

		$req->execute();

	}

	public function delete($id)
	{
		$db = $this->dbConnect();
		$req = $db->exec('DELETE FROM comments WHERE id = '.(int) $id);
	}

	public function getComment($commentId)
	{
		$db = $this->dbConnect();
		$q = $db->prepare('SELECT comments.id, firstname, lastname, author_id as authorId, status, comment, comment_date AS commentDate FROM comments INNER JOIN users ON comments.author_id = users.id WHERE comments.id = :id');
		$q->bindValue(':id', $commentId);
		$q->execute();

		$tab = $q->fetch(\PDO::FETCH_ASSOC);

		$tab['commentDate'] = new \DateTime($tab['commentDate']);

		$comment = new Comment($tab);

		return $comment;
	}

	public function listComment()
	{
		$tab = [];
		
		$db = $this->dbConnect();
		$comments = $db->query('SELECT id, author_id, status, comment, comment_date AS commentDate FROM comments ORDER BY commentDate AND status DESC');

		$comments->execute();

		while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
			$data['commentDate'] = new \DateTime($data['commentDate']);
			$tab[] = new Comment($data);
		}

		return $tab;
	}


}