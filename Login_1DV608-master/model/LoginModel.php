<?php

class LoginModel {

	private $suppliedUserName;
	private $suppliedPassword;
	private static $correctUserName = 'Admin';
	private static $correctPassword = 'password';
	private $response;
	private $view;
	private $isLoggedIn;

	public function checkUserInput($suppliedUserName, $suppliedPassword)
	{

		$this->isLoggedIn = false;

		$this->suppliedUserName = trim($suppliedUserName);

		$this->suppliedPassword = trim($suppliedPassword);

		//1.2 Failed login with nothing entered in fields.
		//1.4: Failed login with only password.
		//return false

		if($this->suppliedUserName == NULL && $this->suppliedPassword == NULL ||
		 $this->suppliedUserName == NULL && $this->suppliedPassword != NULL)
		{
			$this->response = 'Username is missing';
			
		}
		//1.3 Failed login with only username.
		//TODO Fill in admin as Username!
		//return false
		
		else if ($this->suppliedUserName != NULL && $this->suppliedPassword == NULL)
		{
			$this->response = 'Password is missing';			
		}

		//1.5: Failed login with wrong password but existing username
		//return false
		//fill in admin as username
		//1.6: Failed login with existing password but wrong username
		//return false
		//password empty
		//admin filled in

		else if ($this->suppliedUserName == self::$correctUserName && $this->suppliedPassword != self::$correctPassword ||
		 $this->suppliedUserName != self::$correctUserName && $this->suppliedPassword == self::$correctPassword)
		{
			$this->response = 'Wrong name or password';
		}

		//1.7: Successful login with correct Username and Password
		//The text "Logged in", is shown.
		//Feedback: "Welcome" is shown
		//A button for logout is shown.
		//(No login form)		

		else if($this->suppliedUserName == self::$correctUserName && $this->suppliedPassword == self::$correctPassword)
		{
			$this->response = 'Welcome';	
			$this->isLoggedIn = true;	
		}
	}

	//function to call to access the response based on input
	public function getInputResultString()
	{
		return $this->response;
	}
	//function returns a bool if user has entered correct credentials
	public function isUserLoggedIn()
	{
		return $this->isLoggedIn;
	}
	
}