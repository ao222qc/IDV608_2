<?php

require_once('User.php');

class RegistrationModel{

	private $userName;
	private $password;


	public function tryRegister(UserCredentials $uc, &$user)
	{

		$this->userName = $uc->getUserName();
		$this->password = $uc->getPassword();

		$user = new User($this->userName, $this->password);

		if(!User::checkIfUserExists($this->userName))
		{
			User::AddUser($user);
			return true;
		}
	}
}