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
		$userSession = $this->userSession();
		$title = 'Liste des Postes';
		$postManager = new PostManager();
		$posts = $postManager->getPosts();
		require 'view/backend/listPost.php';
	}

	public function addPost()
	{
		$title = 'Ajouter un Poste';
		$userSession = $this->userSession();
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
					'authorId' => $userSession->getId(),
					'title' => $_POST['title'],
					'chapo' => $_POST['chapo'],
					'content' => $_POST['content'],
					'idAuthor' => $userSession->getId(),
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
		$userSession = $this->userSession();
		$title = 'Modifier un Poste';
		$postManager = new PostManager();
		$post = $postManager->getPost($id);
		if (isset($_POST['update'])) {
			$postValidator = new PostValidator($_POST);
			if (empty($postValidator->getErrors())) {
				$post = new Post([
					'title' => $_POST['title'],
					'chapo' => $_POST['chapo'],
					'content' => $_POST['content'],
					'id' => $post->getId()
				]);
				$postManager->update($post);
				$updateSuccess = 'info';
			} else {
				$errors = $postValidator->getErrors();
			}
		}
		if (isset($_POST['updateImg'])) {
			$postValidator = new PostValidator(['img' => $_FILES['img']]);
			if (empty($postValidator->getErrors())) {
				$uploaddir = $_ENV['IMG_DIR_POST'];
				$uploadfile = $uploaddir.time().'-'.basename($_FILES['img']['name']);
				$img = new Post([
					'id' => $post->getId(),
					'img' => $uploadfile
				]);
				if (unlink($post->getImg()) && move_uploaded_file($_FILES['img']['tmp_name'], $img->getImg())) {
					$postManager->updateImg($img);
					$updateSuccess = 'img';
				}
			} else {
				$errors = $postValidator->getErrors();
			}
		}

		require 'view/backend/updatePost.php';
	}

	public function listComment()
	{
		$userSession = $this->userSession();
		$title = 'Liste des Commentaires';
		$commentManager = new CommentManager();
		$comments = $commentManager->listComment();
		require 'view/backend/listComment.php';
	}

	public function updateComment($id)
	{
		$userSession = $this->userSession();
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
		$userSession = $this->userSession();
		$title = 'Liste des Utilisateurs';
		$userManager = new UserManager();
		$users = $userManager->getUsers();
		if (isset($_POST['update'])) {
			var_dump($_POST);
		}

		require 'view/backend/listUser.php';
	}

	public function deleteUser($id)
	{
		$commentManager = new UserManager();
		$commentManager->delete($id);
		header('Location: index.php?action=listUser&delete=success');
	}

	private function userSession()
	{
		$userSession = null;

		if (isset($_SESSION['user']))
		{
			return unserialize($_SESSION['user']);
		}
	}

}