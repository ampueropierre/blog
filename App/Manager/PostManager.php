<?php
namespace App\Manager;

use App\Model\Post;

class PostManager extends Manager
{
	public function getPosts()
	{
		date_default_timezone_set('Europe/Paris');
		$posts = [];

		$db = $this->dbConnect();
		$req = $db->query('SELECT id, title, content, date_creation as dateCreation FROM posts ORDER BY dateCreation DESC LIMIT 0,5');

		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			$data['dateCreation'] = new \DateTime($data['dateCreation'], new \DateTimeZone('Europe/Paris'));
			$posts[] = new Post($data);
		}

		return $posts;
	}

	public function getPost($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, content, date_creation as dateCreation FROM posts WHERE id=?');
		$req->execute(array($postId));
		$post = $req->fetch();

		$post['dateCreation'] = new \DateTime($post['dateCreation']);
		return $post = new Post($post);
	}
}