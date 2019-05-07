<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Model\Post;
use App\Validator\PostValidator;

/**
 * 
 */
class Backend
{
	public function admin()
	{
		$user = $this->userSession();
		$title = 'Liste des Postes';
		$postManager = new PostManager();
		$posts = $postManager->getPosts();
		require 'view/backend/admin.php';
	}

	public function addPost()
	{
		$title = 'Ajouter un Poste';
		$user = $this->userSession();
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
		header('Location: index.php?action=admin&success=delete');
	}

	public function updatePost($id)
	{
		$user = $this->userSession();
		$title = 'Modifier un Poste';
		$postManager = new PostManager();
		$post = $postManager->getPost($id);
		if (isset($_POST['update'])) {
			$postValidator = new PostValidator($_POST);
			if (empty($postValidator->errors())) {
				$post = new Post($_POST);
				$postManager->update($post);
				header('Location: index.php?action=admin&success=update');
			} else {
				$errors = $postValidator->errors();
			}
		}

		require 'view/backend/updatePost.php';
	}

	public function listComment()
	{
		$user = $this->userSession();
		$title = 'Liste des Commentaires';
		$commentManager = new CommentManager();
		$comments = $commentManager->listComment();
		require 'view/backend/listComment.php';
	}

	public function updateComment($id)
	{
		$user = $this->userSession();
		$title = 'Modifier un Commentaire';
		$commentManager = new CommentManager();
		$comment = $commentManager->getComment($id);
		if (isset($_POST['update'])) {
			$commentManager->update($_POST);
			header('Location: index.php?action=listComment');
		}
		require 'view/backend/updateComment.php';
	}

	public function deleteComment($id)
	{
		$commentManager = new CommentManager();
		$commentManager->delete($id);
		header('Location: index.php?action=listComment');
	}

	private function userSession()
	{
		$user = null;

		if (isset($_SESSION['user']))
		{
			return unserialize($_SESSION['user']);
		}
	}
}