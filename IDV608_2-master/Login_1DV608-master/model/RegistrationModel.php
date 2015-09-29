<?php


class RegistrationModel{

	private $userNameInput;
	private $passwordInput;
	private $repeatedPasswordInput;

	const regFail = 1;
	const uNameFail = 2;
	const pWordFail = 3;
	const repeatedPWordFail = 4;
	const regSuccess = 5;

	
	public function __construct()
	{
		//someshit
	}

	public function validateRegistrationFormData()
	{	
		if(is_numeric($this->userNameInput) || strlen($this->userNameInput) < 4 || $this->userNameInput == NULL && $this->passwordInput == NULL)
		{
			return self::uNameFail;
		}
		else if(strlen($this->passwordInput) < 7)
		{
			return self::pWordFail;
		}
		else if($this->repeatedPasswordInput !== $this->passwordInput)
		{
			return self::repeatedPWordFail;
		}

		return self::regSuccess;
	}

	public function getRegistrationFormData($name, $password, $repeatedPassword)
	{

		$this->userNameInput = $name;
		$this->passwordInput = $password;
		$this->repeatedPassword = $repeatedPassword;

		$result = $this->validateRegistrationFormData();
			if($result != self::regSuccess)
				return $result;

	}

}