<?php
session_start();

date_default_timezone_set('Europe/Paris');
setlocale (LC_TIME, 'fr_FR.utf8','fra');

require __DIR__ . '/vendor/autoload.php';

use App\Controller\Frontend;
use App\Controller\Backend;

$frontend = new Frontend;
$backend = new Backend;

try
{
	if (isset($_GET['action']))
	{
		if ($_GET['action'] == 'listPost')
		{
			$frontend->listPosts();
		}
		elseif ($_GET['action'] == 'post')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				$frontend->post($_GET['id']);
			}
			else
			{
				throw new Exception('Aucun id n\'a été envoyé');
			}
		}
		elseif ($_GET['action'] == 'addComment')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0)
			{
				if (!empty($_POST['author']) && !empty($_POST['comment']))
				{
					$frontend->addComment($_GET['id'],$_POST['author'],$_POST['comment']);
				}
				else
				{
					throw new Exception("Tous les champs ne sont pas remplis !");
				}
			}
			else
			{
				throw new Exception('Aucun id n\'a été envoyé');
			}
		}
		// Modifier des commentaire
		elseif ($_GET['action'] == 'comment') {
			if (isset($_GET['idPost']) && $_GET['idPost'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0) {
				$frontend->comment($_GET['idComment'],$_GET['idPost']);
			}
			else {
				throw new Exception('Aucun id n\'a été envoyé');
			}
		}
		elseif ($_GET['action'] == 'contact')
		{
			$frontend->contact();
		}
		elseif ($_GET['action'] == 'connexion')
		{
			$frontend->connexion();
		}
		elseif ($_GET['action'] == 'destroy')
		{
			$frontend->destroy();
		}
		elseif($_GET['action'] == 'createUser')
		{
			$frontend->createUser();
		}
		elseif ($_GET['action'] == 'profil') {
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				$frontend->profil($_GET['id']);
			}
		}
		elseif ($_GET['action'] == 'admin')
		{
			$backend->admin();
		}
		elseif ($_GET['action'] == 'addPost')
		{
			$backend->addPost();
		}
		elseif ($_GET['action'] == 'deletePost')
		{
			if (isset($_GET['id']))
			{
				$backend->deletePost($_GET['id']);
			}
		}
		elseif ($_GET['action'] == 'updatePost')
		{
			if (isset($_GET['id'])) {
				$backend->updatePost($_GET['id']);
			}
			
		}
		elseif ($_GET['action'] == 'updateComment') {
			if (isset($_GET['id'])) {
				$backend->updateComment($_GET['id']);
			}
			
		}
		elseif ($_GET['action'] == 'listComment')
		{
			$backend->listComment();	
		}
		elseif ($_GET['action'] == 'deleteComment')
		{
			if (isset($_GET['id'])) {
				$backend->deleteComment($_GET['id']);
			}
		}

	}
	else
	{
		$frontend->home();
	}

}
catch(Exception $e) {
	$errorMessage =  $e->getMessage();
	require('view/frontend/errorView.php');
}

