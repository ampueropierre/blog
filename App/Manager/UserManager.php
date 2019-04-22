<?php
namespace App\Manager;

use App\Model\User;
/**
 * 
 */
class UserManager extends Manager
{
	public function getLoggedUser($mail, $password)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, firstname, lastname, mail, password FROM users WHERE mail = :mail');
		$req->bindValue(':mail', $mail);
		$req->execute();

		$q =  $req->fetch();

		if ($q && password_verify($password, $q['password']))
		{
			$user = new User();

			return $user->hydrate($q);

		}

		return null;
	}

	public function addUser(array $data)
	{
		$db =$this->dbConnect();
		$req = $db->prepare('INSERT INTO users(firstname, lastname, mail, password) VALUES (:firstname, :lastname, :mail, :password)');
		$req->bindValue(':firstname', $data['firstname']);
		$req->bindValue(':lastname', $data['lastname']);
		$req->bindValue(':mail', $data['mail']);
		$req->bindValue(':password', password_hash($data['password'], PASSWORD_DEFAULT));
		$req->execute();
	}
}
