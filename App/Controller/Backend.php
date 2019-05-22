<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;
use App\Model\Post;
use App\Model\User;
use App\Model\Comment;
use App\Validator\PostValidator;
use App\Validator\UserValidator;
use App\Validator\CommentValidator;

/**
 * 
 */
class Backend
{
	public function listPost()
	{
		$userSession = $this->userSession();
		if ($userSession == null || $userSession->getRole() != 1 || $userSession->getRole() != 2) {
			require 'view/404.php';
			exit;
		}
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
		$userManager = new UserManager();

		$usersAdmin = $userManager->getUsersAdmin();
		$post = $postManager->getPost($id);

		if (isset($_POST['update'])) {
			$postValidator = new PostValidator($_POST);
			if (empty($postValidator->getErrors())) {
				$post = new Post([
					'title' => $_POST['title'],
					'chapo' => $_POST['chapo'],
					'content' => $_POST['content'],
					'authorId' => $_POST['authorId'],
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
			$commentValidator = new CommentValidator($_POST);
			if (empty($commentValidator->getErrors())) {
				$commentUpdate = new Comment([
					'status' => $_POST['status'],
					'id' => $comment->getId()
				]);
				$commentManager->update($commentUpdate);
				header('Location: index.php?action=listComment');
			} else {
				$errors = $commentValidator->getErrors();
			}
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
		if($userSession == null || $userSession->getRole() != 1) {
			require 'view/404.php';
			exit;
		}
		$title = 'Liste des Utilisateurs';
		$userManager = new UserManager();
		$users = $userManager->getUsers();
		if (isset($_POST['update'])) {
			$userValidator = new UserValidator($_POST);
			if (empty($userValidator->getErrors())) {
				$user = new User([
					'role' => $_POST['role'],
					'id' => $_POST['id']
				]);
				$userManager->updateRole($user);
				header('Location: ?action=listUser');
				$updateRole = true;
			} else {
				$errors = $userValidator->getErrors();
			}
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