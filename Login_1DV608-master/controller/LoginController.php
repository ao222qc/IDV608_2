<?php

class LoginController{

	private $userInputName;
	private $userInputPassword;
	private $logInView;
	private $logInModel;


	//Constructor initiates object of LoginView
	public function __construct(LoginView $logInView, LoginModel $logInModel){

		$this->logInView = $logInView;
		$this->logInModel = $logInModel;
	}

	//Calls function in LoginView that returnes true/false based on if $_POST 'is set'
	public function checkUserAction(){
		
		if($this->logInView->hasUserPosted())
		{			
			 $name = $this->getUserName();
			 
			 $password = $this->getUserPassword();

			 $this->userInputToModel();
		}
		return null;
	}

	public function getUserName(){

		 $this->userInputName = $this->logInView->userNameLoginInput();	

		 return $this->userInputName;
	}

	public function getUserPassword(){

		 $this->userInputPassword = $this->logInView->userPasswordLoginInput();

		 return $this->userInputPassword;

	}
	//Sends the user input to the model class.
	public function userInputToModel(){

		$this->logInModel->checkUserInput($this->userInputName, $this->userInputPassword);
	}
	//calls function that returns true/false wether the user has entered the correct credentials, returns this value to the index file (bool in render)
	public function checkIfLoggedIn(){
		return $this->logInModel->isUserLoggedIn();
	}

}