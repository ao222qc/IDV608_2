<?php

class DatavalidationModel {
	
	private $suppliedUserName;
	private $suppliedPassword;

	public function checkIfUserSuppliedInput($name, $password){

		$this->suppliedUserName = $name;
		$this->suppliedPassword = $password;

		if($this->suppliedUserName != NULL && $this->suppliedPassword != NULL)
		{
			//User has supplied enough data for us to try to log in with it.
		}
		else if($this->suppliedUserName == NULL)
		{
			//No username given.
		}
		else if($this->suppliedPassword == NULL)
		{
			//No password given.
		}
		else
		{
			//No data given.
		}
	}

	public function checkState(){

		

	}

}