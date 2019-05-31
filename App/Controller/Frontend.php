<?php

namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;
use App\Model\User;
use App\Model\Comment;
use App\Service\Mailer;
use App\Validator\UserValidator;
use App\Validator\ConnexionValidator;
use App\Validator\CommentValidator;
use App\Validator\ContactValidator;

/**
 * Class Frontend
 * Gère la partie controller du frontend
 */
class Frontend extends Controller
{
	/**
	 * Cette function retourne la page d'accueil
	 * @return la page d'accueil
	 */
	public function home()
	{
		$userSession = $this->userSession();
		$title = 'Home';

		$this->render('','view/template/home.php',compact('userSession','title'));
	}

	/**
	 * Cette function retourne la page Blog
	 * @return la page Blog
	 */
	public function blog()
	{	
		$userSession = $this->userSession();
		$title = 'Blog';

		$postManager = new PostManager();
		$posts = $postManager->getListOf();

		$this->render('view/frontend/blog.php','view/template/page.php', compact('userSession','title','posts'));
	}

	/**
	 * Cette function retourne la page Contact
	 * @return la page Contact
	 */
	public function contact()
	{
		$userSession = $this->userSession();
		$title = 'Contact';

		if (isset($_POST['contact'])) {
			$contactValidator = new ContactValidator($_POST);
			if (empty($contactValidator->getErrors())) {
			    $mailer = new Mailer();
				if (!$mail = $mailer->sendMail($_POST['mail'], $_POST['name'], $_POST['message'])) {
				    echo "Mailer Error: " . $mail->ErrorInfo;
				    die;
				} else {
					unset($_POST);
				    $success = true;
				}
			}
			else {
				$errors = $contactValidator->getErrors();
			}
		}

		$this->render('view/frontend/contact.php','view/template/page.php', compact('userSession','title','posts','success','errors','contactValidator'));
	}

	/**
	 * Cette function retourne la page d'un Poste
	 * @param int $id L'id du poste
	 * @return la page d'un poste en function de son id
	 */
	public function post(int $id)
	{
		$userSession = $this->userSession();

		$postManager = new PostManager();
		$commentManager = new CommentManager();

		$post = $postManager->getPost($id);
		$comments = $commentManager->getListOfValide($id);

		$title = $post->getTitle();

		if (isset($_POST['addComment'])) {
			$commentValidator = new CommentValidator($_POST);
			if (empty($commentValidator->getErrors())) {
				$comment = new Comment([
					'content' => $_POST['content'],
					'usersId' => $userSession->getId(),
					'postsId' => $id
				]);
				$commentManager->add($comment);
				$commentSuccess = true;
			} else {
				$errors = $commentValidator->getErrors();
			}
		}

		$this->render('view/frontend/postView.php','view/template/post.php', compact('userSession','title','post','comments','commentSuccess','errors','commentValidator'));
	}

	/**
	 * Cette function retourne la page Connexion
	 * @return la page Connexion
	 */
	public function connexion()
	{
		$title = 'Connexion';

		if (isset($_POST['connexion'])) {
			$userManager = new UserManager();
			$connexionValidator = new ConnexionValidator($_POST);
			if (empty($connexionValidator->getErrors())) {
				$userSession = $userManager->getLoggedUser($_POST['mail'], $_POST['password']);
				if ($userSession) {	
					$_SESSION['user'] = serialize($userSession);
					header('Location: posts');
				} else {
					$errorIdentifiant = true;
				}
			} else {
				$errors = $connexionValidator->getErrors();
			}
		}

		$this->render('view/frontend/connexion.php','view/template/page.php', compact('title','userManager','connexionValidator','errors'));
	}

	/**
	 * Cette function retourne la page Création utilisateur
	 * @return la page pour créer un nouvel utilisateur
	 */
	public function createUser()
	{
		$title = 'Créer un compte';
		
		if (isset($_POST['create'])) {
			$userValidator = new UserValidator([
				'firstname' => $_POST['firstname'],
				'lastname' => $_POST['lastname'],
				'mail' => $_POST['mail'],
				'mailExist' => $_POST['mail'],
				'password' => $_POST['password']
			]);
			if (!empty($userValidator->getErrors())) {
				$errors = $userValidator->getErrors();
			} else {
				$userManager = new UserManager();
				$user = new User($_POST);
				$user = $userManager->add($user);

				$_SESSION['user'] = serialize($user);

				header('Location: posts');
			}
		}

		$this->render('view/frontend/createUser.php','view/template/page.php', compact('title','userValidator','errors'));
	}

	/**
	 * Cette function retourne la page d'un profil
	 * @param int $id
	 * @return la page profil en function de son id
	 */
	public function profil(int $id)
	{
		$userSession = $this->userSession(); 
		
		$title = "Mon profil";
		$userManager = new UserManager();
		$userProfil = $userManager->getUser($id);

		if($userSession == null || $userSession->getId() != $userProfil->getId()) {
			$this->page404();
		}
		else {
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
			$this->render('view/frontend/profil.php','view/template/page.php', compact('userSession','title','userManager','userValidator','userProfil','update','errors'));
		}
	
	}

	/**
	 * Cette function détruit le $_SESSION en cours
	 * @return vers la page Connexion
	 */
	public function destroy()
	{
		session_destroy();
		header('Location: login');
	}
}
