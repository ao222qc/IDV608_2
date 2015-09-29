<?php


class RegistrationModel{

	private $userNameInput;
	private $passwordInput;
	private $repeatedPasswordInput;
	
	public function __construct()
	{


	}

	public function getRegistrationFormData($name, $password, $repeatedPassword)
	{
		$this->userNameInput = $name;
		$this->passwordInput = $password;
		$this->repeatedPassword = $repeatedPassword;
	}



}