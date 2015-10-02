<?php

require_once('User.php');

class RegistrationModel{

	private $userName;
	private $password;
	private $USER;
	private $userDAL;


	public function __construct()
	{
		$this->userDAL = new UserDAL();
	}


	public function tryRegister(UserCredentials $uc, &$user)
	{

		$this->userName = $uc->getUserName();
		$this->password = $uc->getPassword();

		$user = new User($this->userName, $this->password);

		if(!$this->userDAL->checkIfUserExists($this->userName))
		{
			$this->userDAL->addUser($user);
			return true;
		}
	}

	public function IsSame()
	{

	}

}