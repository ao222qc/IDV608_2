<?php
session_start();

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private $logInModel;
	
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

		$message = '';
		$response = '';

		$message = $this->logInModel->getInputResultString();

		if($_SESSION['isUserLoggedIn'] == NULL)
		{

			if(!$this->logInModel->isUserLoggedIn())
			{
				$response = $this->generateLoginFormHTML($message);	
			}
			else 
			{
				$response .= $this->generateLogoutButtonHTML($message);
				$_SESSION['isUserLoggedIn'] = true;
			}	

		}
		else if ($_SESSION['isUserLoggedIn'] === true)
		{	
			$response .= $this->generateLogoutButtonHTML($message);
		}

		
		return $response;
	}

	//Nifty to drop eventual session variable if true
	//TODO ASK RASMUS
	public function hasUserLoggedOut()
	{
		if(isset($_POST[self::$logout]))
		{
			session_destroy();
			echo 'hej';
			return true;		
		}		
		else
		{
			return false;
		}
	}
	
	public function userNameLoginInput()
	{
		$userNameInput = $_POST[self::$name];

		return $userNameInput;
	}

	public function userPasswordLoginInput()
	{
		$userPasswordInput = $_POST[self::$password];

		return $userPasswordInput;
	}

	public function hasUserPosted()
	{

		if(isset($_POST[self::$login]))
		{
			return true;
		}
		else
		{
			return false;			
		}
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
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

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