<?php

require_once('User.php');

class RegistrationModel{

	private $userName;
	private $password;
	private $validRegister;

	public function tryRegister(UserCredentials $uc, &$user)
	{
		$this->userName = $uc->getUserName();
		$this->password = $uc->getPassword();

		$user = new User($this->userName, $this->password);

		if(!User::checkIfUserExists($this->userName))
		{
			User::AddUser($user);
			$this->validRegister = true;
			return true;
		}
		else
		{
			return false;
		}
	}

	public function wasRegistrationSuccessful()
	{
		return $this->validRegister;
	}
}