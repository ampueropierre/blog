<?php

namespace App\Manager;

class Manager
{
	protected function dbConnect()
	{
		$db = new \PDO('mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'].';charset=utf8', $_ENV['DB_USER'], $_ENV['DB_PASS']);
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		return $db;
	}
}
