<?php
Session_start();

class LoginModel {

	private $suppliedUserName;
	private $suppliedPassword;
	private static $correctUserName = 'Admin';
	private static $correctPassword = 'password';
	private static $userLoginSession = "userLoginSession";

	public function tryLoginUser($suppliedUserName, $suppliedPassword)
	{
		$this->suppliedUserName = trim($suppliedUserName);

		$this->suppliedPassword = trim($suppliedPassword);

		if($this->suppliedUserName == self::$correctUserName && $this->suppliedPassword == self::$correctPassword)
		{
			$_SESSION[self::$userLoginSession] = true;	
		}
		else
		{
			throw new Exception('Wrong name or password');
		}
	}

	//function returns a bool if user is logged in.
	public function userLoggedIn(){

		return isset($_SESSION[self::$userLoginSession]);
	}

	//This is checked in controller if user has 'posted' logout button, this function in the model is then called and the session variable is set to false.
	public function userLoggedOut(){

		unset($_SESSION[self::$userLoginSession]);

	}	
}

