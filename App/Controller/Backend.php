<?php

namespace App\Controller;

use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;
use App\Model\Post;
use App\Model\User;
use App\Model\Comment;
use App\Validator\PostValidator;
use App\Validator\UserValidator;
use App\Validator\CommentValidator;
use App\Session\Session;

/**
 * Class Backend
 * Controller of Backend
 */
class Backend extends Controller
{
	/**
	 * Return list Posts page for Admin
	 * @return
	 */
	public function listPost()
	{
		$userSession = Session::get('user');

		if ($this->userSessionValid($userSession,2)) {
			$title = 'Liste des Postes';
			$postManager = new PostManager();
			$posts = $postManager->getListOf();

			$this->render('view/backend/listPost.php','view/template/page.php', compact('userSession','title','posts'));
		}
	}

	/**
	 * Return add post page for Admin
	 * @return
	 */
	public function addPost()
	{
		$userSession = Session::get('user');

		if ($this->userSessionValid($userSession,2)) {
			$title = 'Ajouter un Poste';

			$data = filter_input_array(INPUT_POST);
			$file = $_FILES;

			if (isset($data['add'])) {
				$postValidator = new PostValidator([
					'title' => $data['title'],
					'chapo' => $data['chapo'],
					'content' => $data['content'],
					'img' => $file['img']
				]);
				if (empty($postValidator->getErrors())) {
					$uploaddir = $_ENV['IMG_DIR_POST'];
					$uploadfile = $uploaddir.time().'-'.basename($file['img']['name']);
					$post = new Post([
						'usersId' => $userSession->getId(),
						'title' => $data['title'],
						'chapo' => $data['chapo'],
						'content' => $data['content'],
						'img' => $uploadfile
					]);
					if(move_uploaded_file($file['img']['tmp_name'], $uploadfile)) {
						$postManager = new PostManager();
						$postManager->add($post);
						$success = true;
						unset($data);
					}	
				} else {
					$errors = $postValidator->getErrors();
				}


			}
			$this->render('view/backend/addPost.php','view/template/page.php', compact('userSession','title','errors', 'postValidator','success'));
		}
		
			
	}

	/**
	 * Return Update post page
	 * @param int $id Id of Post
	 * @return
	 */
	public function updatePost(int $idPost)
	{
		$userSession = Session::get('user');

		if ($this->userSessionValid($userSession,2)) {
			$title = 'Modifier un Poste';

			$postManager = new PostManager();
			$userManager = new UserManager();

			$usersAdmin = $userManager->getUsersAdmin();
			$post = $postManager->getPost($idPost);

			$data = filter_input_array(INPUT_POST);
			$file = $_FILES;

			if (isset($data['update'])) {
				$postValidator = new PostValidator($data);
				if (empty($postValidator->getErrors())) {
					$post = new Post([
						'title' => $data['title'],
						'chapo' => $data['chapo'],
						'content' => $data['content'],
						'usersId' => $data['authorId'],
						'id' => $post->getId()
					]);
					$postManager->update($post);
					$updateSuccess = 'info';
				} else {
					$errors = $postValidator->getErrors();
				}
			}
			if (isset($data['updateImg'])) {
				$postValidator = new PostValidator(['img' => $file['img']]);
				if (empty($postValidator->getErrors())) {
					$uploaddir = $_ENV['IMG_DIR_POST'];
					$uploadfile = $uploaddir.time().'-'.basename($file['img']['name']);
					$img = new Post([
						'id' => $post->getId(),
						'img' => $uploadfile
					]);
					if (unlink($post->getImg()) && move_uploaded_file($file['img']['tmp_name'], $img->getImg())) {
						$postManager->updateImg($img);
						$updateSuccess = 'img';
					}
				} else {
					$errors = $postValidator->getErrors();
				}
			}

			$this->render('view/backend/updatePost.php','view/template/page.php', compact('userSession','title','usersAdmin','post','errors', 'postValidator','updateSuccess'));
		}
	}

	/**
	 * This function delete a Post
	 * @param int $idPost id of Post
	 */
	public function deletePost(int $idPost)
	{
		$userSession = Session::get('user');

		if ($this->userSessionValid($userSession,2)) {
			$postManager = new PostManager();
			$imgName = $postManager->getPost($idPost)->getImg();
			if (unlink($imgName)) {
				$postManager->delete($idPost);
			}
		}		
	}

	/**
	 * Return List comments page
	 * @return
	 */
	public function listComment()
	{
		$userSession = Session::get('user');

		if ($this->userSessionValid($userSession,2)) {

			$title = 'Liste des Commentaires';
			$commentManager = new CommentManager();
			$comments = $commentManager->getListOf();

			$commentWaiting = [];
			$commentValid = [];

			foreach ($comments as $comment) {
				if ($comment->getStatus() == 1) {
					$commentValid[] = $comment;
				} else {
					$commentWaiting[] = $comment;
				}
			}
			
			$this->render('view/backend/listComment.php','view/template/page.php', compact('userSession','title','commentWaiting','commentValid'));
		}
	}

	/**
	 * Return Update comment Page
	 * @param  int $idComment Id of comment
	 * @return
	 */
	public function updateComment(int $idComment)
	{
		$userSession = Session::get('user');

		if ($this->userSessionValid($userSession,2)) {

			$title = 'Modifier un Commentaire';
			$commentManager = new CommentManager();
			$comment = $commentManager->getComment($idComment);

			$data = filter_input_array(INPUT_POST);

			if (isset($data['update'])) {
				$commentValidator = new CommentValidator($data);
				if (empty($commentValidator->getErrors())) {
					$commentUpdate = new Comment([
						'status' => $data['status'],
						'id' => $comment->getId()
					]);
					$commentManager->update($commentUpdate);
					$success = true;
				} else {
					$errors = $commentValidator->getErrors();
				}
			}
			$this->render('view/backend/updateComment.php','view/template/page.php', compact('userSession','title','data','comment','commentValidator','errors','success'));
		}	
	}

	/**
	 * Delete Comment
	 * @param  int $idComment Id of comment
	 */
	public function deleteComment(int $idComment)
	{
		$userSession = Session::get('user');
		if ($this->userSessionValid($userSession,2)) {
			$commentManager = new CommentManager();
			$commentManager->delete($idComment);
		}
	}

	/**
	 * Cette fonction permet d'afficher les listes des utilisateurs
	 * @return la page liste des utilisateurs
	 */
	public function listUser()
	{
		$userSession = Session::get('user');
		if ($this->userSessionValid($userSession,1)) {
			$title = 'Liste des Utilisateurs';
			$userManager = new UserManager();
			$users = $userManager->getListOf();

			$this->render('view/backend/listUser.php','view/template/page.php', compact('userSession','title','users'));
		}
	}

	/**
	 * Return Update User page
	 * @param  int  $idUser Id of User
	 * @return
	 */
	public function updateUser(int $idUser) {

		$userSession = Session::get('user');

		if ($this->userSessionValid($userSession,1)) {
			$title = 'Modifier un Utilisateur';
			$userManager = new UserManager();
			$user = $userManager->getUser($idUser);
			$roles = $userManager->getListOfRole();

			$data = filter_input_array(INPUT_POST);

			if (isset($data['update'])) {
				$userValidator = new UserValidator($data);
				if (empty($userValidator->getErrors())) {
					$userUpdate = new User([
						'rolesId' => $data['role'],
						'id' => $user->getId()
					]);
					$userManager->updateRole($userUpdate);
					$success = true;
				} else {
					$errors = $userValidator->getErrors();
				}
			}

			$this->render('view/backend/updateUser.php','view/template/page.php', compact('userSession','title','user','roles','data','errors','userValidator','success'));
		}	
	}

	/**
	 * Delete User
	 * @param int $idUser Id of User
	 */
	public function deleteUser(int $idUser)
	{
		$userSession = Session::get('user');

		if ($this->userSessionValid($userSession,1)) {
			$commentManager = new UserManager();
			$commentManager->delete($idUser);
		}		
	}

	/**
	 * Private function verify User Id to continue 
	 * @param  avoid $userSession object User or Null
	 * @param  int $idUser      Id User
	 * @return page 404 or true
	 */
	private function userSessionValid($userSession,$idUser) {
		if ($userSession == null || $userSession->getRolesId() > $idUser) {
			$this->page404();
			exit;
		}

		return true;

	}
}
