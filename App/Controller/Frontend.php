<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;
use App\Model\User;
use App\Model\Comment;
use App\Validator\UserValidator;
use App\Validator\ConnexionValidator;
use App\Validator\CommentValidator;
use App\Validator\ContactValidator;
use PHPMailer\PHPMailer\PHPMailer;

class Frontend extends Controller
{
	public function home()
	{
		$userSession = $this->userSession();
		$title = 'Home';

		$this->render('','App/View/template/home.php',compact('userSession','title'));
	}

	public function blog()
	{	
		$userSession = $this->userSession();
		$title = 'Blog';

		$postManager = new PostManager();
		$posts = $postManager->getListOf();

		$this->render('App/View/frontend/blog.php','App/View/template/page.php', compact('userSession','title','posts'));
	}

	public function contact()
	{
		$userSession = $this->userSession();

		$title = 'Contact';

		if (isset($_POST['contact'])) {
			$contactValidator = new ContactValidator($_POST);
			if (empty($contactValidator->getErrors())) {
				$mail = new PHPMailer;
				
				//Tell PHPMailer to use SMTP
				$mail->isSMTP();
				//Enable SMTP debugging
				// 0 = off (for production use)
				// 1 = client messages
				// 2 = client and server messages
				$mail->SMTPDebug = 0;
				//Set the hostname of the mail server
				$mail->Host = 'smtp.gmail.com';
				// use
				// $mail->Host = gethostbyname('smtp.gmail.com');
				// if your network does not support SMTP over IPv6
				//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
				$mail->Port = 587;
				//Set the encryption system to use - ssl (deprecated) or tls
				// $mail->SMTPSecure = 'tls';
				//Whether to use SMTP authentication
				$mail->SMTPAuth = true;
				//Username to use for SMTP authentication - use full email address for gmail
				$mail->Username = $_ENV['PHPMAILER_MAIL'];
				//Password to use for SMTP authentication
				$mail->Password = $_ENV['PHPMAILER_PASSWORD'];
				//Set who the message is to be sent from
				$mail->setFrom($_POST['mail'], $_POST['name']);
				//Set an alternative reply-to address
				// $mail->addReplyTo('replyto@example.com', 'First Last');
				//Set who the message is to be sent to
				$mail->addAddress($_ENV['PHPMAILER_MAIL']);
				//Set the subject line
				$mail->Subject = 'P5 - Blog';
				//Read an HTML message body from an external file, convert referenced images to embedded,
				//convert HTML into a basic plain-text alternative body
				// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
				//Replace the plain text body with one created manually
				$mail->Body = $_POST['message'];
				//Attach an image file
				// $mail->addAttachment('images/phpmailer_mini.png');
				//send the message, check for errors
				if (!$mail->send()) {
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

		$this->render('App/View/frontend/contact.php','App/View/template/page.php', compact('userSession','title','posts','success','errors','contactValidator'));
	}

	public function post($id)
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
					'comment' => $_POST['comment'],
					'authorId' => $userSession->getId(),
					'postId' => $id
				]);
				$commentManager->add($comment);
				$commentSuccess = true;
			} else {
				$errors = $commentValidator->getErrors();
			}
		}

		$this->render('App/View/frontend/postView.php','App/View/template/post.php', compact('userSession','title','post','comments','commentSuccess','errors','commentValidator'));
	}

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

		$this->render('App/View/frontend/connexion.php','App/View/template/page.php', compact('title','userManager','connexionValidator','errors'));
	}

	

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

		$this->render('App/View/frontend/createUser.php','App/View/template/page.php', compact('title','userValidator','errors'));
	}

	public function profil($id)
	{
		$userSession = $this->userSession(); 
		
		$title = "Mon profil";
		$userManager = new UserManager();
		$userProfil = $userManager->getUser($id);

		if($userSession == null || $userSession->getId() != $userProfil->getId()) {
			require('view/404.php');
			exit;
		}

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

		$this->render('App/View/frontend/profil.php','App/View/template/page.php', compact('userSession','title','userManager','userValidator','userProfil','update','errors'));
	}

	public function destroy()
	{
		session_destroy();
		header('Location: login');
	}

	public function page404() {
		$title = '404 Error';
		require('view/404.php');
	}

}


