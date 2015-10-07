<?php

class UserCredentials{
	
	private $userNameInput;
	private $passwordInput;
	private $repeatedPasswordInput;
	private $messageKey;
	
	public function __construct()
	{
		
	}

	public function getRegistrationFormData($name, $password, $repeatedPassword)
	{
		$this->userNameInput = $name;
		$this->passwordInput = $password;
		$this->repeatedPasswordInput = $repeatedPassword;

		$result = $this->validateRegistrationFormData();

		
		if(isset($this->messageKey))
		{
			$result = false;
		}
		else
		{
			$result = true;
		}

		return $result;		
	}

	public function validateRegistrationFormData()
	{

		if(is_numeric($this->userNameInput) || strlen($this->userNameInput) < 3 || $this->userNameInput == NULL && $this->passwordInput == NULL)
		{
			$this->messageKey = FeedbackStrings::UNAMEFAIL;
		}
		else if(strlen($this->passwordInput) < 6)
		{
			$this->messageKey = FeedbackStrings::PWORDFAIL;
		}
		else if($this->repeatedPasswordInput != $this->passwordInput)
		{
			$this->messageKey = FeedbackStrings::REPEATPASSWORDFAIL;
		}
		else if(preg_match('/[^A-Za-z0-9.#\\-$]/', $this->userNameInput))
		{
			$this->messageKey = FeedbackStrings::INVALIDCHARFAIL;
		}
		else if(User::checkIfUserExists($this->userNameInput))
		{
			$this->messageKey = FeedbackStrings::UNAMEEXISTSFAIL;
		}

		return $this->messageKey;

	}

	public function getMessageKey()
	{
		return $this->messageKey;
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