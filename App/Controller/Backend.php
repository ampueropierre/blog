<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;
use App\Model\Post;
use App\Validator\PostValidator;

/**
 * 
 */
class Backend
{
	public function listPost()
	{
		$user = $this->userSession();
		$title = 'Liste des Postes';
		$postManager = new PostManager();
		$posts = $postManager->getPosts();
		require 'view/backend/listPost.php';
	}

	public function addPost()
	{
		$title = 'Ajouter un Poste';
		$user = $this->userSession();
		if (isset($_POST['add'])) {
			$postValidator = new PostValidator([
				'title' => $_POST['title'],
				'chapo' => $_POST['chapo'],
				'content' => $_POST['content'],
				'img' => $_FILES['img']
			]);
			if (empty($postValidator->getErrors())) {
				$uploaddir = $_ENV['IMG_DIR_POST'];
				$uploadfile = $uploaddir.time().'-'.basename($_FILES['img']['name']);
				$post = new Post([
					'authorId' => $user->getId(),
					'title' => $_POST['title'],
					'chapo' => $_POST['chapo'],
					'content' => $_POST['content'],
					'img' => $uploadfile
				]);
				if(move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
					$postManager = new PostManager();
					$postManager->add($post);
					header('Location: ?action=listPost&success=add');
				}	
			} else {
				$errors = $postValidator->getErrors();
			}
		}
		require 'view/backend/addPost.php';
	}

	public function deletePost($id)
	{
		$postManager = new PostManager();
		$imgName = $postManager->getPost($id)->getImg();
		if (unlink($imgName)) {
			$postManager->delete($id);
			header('Location: index.php?action=listPost&success=delete');
		}	
	}

	public function updatePost($id)
	{
		$user = $this->userSession();
		$title = 'Modifier un Poste';
		$postManager = new PostManager();
		$post = $postManager->getPost($id);
		if (isset($_POST['update'])) {
			$postValidator = new PostValidator($_POST);
			if (empty($postValidator->getErrors())) {
				$post = new Post($_POST);
				$postManager->update($post);
				header('Location: index.php?action=admin&success=update');
			} else {
				$errors = $postValidator->getErrors();
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

	public function listUser()
	{
		$user = $this->userSession();
		$title = 'Liste des Utilisateurs';
		$userManager = new UserManager();
		$userManager->getUsers();
		require 'view/backend/listUser.php';
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