<?php

class UserCredentials{
	
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
		$this->repeatedPasswordInput = $repeatedPassword;

		$result = $this->validateRegistrationFormData();
		
		return $result;		
	}

	public function validateRegistrationFormData()
	{
		if(is_numeric($this->userNameInput) || strlen($this->userNameInput) < 4 || $this->userNameInput == NULL && $this->passwordInput == NULL)
		{
			return FeedbackStrings::UNAMEFAIL;
		}
		else if(strlen($this->passwordInput) < 6)
		{
			return FeedbackStrings::PWORDFAIL;
		}
		else if($this->repeatedPasswordInput != $this->passwordInput)
		{
			return FeedbackStrings::REPEATPASSWORDFAIL;
		}
		else if(preg_match('/[^A-Za-z0-9.#\\-$]/', $this->userNameInput))
		{
			return FeedbackStrings::INVALIDCHARFAIL;
		}
		else if(User::checkIfUserExists($this->userNameInput))
		{
			return FeedbackStrings::UNAMEEXISTSFAIL;
		}
		return FeedbackStrings::REGISTRATIONSUCCESS;
	}

	public function getUserName()
	{
		return $this->userNameInput;
	}

	public function getPassword()
	{
		return $this->passwordInput;
	}
}