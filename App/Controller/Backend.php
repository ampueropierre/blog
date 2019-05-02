<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Model\Post;
use App\Validator\PostValidator;

/**
 * 
 */
class Backend
{
	public function admin()
	{
		$postManager = new PostManager();
		$title = 'Liste des Postes';
		$posts = $postManager->getPosts();
		require 'view/backend/admin.php';
	}

	public function addPost()
	{
		$title = 'Ajouter un Poste';
		
		if (isset($_POST['add'])) {
			$postValidator = new PostValidator($_POST);

			if (empty($postValidator->errors())) {
				$post = new Post($_POST);
				$postManager = new PostManager();
				$postManager->add($post);
				header('Location: index.php?action=admin&success=add');
			} else {
				$errors = $postValidator->errors();
			}
		}
		require 'view/backend/addPost.php';
	}

	public function deletePost($id)
	{
		$postManager = new PostManager();
		$postManager->delete($id);
		header('Location: index.php?action=admin');
	}

	public function updatePost($id)
	{
		$title = 'Modifier un Poste';
		$postManager = new PostManager();
		$post = $postManager->getPost($id);
		require 'view/backend/updatePost.php';
	}
}