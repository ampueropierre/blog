<?php
namespace App\Manager;

use App\Model\User;
/**
 * 
 */
class UserManager extends Manager
{
	public function getUser(User $user)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, firstname, lastname, mail, password FROM users WHERE mail = :mail');
		$req->bindValue(':mail', $user->mail());
		$req->execute();

		$q =  $req->fetch();

		if ($q)
		{
			if (password_verify($user->password(), $q['password']))
			{
				$user->hydrate($q);
			}

		}

		return $user;
		
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