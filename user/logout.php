<?php

session_start();


require '../models/User.php';
require '../config/Database.php';


if (isset($_SESSION['u_id'])) {

	$databse = new Database();
	$db = $database->connect();
	$user = new User($db);
	$user->user_id = $_SESSION['u_id'];
	$user->update_last_seen(); //update last seen

    	session_unset();
	
	session_destroy();
       
	header('location: ../index.php');
   	exit();
}
