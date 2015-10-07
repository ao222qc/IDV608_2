<?php

class LoginController{

	private $logInView;
	private $logInModel;
	private $userCredentials;
	private $regModel;

	public function __construct(LoginView $logInView, LoginModel $logInModel, UserCredentials $uc, RegistrationModel $regModel){

		$this->logInView = $logInView;
		$this->logInModel = $logInModel;
		$this->userCredentials = $uc;
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

			$validationResult = $this->userCredentials->getRegistrationFormData($this->logInView->regUserNameInput(), $this->logInView->regPasswordInput(), $this->logInView->checkRegPasswordInput());

			if ($validationResult == TRUE)
			{
				$user = null;

				$registerResult = $this->regModel->tryRegister($this->userCredentials, $user);

				$this->logInView->setUserInputResponse($registerResult);
			}
			else
			{
				$this->logInView->setUserInputResponse($validationResult);	
			}		
		}
	}

	public function checkIfLoggedIn(){

		return $this->logInModel->userLoggedIn();
	}

}
