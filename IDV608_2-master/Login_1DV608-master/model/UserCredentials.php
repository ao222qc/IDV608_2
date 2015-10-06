<?php

class UserCredentials{
	
	private $userNameInput;
	private $passwordInput;
	private $repeatedPasswordInput;

	const regFail = 1;
	const uNameFail = 2;
	const pWordFail = 3;
	const repeatedPWordFail = 4;
	const uNameExistsFail = 5;
	const invalidCharFail = 6;
	const regSuccess = 7;

	
	public function __construct()
	{
		
	}

	public function getRegistrationFormData($name, $password, $repeatedPassword)
	{
		$this->userNameInput = $name;
		$this->passwordInput = $password;
		$this->repeatedPasswordInput = $repeatedPassword;

		$result = $this->validateRegistrationFormData();

		if($result != self::regSuccess)
			return $result;	

			return self::regSuccess;
	}

	public function validateRegistrationFormData()
	{
		if(is_numeric($this->userNameInput) || strlen($this->userNameInput) < 4 || $this->userNameInput == NULL && $this->passwordInput == NULL)
		{
			return self::uNameFail;
		}
		else if(strlen($this->passwordInput) < 6)
		{
			return self::pWordFail;
		}
		else if($this->repeatedPasswordInput != $this->passwordInput)
		{
			return self::repeatedPWordFail;
		}
		else if(preg_match('/[^A-Za-z0-9.#\\-$]/', $this->userNameInput))
		{
			return self::invalidCharFail;
		}
		else if(User::checkIfUserExists($this->userNameInput))
		{
			return self::uNameExistsFail;
		}

		return self::regSuccess;
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