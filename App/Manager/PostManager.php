<?php
namespace App\Manager;

use App\Model\Post;
use App\Manager\UserManager;

class PostManager extends Manager
{
	public function getPosts()
	{
		$posts = [];

		$db = $this->dbConnect();
		$req = $db->query('SELECT id, title, chapo, date_modification as dateModification FROM posts ORDER BY dateModification DESC LIMIT 0,5');
		while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
			$data['dateModification'] = new \DateTime($data['dateModification'], new \DateTimeZone('Europe/Paris'));
			$posts[] = new Post($data);
		}

		return $posts;
	}

	public function getPost($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, author_id AS authorId, title, chapo, img, content, date_modification as dateModification FROM posts WHERE id =:id');
		$req->bindValue(':id', $postId);
		$req->execute();
		$post = $req->fetch(\PDO::FETCH_ASSOC);

		$post['dateModification'] = new \DateTime($post['dateModification']);

		$userManager = new UserManager();
		$post['author'] = $userManager->getUser($post['authorId']);
		
		$post = new Post($post);

		return $post;
	}

	public function add(Post $post)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO posts(author_id, title, chapo, img, content, date_creation, date_modification) VALUES (:author_id, :title, :chapo, :img, :content, NOW(), NOW())');
		$req->bindValue(':author_id', $post->getAuthorId());
		$req->bindValue(':title', $post->getTitle());
		$req->bindValue(':chapo', $post->getChapo());
		$req->bindValue(':img', $post->getImg());
		$req->bindValue(':content', $post->getContent());
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
		$req = $db->prepare('UPDATE posts SET title = :title, chapo = :chapo, content = :content, date_modification = NOW() WHERE id = :id');
		$req->bindValue(':title', $post->getTitle());
		$req->bindValue(':chapo', $post->getChapo());
		$req->bindValue(':content', $post->getContent());
		$req->bindValue(':id', $post->getId());
		$req->execute();
	}

	public function imgValide($img)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT img FROM posts WHERE img = :img');
		$req->bindValue(':img', $img);

		$req->execute();

		$img = $req->fetch(\PDO::FETCH_ASSOC);

		if(!$img) {
			return true;
		}


	}

	
}