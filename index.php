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
	if (isset($_GET['action'])) {
		if ($_GET['action'] == 'blog') {
			$frontend->blog();
		}
		elseif ($_GET['action'] == 'post' && isset($_GET['id'])) {
			$frontend->post($_GET['id']);
		}
		elseif ($_GET['action'] == 'contact') {
			$frontend->contact();
		}
		elseif ($_GET['action'] == 'connexion') {
			$frontend->connexion();
		}
		elseif ($_GET['action'] == 'destroy') {
			$frontend->destroy();
		}
		elseif($_GET['action'] == 'createUser') {
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
	} else {
		$frontend->home();
	}

}
catch(Exception $e) {
	$errorMessage =  $e->getMessage();
	require('view/frontend/errorView.php');
}

