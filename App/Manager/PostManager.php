<?php
namespace App\Manager;

use App\Model\Post;

class PostManager extends Manager
{
	public function getPosts()
	{
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

	public function add(Post $post)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO posts(title, content, date_creation) VALUES (:title, :content, NOW())');
		$req->bindValue(':title', $post->title());
		$req->bindValue(':content', $post->content());
		$req->execute();
	}

	public function delete($id)
	{
		$db = $this->dbConnect();
		$req = $db->exec('DELETE FROM posts WHERE id = '.(int) $id);
	}

	public function update(Post $post)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE posts SET title = :title, content = :content WHERE id = :id');
		$req->bindValue(':title', $post->title());
		$req->bindValue(':content', $post->content());
		$req->bindValue(':id', $post->id());
		$req->execute();
	}
}