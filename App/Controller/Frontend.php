<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;
use App\Model\User;
use App\Model\Comment;
use App\Validator\UserValidator;
use App\Validator\ConnexionValidator;
use App\Validator\CommentValidator;

class Frontend
{
	public function home()
	{
		$user = $this->userSession();
		$title = 'Home';

		require 'view/template/home.php';
	}

	public function contact()
	{
		$title = 'Contact';
		$user = $this->userSession();

		require 'view/frontend/contact.php';
	}

	public function blog()
	{	
		$user = $this->userSession();

		$postManager = new PostManager();

		$title = 'Blog';
		$posts = $postManager->getPosts();

		require('view/frontend/blog.php');
	}

	public function post($id)
	{
		$user = $this->userSession();

		$postManager = new PostManager();
		$commentManager = new CommentManager();

		$post = $postManager->getPost($id);
		$comments = $commentManager->getCommentsValide($id);

		$title = $post->getTitle();

		if (isset($_POST['addComment'])) {
			$commentValidator = new CommentValidator($_POST);
			if (empty($commentValidator->errors())) {
				$comment = new Comment([
					'comment' => $_POST['comment'],
					'authorId' => $user->getId(),
					'postId' => $id
				]);
				$commentManager->add($comment);
			} else {
				$errors = $commentValidator->errors();
			}
		}

		require('view/frontend/postView.php');
	}

	public function connexion()
	{
		$title = 'connexion';

		if (isset($_POST['connexion'])) {
			$userManager = new UserManager();
			$connexionValidator = new ConnexionValidator($_POST);
			if (empty($connexionValidator->getErrors())) {
				$user = $userManager->getLoggedUser($_POST['mail'], $_POST['password']);
				if ($user) {	
					$_SESSION['user'] = serialize($user);
					header('Location: index.php?action=listPost');
				} else {
					$errorIdentifiant = true;
				}
			} else {
				$errors = $connexionValidator->getErrors();
			}

		}

		require 'view/frontend/connexion.php';
	}

	

	public function createUser()
	{
		$title = 'Créer un compte';
		
		if (isset($_POST['create'])) {

			$userValidator = new UserValidator([
				'firstname' => $_POST['firstname'],
				'lastname' => $_POST['lastname'],
				'mail' => $_POST['mail'],
				'mailExist' => $_POST['mail']
			]);

			if (!empty($userValidator->getErrors())) {
				$errors = $userValidator->getErrors();
			} else {
				$userManager = new UserManager();
				$user = new User($_POST);
				$user = $userManager->add($user);

				$_SESSION['user'] = serialize($user);
				header('Location: index.php?action=listPost');
			}
			
		}

		require('view/frontend/createUser.php');
	}

	public function profil($id)
	{
		$user = $this->userSession(); 
		$title = "Mon profil";
		$userManager = new UserManager();
		$userProfil = $userManager->getUser($id);
		if (isset($_POST['update'])) {
			$userValidator = new UserValidator([
				'firstname' => $_POST['firstname'],
				'lastname' => $_POST['lastname'],
				'mail' => $_POST['mail'],
			]);
			if (empty($userValidator->getErrors())) {
				$userProfil = new User([
					'firstname' => $_POST['firstname'],
					'lastname' => $_POST['lastname'],
					'mail' => $_POST['mail'],
					'id' => $id
				]);
				$userManager->update($userProfil);
				$update = true;

			} else {
				$errors = $userValidator->getErrors();
			}

		}
		require('view/frontend/profil.php');
	}

	public function destroy()
	{
		session_destroy();
		header("Location: ".$_SERVER["HTTP_REFERER"]);
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


