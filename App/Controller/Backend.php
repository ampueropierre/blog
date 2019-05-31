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

class Backend extends Controller
{
	public function listPost()
	{
		$userSession = $this->userSession();
		if ($userSession == null || $userSession->getRolesId() > 2) {
			$this->page404();
		} else {
			$title = 'Liste des Postes';
			$postManager = new PostManager();
			$posts = $postManager->getListOf();

			$this->render('view/backend/listPost.php','view/template/page.php', compact('userSession','title','posts'));
		}
		
	}

	public function addPost()
	{
		$userSession = $this->userSession();
		if ($userSession == null || $userSession->getRolesId() > 2) {
			$this->page404();
		} else {
			$title = 'Ajouter un Poste';
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
						'usersId' => $userSession->getId(),
						'title' => $_POST['title'],
						'chapo' => $_POST['chapo'],
						'content' => $_POST['content'],
						'img' => $uploadfile
					]);
					if(move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
						$postManager = new PostManager();
						$postManager->add($post);
						$success = true;
						unset($_POST);
					}	
				} else {
					$errors = $postValidator->getErrors();
				}
			}
			$this->render('view/backend/addPost.php','view/template/page.php', compact('userSession','title','errors', 'postValidator','success'));
		}	
	}

	public function deletePost($id)
	{
		$userSession = $this->userSession();
		if ($userSession == null || $userSession->getRolesId() > 2) {
			$this->page404();
		} else {
			$postManager = new PostManager();
			$imgName = $postManager->getPost($id)->getImg();
			if (unlink($imgName)) {
				$postManager->delete($id);
			}
		}		
	}

	public function updatePost($id)
	{
		$userSession = $this->userSession();
		if ($userSession == null || $userSession->getRolesId() > 2) {
			$this->page404();
		} else {
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
						'usersId' => $_POST['authorId'],
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

			$this->render('view/backend/updatePost.php','view/template/page.php', compact('userSession','title','usersAdmin','post','errors', 'postValidator','updateSuccess'));
		}	
	}

	public function listComment()
	{
		$userSession = $this->userSession();
		if ($userSession == null || $userSession->getRolesId() > 2) {
			$this->page404();
		} else {
			$title = 'Liste des Commentaires';
			$commentManager = new CommentManager();
			$comments = $commentManager->getListOf();

			$commentWaiting = [];
			$commentValid = [];
			foreach ($comments as $comment) {
				if ($comment->getStatus() == 1) {
					$commentValid[] = $comment;
				} else {
					$commentWaiting[] = $comment;
				}
			}
			
			$this->render('view/backend/listComment.php','view/template/page.php', compact('userSession','title','usersAdmin','commentWaiting','commentValid'));
		}	
	}

	public function updateComment($id)
	{
		$userSession = $this->userSession();
		if ($userSession == null || $userSession->getRolesId() > 2) {
			$this->page404();
		} else {
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
					$success = true;
				} else {
					$errors = $commentValidator->getErrors();
				}
			}
			$this->render('view/backend/updateComment.php','view/template/page.php', compact('userSession','title','comment','commentValidator','errors'));
		}	
	}

	public function deleteComment($id)
	{
		$userSession = $this->userSession();
		if ($userSession == null || $userSession->getRolesId() > 2) {
			$this->page404();
		} else {
			$commentManager = new CommentManager();
			$commentManager->delete($id);
		}
	}

	public function listUser()
	{
		$userSession = $this->userSession();
		if($userSession == null || $userSession->getRolesId() > 1) {
			$this->page404();
		} else {
			$title = 'Liste des Utilisateurs';
			$userManager = new UserManager();
			$users = $userManager->getListOf();

			$this->render('view/backend/listUser.php','view/template/page.php', compact('userSession','title','users'));
		}
	}

	public function updateUser($id) {
		$userSession = $this->userSession();
		if($userSession == null || $userSession->getRolesId() > 1) {
			$this->page404();
		} else {
			$title = 'Modifier un Utilisateur';
			$userManager = new UserManager();
			$user = $userManager->getUser($id);
			$roles = $userManager->getListOfRole();
			if (isset($_POST['update'])) {
				$userValidator = new UserValidator($_POST);
				if (empty($userValidator->getErrors())) {
					$userUpdate = new User([
						'rolesId' => $_POST['role'],
						'id' => $user->getId()
					]);
					$userManager->updateRole($userUpdate);
					$success = true;
				} else {
					$errors = $userValidator->getErrors();
				}
			}

			$this->render('view/backend/updateUser.php','view/template/page.php', compact('userSession','title','user','roles','errors','userValidator','success'));
		}	
	}

	public function deleteUser($id)
	{
		$userSession = $this->userSession();
		if($userSession == null || $userSession->getRolesId() > 1) {
			$this->page404();
		} else {
			$commentManager = new UserManager();
			$commentManager->delete($id);
		}		
	}
}
