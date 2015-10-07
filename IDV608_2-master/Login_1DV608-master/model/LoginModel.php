<?php
Session_start();

require_once("User.php");

class LoginModel {

	private $suppliedUserName;
	private $suppliedPassword;
	private static $userLoginSession = "userLoginSession";

	public function checkIfUserSuppliedInput($name, $password){

		$this->suppliedUserName = trim($name);

		$this->suppliedPassword = trim($password);

		if($this->suppliedUserName == NULL && $this->suppliedPassword == NULL || $this->suppliedUserName == NULL)
		{
			return FeedbackStrings::UNAMEFAIL;
		}
		else if($this->suppliedPassword == NULL)
		{
			return FeedbackStrings::PWORDFAIL;
		}

		return FeedbackStrings::LOGINSUCCESS;
	}

	public function tryLoginUser($suppliedUserName, $suppliedPassword)
	{
		$valid = $this->checkIfUserSuppliedInput($suppliedUserName,$suppliedPassword);

		if ($valid != FeedbackStrings::LOGINSUCCESS)
			return $valid;

		$user = User::Get($this->suppliedUserName);

		if ($user != NULL)
		{
			if ($user->comparePassword($this->suppliedPassword))
			{
				if(!isset($_SESSION[self::$userLoginSession]))
				{
					$_SESSION[self::$userLoginSession] = true;	
					return FeedbackStrings::LOGINSUCCESS;
				}
			}
		}
		else
		{
			return FeedbackStrings::LOGINFAIL;
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
			return FeedbackStrings::LOGOUTSUCCESS;
		}
	}	
}

