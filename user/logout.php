<?php session_start();?>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');




if (isset($_SESSION['u_id'])) {

	require '../config/Database.php';
	require '../models/User.php';

	$database = new Database();
	$db = $database->connect();

	$user = new User($db);
	$uid = $_SESSION['u_id'];
	$user->update_last_seen($uid);

	session_unset();
	session_destroy();

	header('location: ../index.php');
	exit();
}
