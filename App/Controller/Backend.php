<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Model\Post;

/**
 * 
 */
class Backend
{
	public function admin()
	{
		$postManager = new PostManager();
		$title = 'Administration';
		$posts = $postManager->getPosts();
		require 'view/backend/admin.php';
	}

	public function addPost()
	{
		$title = 'Ajouter un Poste';
		$postManager = new PostManager();
		if (isset($_POST['add']))
		{
			$post = new Post([
				'title' => $_POST['title'],
				'content' => $_POST['content']
			]);

			if (empty($post->error()))
			{
				$postManager->add($post);
				header('Location: index.php?action=admin');
				die;
			}
		}
		require 'view/backend/addPost.php';
	}

	public function deletePost($id)
	{
		$postManager = new PostManager();
		$postManager->delete($id);
		header('Location: index.php?action=admin');
		die;
	}
}