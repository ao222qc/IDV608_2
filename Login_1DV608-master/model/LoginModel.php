<?php

class LoginModel {

	private $suppliedUserName;
	private $suppliedPassword;
	private static $correctUserName = 'Admin';
	private static $correctPassword = 'password';
	private $response;
	private $view;

	public function checkUserInput($suppliedUserName, $suppliedPassword)
	{

		$this->suppliedUserName = $suppliedUserName;
		$this->suppliedPassword = $suppliedPassword;

		//1.2 Failed login with nothing entered in fields.
		//return false
		if($this->suppliedUserName == NULL && $this->suppliedPassword == NULL)
		{
			echo 'Username is missing';
			$this->response = 'Username is missing';
		}
		//1.3 Failed login with only username.
		//TODO Fill in admin as Username!
		//return false
		
		else if ($this->suppliedUserName != NULL && $this->suppliedPassword == NULL)
		{
			echo 'Password is missing';
			$this->response = 'Password is missing';
		}
		//1.4: Failed login with only password.
		//return false
		else if ($this->suppliedUserName == NULL && $this->suppliedPassword != NULL)
		{
			echo 'Username is missing';
			$this->response = 'Username is missing';
		}
		//1.5: Failed login with wrong password but existing username
		//return false
		//fill in admin as username
		else if ($this->suppliedUserName == self::$correctUserName && $this->suppliedPassword != self::$correctPassword)
		{
			echo 'Wrong name or password';
			$this->response = 'Wrong name or password';
		}
		//1.6: Failed login with existing password but wrong username
		//return false
		//password empty
		//admin filled in
		else if ($this->suppliedUserName != self::$correctUserName && $this->suppliedPassword == self::$correctPassword)
		{
			echo "Wrong name or password";
			$this->response = 'Wrong name of password';
		}
		//1.7: Successful login with correct Username and Password
		//The text "Logged in", is shown.
		//Feedback: "Welcome" is shown
		//A button for logout is shown.
		//(No login form)
		else if($this->suppliedUserName == self::$correctUserName && $this->suppliedPassword == self::$correctPassword)
		{
			echo 'you are logged in!';
			$this->response = 'Welcome';
		}
	}

	public function getInputResultString()
	{
		return $this->response;
	}
	
}