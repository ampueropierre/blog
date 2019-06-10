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
use App\Session\Session;

/**
 * Class Frontend
 * Controller of frontend
 */
class Frontend extends Controller
{
	/**
	 * Return home page
	 * @return
	 */
	public function home()
	{
		$userSession = Session::get('user');

		$title = 'Home';

		$this->render('','view/template/home.php',compact('userSession','title'));
	}

	/**
	 * Return blog page
	 * @return
	 */
	public function blog()
	{	
		$userSession = Session::get('user');

		$title = 'Blog';

		$postManager = new PostManager();
		$posts = $postManager->getListOf();

		$this->render('view/frontend/blog.php','view/template/page.php', compact('userSession','title','posts'));
	}

	/**
	 * Return contact page
	 * @return page Contact
	 */
	public function contact()
	{
		$userSession = Session::get('user');

		$title = 'Contact';

		$data = filter_input_array(INPUT_POST);

		if (isset($data['contact'])) {
			$contactValidator = new ContactValidator($data);
			if (empty($contactValidator->getErrors())) {
			    $mailer = new Mailer();
				if (!$mail = $mailer->sendMail($data['mail'], $data['name'], $data['message'])) {
					throw new \Exception('Le message n\'a pas été envoyé. Une erreur est survenue.');
				} else {
					unset($data);
				    $success = true;
				}
			}
			else {
				$errors = $contactValidator->getErrors();
			}
		}

		$this->render('view/frontend/contact.php','view/template/page.php', compact('userSession','title','data','success','errors','contactValidator'));
	}

	/**
	 * Return post page
	 * @param int $postId Id of post
	 * @return page post
	 */
	public function post(int $postId)
	{
		$userSession = Session::get('user');

		$postManager = new PostManager();
		$commentManager = new CommentManager();

		if($postManager->postExist($postId)) {

			$post = $postManager->getPost($postId);
			$comments = $commentManager->getListOfValide($postId);

			$title = $post->getTitle();

			$options = array(
				'content' =>FILTER_SANITIZE_STRING,
				'addComment' =>FILTER_SANITIZE_STRING
			);

			$data = filter_input_array(INPUT_POST, $options);

			if (isset($data['addComment']) && 'publier' === $data['addComment']) {
				$commentValidator = new CommentValidator($data);
				if (empty($commentValidator->getErrors())) {
					$comment = new Comment([
						'content' => $data['content'],
						'usersId' => $userSession->getId(),
						'postsId' => $postId
					]);
					$commentManager->add($comment);
					$commentSuccess = true;
				} else {
					$errors = $commentValidator->getErrors();
				}
			}

			$this->render('view/frontend/postView.php','view/template/post.php', compact('userSession','title','post','comments','data','commentSuccess','errors','commentValidator'));
		} else {
			$this->page404();
		}
	}

	/**
	 * Return connexion page
	 * @return
	 */
	public function connexion()
	{
		$title = 'Connexion';

		$options = array(
			'mail' => FILTER_VALIDATE_EMAIL,
			'password' => FILTER_SANITIZE_STRING,
			'connexion' => FILTER_SANITIZE_STRING
		);

		$data = filter_input_array(INPUT_POST, $options);

		if (isset($data['connexion'])) {
			$userManager = new UserManager();
			$connexionValidator = new ConnexionValidator($data);
			if (empty($connexionValidator->getErrors())) {
				$userSession = $userManager->getLoggedUser($data['mail'], $data['password']);
				if ($userSession) {
					Session::put('user',serialize($userSession));
					$this->blog();
					exit;
				}
				$errorIdentifiant = true;
			} else {
				$errors = $connexionValidator->getErrors();
			}
		}

		$this->render('view/frontend/connexion.php','view/template/page.php', compact('title','data','userManager','connexionValidator','errors','errorIdentifiant'));
	}

	/**
	 * Return creation user page
	 * @return
	 */
	public function createUser()
	{
		$title = 'Créer un compte';

		$options = array(
			'firstname' => FILTER_SANITIZE_STRING,
			'lastname' => FILTER_SANITIZE_STRING,
			'mail' => FILTER_VALIDATE_EMAIL,
			'password' => FILTER_SANITIZE_STRING,
			'create' => FILTER_SANITIZE_STRING
		);

		$data = filter_input_array(INPUT_POST, $options);
		
		if (isset($data['create'])) {
			$userValidator = new UserValidator([
				'firstname' => $data['firstname'],
				'lastname' => $data['lastname'],
				'mail' => $data['mail'],
				'mailExist' => $data['mail'],
				'password' => $data['password']
			]);
			if (!empty($userValidator->getErrors())) {
				$errors = $userValidator->getErrors();
			} else {
				$userManager = new UserManager();
				$user = new User($data);
				$user = $userManager->add($user);

				Session::put('user',serialize($user));

				$this->blog();
				exit;
			}
		}

		$this->render('view/frontend/createUser.php','view/template/page.php', compact('title','data','userValidator','errors'));
	}

	/**
	 * Return profil page
	 * @param int $idUser Id of User
	 * @return
	 */
	public function profil(int $idUser)
	{
		$userSession = Session::get('user'); 
		
		$title = "Mon profil";
		$userManager = new UserManager();
		$userProfil = $userManager->getUser($idUser);

		if($userSession != null && $userProfil != false) {
			if ($userSession->getId() == $userProfil->getId()) {
				if (isset($data['update'])) {

					$data = filter_input_array(INPUT_POST);
					$userValidator = new UserValidator([
						'firstname' => $data['firstname'],
						'lastname' => $data['lastname'],
						'mail' => $data['mail'],
					]);
					if (empty($userValidator->getErrors())) {
						$userProfil = new User([
							'firstname' => $data['firstname'],
							'lastname' => $data['lastname'],
							'mail' => $data['mail'],
							'id' => $idUser
						]);
						$userManager->update($userProfil);
						$update = true;

					} else {
						$errors = $userValidator->getErrors();
					}
				}
				$this->render('view/frontend/profil.php','view/template/page.php', compact('userSession','title','userManager','data','userValidator','userProfil','update','errors'));
			}
			else {
				$this->page404();			
			}
		}
		else {
			$this->page404();
		}
	}

	/**
	 * This function destroy $_SESSION and return login page
	 * @return
	 */
	public function destroy()
	{
		Session::forget('user');
		$this->connexion();
	}
}
