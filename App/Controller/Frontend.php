<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;
use App\Model\User;
use App\Model\Comment;

class Frontend {

	public function connexion()
	{
		$user = $this->userSession();
		$title = 'connexion';
		$userManager = new UserManager();
		if (isset($_POST['connexion']))
		{
			$user = $userManager->getLoggedUser($_POST['mail'], $_POST['password']);
			if ($user && $user->isValid())
			{	
				$_SESSION['user'] = serialize($user);

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

		require('view/frontend/listPostView.php');
	}

	public function post($id)
	{
		$user = $this->userSession();

		$postManager = new PostManager();
		$commentManager = new CommentManager();

		$post = $postManager->getPost($id);
		$comments = $commentManager->getComments($id);

		$title = $post->title();

		require('view/frontend/postView.php');
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
			var_dump($comment);
			var_dump($update);
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
		require('view/frontend/destroy.php');
	}

	public function createUser()
	{
		$title = 'Créer un compte';
		require('view/frontend/createUser.php');
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


