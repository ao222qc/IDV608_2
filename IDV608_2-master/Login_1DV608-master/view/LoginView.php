<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private static $regName = 'LoginView::regName';
	private static $regPassword = 'LoginView::regPassword';
	private static $checkPassword = 'LoginView::checkPassword';
	private static $submitReg = 'LoginView::submitReg';
	private $logInModel;
	private $userInputFeedback;

	public function __construct(LoginModel $logInModel)
	{
		$this->logInModel = $logInModel;
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {

		$response = '';

		$response .= $this->generateRegistrationButtonHTML();

		if($this->RegisterButtonPressed() || $this->RegisterFormSubmitted())
		{
			return $this->generateRegistrationFormHTML();
		}
		else
		{	
			if(!$this->logInModel->userLoggedIn())
			{
				$response .= $this->generateLoginFormHTML($this->userInputFeedback);	
			}
			else if($this->logInModel->userLoggedIn())
			{
				$response .= $this->generateLogoutButtonHTML($this->userInputFeedback);
			}
		}

		return $response;
	}

	public function setUserInputResponse($userInputFeedback)
	{	
		switch ($userInputFeedback)
		{
			case LoginModel::UNAMEFAIL:
			$this->userInputFeedback = 'Username is missing';
			break;
			case LoginModel::PWORDFAIL:
			$this->userInputFeedback = 'Password is missing';
			break;
			case LoginModel::LOGINSUCCESS:
			$this->userInputFeedback = 'Welcome';
			break;
			case LoginModel::LOGINFAIL:
			$this->userInputFeedback = 'Wrong name or password';
			break;
			case LoginModel::LOGOUTSUCCESS:
			$this->userInputFeedback = 'Bye bye!';
		}
	}

	//Checks if logoutbutton is 'posted'.
	public function hasUserLoggedOut()
	{
		return isset($_POST[self::$logout]);
	}
	
	public function userNameLoginInput()
	{
		return $_POST[self::$name];
	}

	public function userPasswordLoginInput()
	{
		return  $_POST[self::$password];
	}

	public function regUserNameInput()
	{
		return $_POST[self::$regName];
	}

	public function regPasswordInput()
	{
		return $_POST[self::$regPassword];
	}

	public function checkRegPasswordInput()
	{
		return $_POST[self::$checkPassword];
	}

	//If the login button has been posted the user has tried to log in.
	public function hasUserTriedLogin()
	{
		return isset($_POST[self::$login]);
	}

	public function RegisterButtonPressed()
	{
		return isset($_POST['registrate']);
	}
	public function RegisterFormSubmitted()
	{
		return isset($_POST[self::$submitReg]);
	}


	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	private function generateRegistrationButtonHTML()
	{
	
			return '
			<form  method="post">
				<input type="submit" name="registrate" value="Register"/>
			</form>
		';

	}

	private function generateRegistrationFormHTML()
	{
		return '
			<form method="post" > 
				<input type="submit" name="backtologin" value="Back to login"/>
					<fieldset>
						<legend>Register a new user - Write username and password</legend>
						<label for="regUsername">Username :</label>
						<input type="text" id="' . self::$regName . '" name="' . self::$regName . '"  value=""/><br>
						<label for="regPassword">Password :</label>
						<input type="password" id="' . self::$regPassword . '" name="' . self::$regPassword . '" value=""/><br>
						<label for="checkPassword">Repeat password :</label>
						<input type="password" id="' . self::$checkPassword . '" name="' . self::$checkPassword . '" value=""/>
					</fieldset>
					<input type="submit" id="' . self::$submitReg .'" name="' . self::$submitReg .'" value="Submit"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'. ($this->hasUserTriedLogin() ? $this->userNameLoginInput() : "") . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME

		//return $_POST[self::$name];
	}
	
}