<?php
Session_start();

class LoginModel {

	private $suppliedUserName;
	private $suppliedPassword;
	private static $correctUserName = 'Admin';
	private static $correctPassword = 'password';
	private static $userLoginSession = "userLoginSession";
	const UNAMEFAIL = 1;
	const PWORDFAIL = 2;
	const LOGINSUCCESS = 3;
	const LOGINFAIL = 4;
	const LOGOUTSUCCESS = 5;
	const SUCCESS = 6;

	public function checkIfUserSuppliedInput($name, $password){

		$this->suppliedUserName = trim($name);

		$this->suppliedPassword = trim($password);

		if($this->suppliedUserName == NULL && $this->suppliedPassword == NULL || $this->suppliedUserName == NULL)
		{
			return self::UNAMEFAIL;
		}
		else if($this->suppliedPassword == NULL)
		{
			return self::PWORDFAIL;
		}

		return self::SUCCESS;
	}

	public function tryLoginUser($suppliedUserName, $suppliedPassword)
	{
		$valid = $this->checkIfUserSuppliedInput($suppliedUserName,$suppliedPassword);

		if ($valid != self::SUCCESS)
			return $valid;

		if($this->suppliedUserName == self::$correctUserName && $this->suppliedPassword == self::$correctPassword)
		{

			if(!isset($_SESSION[self::$userLoginSession]))
			{
				$_SESSION[self::$userLoginSession] = true;	
				return self::LOGINSUCCESS;
			}

		}
		else if($this->suppliedUserName != self::$correctUserName || $this->suppliedPassword != self::$correctPassword)
		{
			return self::LOGINFAIL;
		}
	}

	//function returns a bool if user is logged in.
	public function userLoggedIn(){

		return isset($_SESSION[self::$userLoginSession]);
	}

	public function userLoggedOut(){

		if(isset($_SESSION[self::$userLoginSession]))
		{
			unset($_SESSION[self::$userLoginSession]);
			return self::LOGOUTSUCCESS;
		}
	}	
}

