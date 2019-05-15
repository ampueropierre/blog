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
		$req = $db->prepare('SELECT id, firstname, lastname, mail, password, role FROM users WHERE mail = :mail');
		$req->bindValue(':mail', $mail);
		$req->execute();

		$q =  $req->fetch(\PDO::FETCH_ASSOC);

		if ($q && password_verify($password, $q['password']))
		{
			$user = new User($q);
			return $user;
		}

		return null;
	}

	public function getUser($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, firstname, lastname, mail, role FROM users WHERE id = :id');
		$req->bindValue(':id', $id);
		$req->execute();

		$q = $req->fetch(\PDO::FETCH_ASSOC);

		$user = new User($q);

		return $user;
	}

	public function getUsers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT id, firstname, lastname, mail, password, role FROM users');
		var_dump(1);
		// $req->setFetchMode(\PDO::FETCH_CLASS, User::class);
		var_dump(2);
		$q = $req->fetchAll(\PDO::FETCH_CLASS, User::class);
		// $q = $req->fetchAll();
		var_dump($q);
		die;
	}

	public function add(User $user)
	{
		$db =$this->dbConnect();
		$req = $db->prepare('INSERT INTO users(firstname, lastname, mail, password) VALUES (:firstname, :lastname, :mail, :password)');
		$req->bindValue(':firstname', $user->getFirstname());
		$req->bindValue(':lastname', $user->getLastname());
		$req->bindValue(':mail', $user->getMail());
		$req->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT));
		$req->execute();

		$user->setId($db->lastInsertId());

		return $user;

	}

	public function update(User $user)
	{
		$db =$this->dbConnect();
		$req = $db->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, mail = :mail WHERE id = :id');
		$req->bindValue(':firstname', $user->getFirstname());
		$req->bindValue(':lastname', $user->getLastname());
		$req->bindValue(':mail', $user->getMail());
		$req->bindValue(':id', $user->getId());

		$req->execute();

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
