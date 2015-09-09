<?php

class LoginController{

	private $userInputName;
	private $userInputPassword;
	private $logInView;
	private $logInModel;

	public function getUserName(){

		 $this->userInputName = $this->logInView->userNameLoginInput();	

		 return $this->userInputName;
	}

	public function getUserPassword(){

		 $this->userInputPassword = $this->logInView->userPasswordLoginInput();

		 return $this->userInputPassword;

	}

	public function userInputToModel($userName, $userPassword)
	{
		$this->userInputName = $userName;
		$this->userInputPassword = $userPassword;

		$this->logInModel->checkUserInput($userName, $userPassword);

	}

	//Constructor initiates object of LoginView
	public function __construct(LoginView $logInView, LoginModel $logInModel){

		$this->logInView = $logInView;
		$this->logInModel = $logInModel;
	}

	//Calls function in LoginView that returnes true/false based on if $_POST 'is set'
	public function checkUserAction()
	{
		if($this->logInView->hasUserPosted())
		{			
			 $name = $this->getUserName();
			 $password = $this->getUserPassword();

			 $this->userInputToModel($name, $password);
		}
		return null;
	}
}