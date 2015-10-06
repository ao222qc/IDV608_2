<?php

require_once('UserDAL.php');

class User{

	private $name;
	private $passwordHash;
	private static $userDAL;
	
	public static function Initialize()
	{
		self::$userDAL = new UserDAL();
	}

	public function __construct($name, $password = null)
	{
		$this->name = $name;
		if ($password != null)
			$this->passwordHash = $this->hash($password);
	}

	public function getUsername()
	{
		return $this->name;
	}

	public function getPasswordHash()
	{
		return $this->passwordHash;
	}

	public static function checkIfUserExists($name)
	{
		return self::$userDAL->checkIfUserExistsInDataBase($name);
	}

	public function comparePassword($password)
	{
		return $this->hash($password) == $this->passwordHash;
	}

	public function setPasswordHash($hash)
	{
		$this->passwordHash = $hash;
	}

	private function hash($string)
	{
		$name = $this->name;
		return sha1("secretsaltyo$name$string$name");
	}

	public static function AddUser(User $user)
	{
		self::$userDAL->addUser($user);
	}

	public static function Get($uname)
	{
		$data = self::$userDAL->getUserData($uname);

		if ($data == null)
			return null;

		$user = new User($data['username']);
		$user->setPasswordHash($data['password']);
		return $user;
	}

}