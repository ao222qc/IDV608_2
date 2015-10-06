<?php

class LoginController{

	private $logInView;
	private $logInModel;
	private $userCredentials;
	private $regModel;
	private $userDAL;

	//Constructor initiates object of LoginView 'n' model
	public function __construct(LoginView $logInView, LoginModel $logInModel, UserCredentials $uc, RegistrationModel $regModel, UserDAL $userDAL){

		$this->logInView = $logInView;
		$this->logInModel = $logInModel;
		$this->userCredentials = $uc;
		$this->regModel = $regModel;
		$this->userDAL = $userDAL;
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
			$result = $this->userCredentials->getRegistrationFormData($this->logInView->regUserNameInput(), $this->logInView->regPasswordInput(), $this->logInView->checkRegPasswordInput());
			if($result == UserCredentials::regSuccess)
			{
				$user = null;
				if ($this->regModel->tryRegister($this->userCredentials,$user))
				{
					//maybe send something to view here
				}
			}
			$this->logInView->setUserInputResponse($result);
		}
	}

	//calls function that returns true/false wether the user has entered the correct credentials, returns this value to the index file (bool in render)
	//Value returned by function is stored in a session variable.
	public function checkIfLoggedIn(){

		return $this->logInModel->userLoggedIn();
	}

}
