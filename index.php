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

$action = filter_input(INPUT_GET, 'action');
$getId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

try
{
	if (isset($action)) {
		if ($_GET['action'] == 'posts') {
			$frontend->blog();
		}
		elseif ($action == 'post' && isset($getId)) {
			$frontend->post($getId);
		}
		elseif ($action == 'contact') {
			$frontend->contact();
		}
		elseif ($action == 'login') {
			$frontend->connexion();
		}
		elseif ($action == 'destroy') {
			$frontend->destroy();
		}
		elseif($action == 'register') {
			$frontend->createUser();
		}
		elseif ($action == 'profil' && isset($getId)) {
			$frontend->profil($getId);
		}
		elseif ($action == 'listPost') {
			$backend->listPost();
		}
		elseif ($action == 'addPost') {
			$backend->addPost();
		}
		elseif ($action == 'deletePost' && isset($getId)) {
			$backend->deletePost($getId);
		}
		elseif ($action == 'updatePost' && isset($getId)) {
			$backend->updatePost($getId);	
		}
		elseif ($action == 'listComment') {
			$backend->listComment();	
		}
		elseif ($action == 'updateComment' && isset($getId)) {
			$backend->updateComment($getId);	
		}
		elseif ($action == 'deleteComment' && isset($getId)) {
			$backend->deleteComment($getId);
		}
		elseif ($action == 'listUser') {
			$backend->listUser();
		}
		elseif ($action == 'updateUser' && isset($getId)) {
			$backend->updateUser($getId);
		}
		elseif ($action == 'deleteUser' && isset($getId)) {
			$backend->deleteUser($getId);
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

