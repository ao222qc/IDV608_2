<?php

class LoginController{

	private $logInView;
	private $logInModel;
	private $userCredentials;
	private $regModel;
	private $validationResultID;
	private $responseSection;


	//Constructor initiates object of LoginView 'n' model
	public function __construct(LoginView $logInView, LoginModel $logInModel, UserCredentials $uc, RegistrationModel $regModel){

		$this->logInView = $logInView;
		$this->logInModel = $logInModel;
		$this->userCredentials = $uc;
		$this->regModel = $regModel;
	}

	public function checkUserAction(){
	
		if($this->logInView->hasUserTriedLogin())
		{	
			$this->validationResultID = $this->logInModel->tryLoginUser($this->logInView->userNameLoginInput(), $this->logInView->userPasswordLoginInput());
			$this->responseSection = FeedbackStrings::SECTION_LOGIN;
		}

		else if($this->logInView->hasUserLoggedOut())
		{
			$this->validationResultID = $this->logInModel->userLoggedOut();
			$this->responseSection = FeedbackStrings::SECTION_LOGIN;
		} 	

		else if($this->logInView->RegisterFormSubmitted())
		{
			//will return a value in a constant from FeedbackStrings if validation fails, otherwise returns true
			$this->validationResultID = $this->userCredentials->getRegistrationFormData($this->logInView->regUserNameInput(), $this->logInView->regPasswordInput(), $this->logInView->checkRegPasswordInput());

			if ($this->validationResultID == true)
			{
				$user = null;
				$this->validationResultID = $this->regModel->tryRegister($this->userCredentials,$user);
				$this->responseSection = FeedbackStrings::SECTION_REGISTER;

				if ($regResult == FeedbackStrings::REGISTRATIONSUCCESS)
				{
					$this->logInView->setUserInputResponse(FeedbackStrings::Get($this->responseSection, $this->validationResultID));
				}
			}
		}
		$this->logInView->setUserInputResponse(FeedbackStrings::Get($this->responseSection, $this->validationResultID));
	}

	public function checkIfLoggedIn(){

		return $this->logInModel->userLoggedIn();
	}

}
