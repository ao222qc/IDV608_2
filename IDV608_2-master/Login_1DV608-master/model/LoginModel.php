<?php
Session_start();

class LoginModel {

	private $suppliedUserName;
	private $suppliedPassword;
	private static $correctUserName = 'Admin';
	private static $correctPassword = 'password';
	private $response;
	private $view;
	private static $userLoginSession = "userLoginSession";


	//Eventually make model for checking SQL injections / dangerous input via regex.

	//If the session variable isn't set to anything, I want it to be false. As in not logged in.
	public function __construct()
	{
		if(!isset($_SESSION[self::$userLoginSession]))
		{
			$_SESSION[self::$userLoginSession] = false;
		}
	}

	public function checkUserInput($suppliedUserName, $suppliedPassword)
	{
		$this->suppliedUserName = trim($suppliedUserName);

		$this->suppliedPassword = trim($suppliedPassword);

		if($this->suppliedUserName == self::$correctUserName && $this->suppliedPassword == self::$correctPassword)
		{
			$_SESSION[self::$userLoginSession] = true;	
		}

		return null;
	}


	//function returns a bool if user is logged in.
	public function userLoggedInSession(){

		return $_SESSION[self::$userLoginSession];
	}

	//This is checked in controller if user has 'posted' logout button, this function in the model is then called and the session variable is set to false.
	public function userLoggedOut(){

		$_SESSION[self::$userLoginSession] = false;

		return $_SESSION[self::$userLoginSession];
	}	
}


		//1.2 Failed login with nothing entered in fields.
		//1.4: Failed login with only password.
		//return false

		//1.3 Failed login with only username.
		//TODO Fill in admin as Username!
		//return false


		//1.5: Failed login with wrong password but existing username
		//return false
		//fill in admin as username
		//1.6: Failed login with existing password but wrong username
		//return false
		//password empty
		//admin filled in
		
				//1.7: Successful login with correct Username and Password
		//The text "Logged in", is shown.
		//Feedback: "Welcome" is shown
		//A button for logout is shown.
		//(No login form)	

/*
	public function checkIfUserNameSupplied()
	{
		return $this->suppliedUserName != NULL;
	}

	public function checkIfPasswordSupplied()
	{
		return $this->suppliedPassword != NULL;
	}

	public function checkIfWrongInput()
	{
		if($this->suppliedUserName != self::$correctUserName || $this->suppliedPassword != self::$correctPassword)
		{
			return true; 
		}
		else
		{
			return false;
		}
	}*/