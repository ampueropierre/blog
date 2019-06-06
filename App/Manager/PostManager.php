<?php
namespace App\Manager;

use App\Model\Post;
use App\Datetime\DateTimeFrench;

class PostManager extends Manager
{
	public function getListOf()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT id,users_id AS usersId, title, chapo, date_modification AS dateModification FROM posts ORDER BY dateModification DESC');
		$req->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, 'App\Model\Post');
		$posts = $req->fetchAll();
		$userManager = new UserManager();
		foreach ($posts as $post) {
			$post->setDateModification(new DateTimeFrench($post->getDateModification()));
			$post->setAuthor($userManager->getUser($post->getUsersId()));
		}

		return $posts;
	}

	public function postExist($postId) {
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id FROM posts WHERE id = :id');
		$req->bindValue(':id', $postId);
		$req->execute();

		$post = $req->fetch();

		if (!$post) {
			return false;
		}

		return true;
	}

	public function getPost($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, users_id AS usersId, title, chapo, img, content, date_creation as dateCreation FROM posts WHERE id =:id');
		$req->bindValue(':id', $postId);
		$req->execute();

		$req->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, 'App\Model\Post');
		$post = $req->fetch();

		$post->setDateCreation(new DateTimeFrench($post->getDateCreation()));

		$userManager = new UserManager();
		$post->setAuthor($userManager->getUser($post->getUsersId()));

		return $post;
	}

	public function add(Post $post)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO posts(users_id, title, chapo, img, content, date_creation, date_modification) VALUES (:users_id, :title, :chapo, :img, :content, NOW(), NOW())');
		$req->bindValue(':users_id', $post->getUsersId());
		$req->bindValue(':title', $post->getTitle());
		$req->bindValue(':chapo', $post->getChapo());
		$req->bindValue(':img', $post->getImg());
		$req->bindValue(':content', $post->getContent());
		$req->execute();
	}

	public function update(Post $post)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE posts SET users_id = :users_id, title = :title, chapo = :chapo, content = :content, date_modification = NOW() WHERE id = :id');
		$req->bindValue(':users_id', $post->getUsersId());
		$req->bindValue(':title', $post->getTitle());
		$req->bindValue(':chapo', $post->getChapo());
		$req->bindValue(':content', $post->getContent());
		$req->bindValue(':id', $post->getId());
		$req->execute();
	}

	public function updateImg(Post $post)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE posts SET img = :img WHERE id = :id');
		$req->bindValue(':img', $post->getImg());
		$req->bindValue(':id', $post->getId());
		$req->execute();
	}

	public function delete(int $idPost)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM posts WHERE id = :id');
		$req->bindValue(':id', $idPost, \PDO::PARAM_INT);
		$req->execute();
	}
}
