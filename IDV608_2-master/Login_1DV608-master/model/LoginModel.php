<?php
Session_start();

require_once("User.php");

class LoginModel {

	private $suppliedUserName;
	private $suppliedPassword;
	private static $userLoginSession = "userLoginSession";
	private $messageKey;


	public function checkIfUserSuppliedInput($name, $password){

		$this->suppliedUserName = trim($name);

		$this->suppliedPassword = trim($password);

		if($this->suppliedUserName == NULL && $this->suppliedPassword == NULL || $this->suppliedUserName == NULL)
		{
			$this->messageKey = FeedbackStrings::UNAMEFAIL;
		}
		else if($this->suppliedPassword == NULL)
		{
			$this->messageKey = FeedbackStrings::PWORDFAIL;
		}
		else
		{
			return true;
		}
	}

	public function tryLoginUser($suppliedUserName, $suppliedPassword)
	{
		$valid = $this->checkIfUserSuppliedInput($suppliedUserName,$suppliedPassword);

		if($valid != true)
		{	
			$valid = false;
			return $valid;
		}
		$user = User::Get($this->suppliedUserName);

		if ($user != NULL && $user->comparePassword($this->suppliedPassword))
		{
			if(!isset($_SESSION[self::$userLoginSession]))
			{
				$valid = true;
				$_SESSION[self::$userLoginSession] = true;	
				$this->messageKey = FeedbackStrings::LOGINSUCCESS;
			}
		}
		else
		{
			$this->messageKey = FeedbackStrings::LOGINFAIL;
			$valid = false;
		}
		
		return $valid;
	}

	public function getMessageKey()
	{
		return $this->messageKey;
	}

	//function returns a bool if user is logged in.
	public function userLoggedIn(){

		return isset($_SESSION[self::$userLoginSession]);
	}

	public function userLoggedOut(){

		if(isset($_SESSION[self::$userLoginSession]))
		{
			unset($_SESSION[self::$userLoginSession]);
			$this->messageKey = FeedbackStrings::LOGOUTSUCCESS;
			return true;
		}
	}	
}

