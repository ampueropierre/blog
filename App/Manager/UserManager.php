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

		$q =  $req->fetch(\PDO::FETCH_ASSOC);

		if ($q && password_verify($password, $q['password']))
		{
			$user = new User();
			$user->hydrate($q);
			return $user;
		}

		return null;
	}

	public function add(User $user)
	{
		$db =$this->dbConnect();
		$req = $db->prepare('INSERT INTO users(firstname, lastname, mail, password) VALUES (:firstname, :lastname, :mail, :password)');
		$req->bindValue(':firstname', $user->firstname());
		$req->bindValue(':lastname', $user->lastname());
		$req->bindValue(':mail', $user->mail());
		$req->bindValue(':password', password_hash($user->password(), PASSWORD_DEFAULT));
		$req->execute();

		$user->setId($db->lastInsertId());

		return $user;

	}

	public function mailExist($mail)
	{
		$db= $this->dbConnect();
		$req = $db->prepare('SELECT mail FROM users WHERE mail = :mail');
		$req->bindValue(':mail', $mail);
		$req->execute();
		
		if ($req->fetch(\PDO::FETCH_ASSOC) > 0)
		{
			return true;
			
		}
		return false;
	}
}
