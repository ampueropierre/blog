<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Europe/Paris');
setlocale (LC_TIME, 'fr_FR.utf8','fra');

require __DIR__ . '/vendor/autoload.php';

use App\Controller\Frontend;

$frontend = new Frontend;

try {

	if (isset($_GET['action'])) {
		if ($_GET['action'] == 'listPost') {
			$frontend->listPosts();
		}
		elseif ($_GET['action'] == 'post') {
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				$frontend->post();
			}
			else {
				throw new Exception('Aucun id n\'a été envoyé');
			}
		}
		elseif ($_GET['action'] == 'addComment') {
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				if (!empty($_POST['author']) && !empty($_POST['comment'])) {
					$frontend->addComment($_GET['id'],$_POST['author'],$_POST['comment']);
				}
				else {
					throw new Exception("Tous les champs ne sont pas remplis !");
				}
			}
			else {
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
		elseif ($_GET['action'] == 'updateComment') {
			if (isset($_GET['idPost']) && $_GET['idPost'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0) {
				if (!empty($_POST['author']) && !empty($_POST['comment'])) {
					$frontend->updateComment($_GET['idPost'],$_GET['idComment'],$_POST['author'],$_POST['comment']);
				}
				else {
					throw new Exception("Tous les champs ne sont pas remplis");	
				}		
			}
			else {
				throw new Exception('Aucun id n\'a été envoyé');
			}
		}

	}
	else {
		$frontend->home();
	}

}
catch(Exception $e) {
	$errorMessage =  $e->getMessage();
	require('view/frontend/errorView.php');
}

