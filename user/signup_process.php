<?php

require_once '../vendor/autoload.php';
use Auth\database\Database;
use Auth\model\User;
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {

    if (isset($_POST['sbtn'])) {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $name = htmlentities(strip_tags($_POST['flname']));
        $email = htmlentities(strip_tags($_POST['email']));
        $pwd = strip_tags($_POST['pwd']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../index.php?error=empty");
            exit();
        } else {
            $db = new Database();
            $db = $db->connect();
            $user = new User($db);
            $user->fullname = $name;
            $user->email = $email;

            $result = $user->check_user();
            $num = $result->rowCount();
            if ($num > 0) {
                header('');
                exit();
            } else {
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                $user->pwd = $hashedPwd;
                //create user
                $user->createUser();
                header("Location: ../index.php?signup=success");
                exit();
            }
        }
    } else {
        header('Location: ../index.php');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
