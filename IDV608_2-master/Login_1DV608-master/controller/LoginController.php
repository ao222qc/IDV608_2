<?php

class LoginController{

	private $logInView;
	private $logInModel;

	//Constructor initiates object of LoginView 'n' model
	public function __construct(LoginView $logInView, LoginModel $logInModel){

		$this->logInView = $logInView;
		$this->logInModel = $logInModel;
	}

	public function checkUserAction(){
	
		if($this->logInView->hasUserTriedLogin())
		{	
			$this->logInView->setUserInputResponse($this->logInModel->tryLoginUser($this->logInView->userNameLoginInput(), $this->logInView->userPasswordLoginInput()));							 
		}

		else if($this->logInView->hasUserLoggedOut())
		{
			$this->logInView->setUserInputResponse($this->logInModel->userLoggedOut());
		} 	
	}

	//calls function that returns true/false wether the user has entered the correct credentials, returns this value to the index file (bool in render)
	//Value returned by function is stored in a session variable.
	public function checkIfLoggedIn(){

		return $this->logInModel->userLoggedIn();
	}

}
