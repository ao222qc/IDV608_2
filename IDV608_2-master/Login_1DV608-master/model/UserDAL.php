<?php

class UserDAL{

	private $conn;


	public function __construct()
	{
		$this->createConnection();
	}	

	public function closeConnection()
	{

	}

	public function createConnection()
	{
		$mysql_host = Settings::mysql_host;
		$mysql_user = Settings::mysql_user;
		$mysql_password = Settings::mysql_password;	
		$mysql_localDatabase = Settings::mysql_database;

		/*$mysql_host = "mysql1.000webhost.com";
		$mysql_database = "a5510317_1dv608";
		$mysql_user = "a5510317_ao222qc";
		$mysql_password = "ao222qc";
		$mysql_user = "a5510317_ao222qc";
		$mysql_database = "a5510317_1dv608";*/	

		$this->conn = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_localDatabase);

		if($this->conn->connect_error)
		{
			die();
		}	
	}

	public function addUser(User $user)
	{
		$username = $user->getUsername();
		$password = $user->getPasswordHash();

		$username = mysqli_escape_string($this->conn,$username);
		$password = mysqli_escape_string($this->conn,$password);

		mysqli_query($this->conn, "INSERT INTO member (Username, Password) VALUES ('$username', '$password')");
	}

	public function checkIfUserExistsInDataBase($username)
	{
		$username = mysqli_escape_string($this->conn,$username);

		$query = "SELECT Username FROM member WHERE Username = '$username'";

		$result = $this->conn->query($query);

		$row = $result->fetch_array(MYSQLI_ASSOC);

		return isset($row);
	}

	public function getUserData($username)
	{
		$username = mysqli_escape_string($this->conn,$username);

		$query = "SELECT Username,Password FROM member WHERE Username = '$username'";

		$result = $this->conn->query($query);

		$row = $result->fetch_array(MYSQLI_ASSOC);

		return isset($row) ? array("username" => $row['Username'],"password" => $row['Password']) : null;
	}
}

