<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;
use App\Model\User;
use App\Model\Comment;
use App\Validator\UserValidator;
use App\Validator\ConnexionValidator;

class Frontend {

	public function connexion()
	{
		$title = 'connexion';

		if (isset($_POST['connexion'])) {
			$userManager = new UserManager();
			$connexionValidator = new ConnexionValidator($_POST);
			if (empty($connexionValidator->errors())) {
				$user = $userManager->getLoggedUser($_POST['mail'], $_POST['password']);
				if ($user) {	
					$_SESSION['user'] = serialize($user);
					header('Location: index.php?action=listPost');
				} else {
					$errorIdentifiant = true;
				}
			} else {
				$errors = $connexionValidator->errors();
			}

		}

		require 'view/frontend/connexion.php';
	}

	public function home()
	{
		$user = $this->userSession();
		$title = 'Home';

		require 'view/frontend/template/home.php';
	}

	public function contact()
	{
		$title = 'Contact';
		$user = $this->userSession();

		require 'view/frontend/contact.php';
	}

	public function listPosts()
	{	
		$user = $this->userSession();

		$postManager = new PostManager();

		$title = 'Blog';
		$posts = $postManager->getPosts();

		require('view/frontend/listPost.php');
	}

	public function post($id)
	{
		$user = $this->userSession();

		$postManager = new PostManager();
		$commentManager = new CommentManager();

		$post = $postManager->getPost($id);
		$comments = $commentManager->getCommentsValide($id);

		$title = $post->title();

		require('view/frontend/post.php');
	}

	public function addComment($postId,$author,$comment)
	{
		$user = $this->userSession();

		$commentManager = new CommentManager();
		$affectedLines = $commentManager->postComment($postId,$author,$comment);

		if ($affectedLines == false) {
			throw new Exception("Impossible d\'ajouter le commentaire !");
		}
		else {
			header('Location: index.php?action=post&id='.$postId);
		}
	}

	// Modifier des commentaire
	public function comment($idComment,$idPost)
	{
		$user = $this->userSession();
		$title = 'Modifier le commentaire';
		$manager = new CommentManager();

		$comment = $manager->getComment($idComment);

		if (isset($_POST['update']))
		{
			$update = new Comment([
				'author' => $_POST['author'],
				'comment' => $_POST['comment'],
				'id' => $comment->id()
			]);

			$manager->updateComment($update);
			header('Location: index.php?action=post&id='.$comment->postId());
		}

		require('view/frontend/commentView.php');
	}

	public function updateComment($postId,$commentId,$author,$comment)
	{
		$commentManager = new CommentManager();
		$affectedLines = $commentManager->updateComment($commentId, $author, $comment);

		if($affectedLines == false) {
			throw new Exception("Impossible d\'ajouter le commentaire !");
		}
		else {
			header('Location: index.php?action=post&id='.$postId);
		}

	}

	public function destroy()
	{
		session_destroy();
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}

	public function createUser()
	{
		$title = 'Créer un compte';
		
		if (isset($_POST['create']))
		{
			// $userManager = new UserManager();
			// $userCreate = new User();
			// $userCreate->hydrate($_POST);
			$userValidator = new UserValidator($_POST);

			if (!empty($userValidator->errors())) {
				$errors = $userValidator->errors();
			} else {
				$userManager = new UserManager();
				$user = new User();
				$user->hydrate($_POST);
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
		require('view/frontend/profil.php');
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


