<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;

class Frontend {

	public function connexion()
	{
		$title = 'Connexion';
		var_dump($_POST);
		require 'view/frontend/connexion.php';
	}

	public function home()
	{
		$title = 'Home';
		require 'view/frontend/template/home.php';
	}

	public function contact()
	{
		$title = 'Contact';
		require 'view/frontend/contact.php';
	}

	public function listPosts()
	{	
		$postManager = new PostManager();

		$title = 'Blog';
		$posts = $postManager->getPosts();

		require('view/frontend/listPostView.php');
	}

	public function post()
	{
		$postManager = new PostManager();
		$commentManager = new CommentManager();

		$post = $postManager->getPost($_GET['id']);
		$comments = $commentManager->getComments($_GET['id']);

		$title = $post->title();

		require('view/frontend/postView.php');
	}

	public function addComment($postId,$author,$comment)
	{
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
		$manager = new CommentManager();
		$idComment = $idComment;
		$idPost = $idPost;

		$comment = $manager->getComment($idComment);

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
}


