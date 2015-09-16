<?php

class DatavalidationModel {
	
	private $suppliedUserName;
	private $suppliedPassword;

	public function checkIfUserSuppliedInput($name, $password){

		$this->suppliedUserName = $name;
		$this->suppliedPassword = $password;

		if($this->suppliedUserName == NULL && $this->suppliedPassword == NULL || $this->suppliedUserName == NULL)
		{
			//User has not entered any data or only entered password.
			throw new Exception('Username is missing');
		}
		else if($this->suppliedPassword == NULL)
		{
			//No password given.
			throw new Exception('Password is missing');
		}
		else
		{
			//Data is given fully. Nice. Then we can try to log user in.
			return true;
		}
	}
}