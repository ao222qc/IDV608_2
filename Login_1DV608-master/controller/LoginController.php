<?php

class LoginController{

	private $logInView;
	private $logInModel;


	//Constructor initiates object of LoginView 'n' model
	public function __construct(LoginView $logInView, LoginModel $logInModel){

		$this->logInView = $logInView;
		$this->logInModel = $logInModel;
	}

	//Calls function in LoginView that returnes true/false based on if $_POST 'is set'
	public function checkUserAction(){
		
		if($this->logInView->hasUserPosted()){

		    $this->sendUserInputToModel();
		}
		return null;
	}

	public function sendUserInputToModel(){

		$this->logInModel->checkUserInput($this->logInView->userNameLoginInput(), $this->logInView->userPasswordLoginInput());

		return null;
	}

	//calls function that returns true/false wether the user has entered the correct credentials, returns this value to the index file (bool in render)
	public function checkIfLoggedIn(){

		return $this->logInModel->isUserLoggedIn();
	}
}





	/*public function getUserName(){
	
		 return $this->logInView->userNameLoginInput();
	}

	public function getUserPassword(){

		 return $this->logInView->userPasswordLoginInput();

	}*/