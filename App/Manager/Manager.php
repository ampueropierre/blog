<?php
namespace App\Manager;

class Manager
{
	protected function dbConnect()
	{
		$db = new \PDO('mysql:host=172.17.0.2;dbname=blog;charset=utf8', 'root', 'root');
		return $db;
	}
}
