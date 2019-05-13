<?php
namespace App\Manager;

use App\Model\Comment;
use App\Manager\UserManager;

class CommentManager extends Manager
{
	public function getCommentsValide($postId)
	{
		$tab = [];

		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, post_id AS postId, author_id AS authorId, status, comment, comment_date AS commentDate FROM comments WHERE post_id = :id AND status = 1 ORDER BY commentDate DESC');

		$req->bindValue(':id', $postId);

		$req->execute();

		$comments = $req->fetchAll(\PDO::FETCH_ASSOC);

		$userManager = new UserManager();

		foreach ($comments as $comment) {
			$comment['commentDate'] = new \DateTime($comment['commentDate']);
			$comment['author'] = $userManager->getUser($comment['authorId']);
			$tab[] = new Comment($comment);
		}

		return $tab;
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

	public function getComment($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, post_id AS postId, author_id AS authorId, status, comment, comment_date AS commentDate FROM comments WHERE id = :id');
		$req->bindValue(':id', $id);
		$req->execute();

		$tab = $req->fetch(\PDO::FETCH_ASSOC);

		$tab['commentDate'] = new \DateTime($tab['commentDate']);
		$userManager = new UserManager();
		$tab['author'] = $userManager->getUser($tab['authorId']);

		$comment = new Comment($tab);
		
		return $comment;
	}

	public function listComment()
	{
		$tab = [];
		
		$db = $this->dbConnect();
		$comments = $db->query('SELECT id, author_id, status, comment, comment_date as commentDate FROM comments ORDER BY commentDate DESC, status ASC');

		$comments->execute();

		while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
			$data['commentDate'] = new \DateTime($data['commentDate']);
			$tab[] = new Comment($data);
		}

		return $tab;
	}


}