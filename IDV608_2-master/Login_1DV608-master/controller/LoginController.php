<?php

class LoginController{

	private $logInView;
	private $logInModel;
	private $dataValidationModel;


	//Constructor initiates object of LoginView 'n' model
	public function __construct(LoginView $logInView, LoginModel $logInModel, DataValidationModel $dmv){

		$this->logInView = $logInView;
		$this->logInModel = $logInModel;
		$this->dataValidationModel = $dmv;
	}

	public function checkUserAction(){
	
		if($this->logInView->hasUserTriedLogin())
		{
			try
			{
				//Function to validate that the data has been inputted correctly, throws exceptions based on what data is missing.
				//If no exceptions thrown, returns true which means we can send the data to the loginmodel to attempt a login.
				if($this->dataValidationModel->checkIfUserSuppliedInput($this->logInView->userNameLoginInput(), $this->logInView->userPasswordLoginInput()))
				{
					$this->logInModel->tryLoginUser($this->logInView->userNameLoginInput(), $this->logInView->userPasswordLoginInput());
				}
			}	
			catch(Exception $e)
			{
				$this->logInView->setUserInputResponse($e->getMessage());
			}	 
		}

		else if($this->logInView->hasUserLoggedOut())
		{
			$this->logInModel->userLoggedOut();
		}
		return null;
	}

	//calls function that returns true/false wether the user has entered the correct credentials, returns this value to the index file (bool in render)
	//Value returned by function is stored in a session variable.
	public function checkIfLoggedIn(){

		return $this->logInModel->userLoggedIn();
	}

}
