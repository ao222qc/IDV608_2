<?php

class LoginController{

	private $logInView;
	private $logInModel;


	//Constructor initiates object of LoginView 'n' model
	public function __construct(LoginView $logInView, LoginModel $logInModel){

		$this->logInView = $logInView;
		$this->logInModel = $logInModel;
	}

	//Checks functions in loginview that returns true/false wether values have been 'posted' or not. 
	//I.E login or logout button.
	public function checkUserAction(){
	
		if($this->logInView->hasUserTriedLogin())
		{
			try
			{
				$this->dataValidationModel->checkIfUserSuppliedInput($this->logInView->userNameLoginInput(), $this->logInView->userPasswordLoginInput()); 
			}	
			catch(Exception $e)
			{
				//do something with $e->getMessage();
				//$this->logInView->setErrorMessage($e->getMessage());
			}	 

			$this->tryToLogInUser();	

		}
		else if($this->logInView->hasUserLoggedOut())
		{
			$this->logInModel->userLoggedOut();
		}
		return null;
	}

	public function tryToLogInUser(){

		try
		{
			$this->logInModel->checkUserInput($this->logInView->userNameLoginInput(), $this->logInView->userPasswordLoginInput());
		}
		catch(Exception $e)
		{
			$whatWentWrong = $e->getMessage();
			$this->view->setError($whatWentWrong);
		}
	}

	//calls function that returns true/false wether the user has entered the correct credentials, returns this value to the index file (bool in render)
	//Value returned by function is stored in a session variable.
	public function checkIfLoggedIn(){


		return $this->logInModel->userLoggedInSession();
	}

}
