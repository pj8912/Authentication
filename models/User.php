<?php

class User{

	private $conn;

	public function __construct($db){ 
		$this->conn = $db;
	}
	
		
	private $table = "users";

	public $user_id, $fullname, $email, $uname ,$pwd;



	//common query for checking 
	//
	//
	public function checkuser_uname(){
		$sql = "SELECT * FROM {$this->table} WHERE user_uname = :user_uname";
		$stmt = $this->prepare($sql);
		$stmt->bindParam(':user_uname', $this->uname);
		$stmt->execute();
		return $stmt;
	}


	public function getUserById(){
		$sql= "SELECT * FROM users WHERE user_id = :user_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':user_id', $this->user_id);
		$stmt->execute();
		return $stmt;
	}


	public function createUser(){
		$sql = "INSERT INTO {$this->table}(user_fullname, user_email, user_uname, user_pwd, created_at) VALUES(:user_fullname, :user_email, :user_uname, :user_pwd, :created_at)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':user_fullname', $this->fullname);
		$stmt->bindParam(':user_email', $this->email);
		$stmt->bindParam(':user_uname', $this->uname);
		$stmt->bindParam(':user_pwd', $this->pwd);
		$stmt->bindParam(':created_at', 'NOW()');
		$stmt->execute();
	}

	public function update_last_seen(){
		$sql = "INSERT INTO {$this->table}(last_seen) VALUES(NOW()) WHERE user_id = :user_id";
		$stmt = $this->conn->prepare($sql);
		$this->user_id = (int) $this->user_id;
		$stmt->bindParam(':user_id', $this->user_id);
		$stmt->execute();
} 
