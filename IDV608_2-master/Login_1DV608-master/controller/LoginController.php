<?php

class LoginController{

	private $logInView;
	private $logInModel;
	private $regModel;

	//Constructor initiates object of LoginView 'n' model
	public function __construct(LoginView $logInView, LoginModel $logInModel, RegistrationModel $regModel){

		$this->logInView = $logInView;
		$this->logInModel = $logInModel;
		$this->regModel = $regModel;

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

		else if($this->logInView->RegisterFormSubmitted())
		{
			$this->logInView->setUserInputResponse($this->regModel->getRegistrationFormData($this->logInView->regUserNameInput(), $this->logInView->regPasswordInput(), $this->logInView->checkRegPasswordInput()));
		}
	}

	//calls function that returns true/false wether the user has entered the correct credentials, returns this value to the index file (bool in render)
	//Value returned by function is stored in a session variable.
	public function checkIfLoggedIn(){

		return $this->logInModel->userLoggedIn();
	}

}
