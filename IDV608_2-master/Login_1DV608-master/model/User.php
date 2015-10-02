<?php

require_once('UserDAL.php');

class User{

	private $name;
	private $passwordHash;
	private $userDAL;
	
	public function __construct($name, $password)
	{
		$this->userDAL = new UserDAL();

		$this->name = $name;
		$this->passwordHash = $this->hash($password);
	}

	public function checkIfUserExists()
	{
		return $this->userDAL->checkIfUserExists($this->name);
	}

	public function getUsername()
	{
		return $this->name;
	}

	public function getPasswordHash()
	{
		return $this->passwordHash;
	}

	public function comparePassword($password)
	{
		return $this->hash($password) == $this->passwordHash;
	}

	private function hash($string)
	{
		$name = $this->name;
		return sha1("secretsaltyo$name$string$name");
	}

}