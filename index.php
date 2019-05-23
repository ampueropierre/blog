<?php
session_start();

date_default_timezone_set('Europe/Paris');
setlocale (LC_TIME, 'fr_FR.utf8','fra');

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

use App\Controller\Frontend;
use App\Controller\Backend;

$frontend = new Frontend;
$backend = new Backend;

try
{
	if (isset($_GET['action'])) {
		if ($_GET['action'] == 'posts') {
			$frontend->blog();
		}
		elseif ($_GET['action'] == 'post' && isset($_GET['id'])) {
			$frontend->post($_GET['id']);
		}
		elseif ($_GET['action'] == 'contact') {
			$frontend->contact();
		}
		elseif ($_GET['action'] == 'login') {
			$frontend->connexion();
		}
		elseif ($_GET['action'] == 'destroy') {
			$frontend->destroy();
		}
		elseif($_GET['action'] == 'register') {
			$frontend->createUser();
		}
		elseif ($_GET['action'] == 'profil' && isset($_GET['id'])) {
			$frontend->profil($_GET['id']);
		}
		elseif ($_GET['action'] == 'listPost') {
			$backend->listPost();
		}
		elseif ($_GET['action'] == 'addPost') {
			$backend->addPost();
		}
		elseif ($_GET['action'] == 'deletePost' && isset($_GET['id'])) {
			$backend->deletePost($_GET['id']);
		}
		elseif ($_GET['action'] == 'updatePost' && isset($_GET['id'])) {
			$backend->updatePost($_GET['id']);	
		}
		elseif ($_GET['action'] == 'listComment') {
			$backend->listComment();	
		}
		elseif ($_GET['action'] == 'updateComment' && isset($_GET['id'])) {
			$backend->updateComment($_GET['id']);	
		}
		elseif ($_GET['action'] == 'deleteComment' && isset($_GET['id'])) {
			$backend->deleteComment($_GET['id']);
		}
		elseif ($_GET['action'] == 'listUser') {
			$backend->listUser();
		}
		elseif ($_GET['action'] == 'updateUser' && isset($_GET['id'])) {
			$backend->updateUser($_GET['id']);
		}
		elseif ($_GET['action'] == 'deleteUser' && isset($_GET['id'])) {
			$backend->deleteUser($_GET['id']);
		}
		else {
			$frontend->page404();
		}
	} else {
		$frontend->home();
	}

}
catch(Exception $e) {
	$errorMessage =  $e->getMessage();
	require('view/frontend/errorView.php');
}

