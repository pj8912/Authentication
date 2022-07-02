<?php
session_start();

//include '../config/db.php';



if (isset($_SERVER['REQUEST_METHOD']) == "POST") {
    if (isset($_POST['lbtn'])) {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


        $uname = htmlentities(strip_tags($_POST['uname']));
        $pwd = strip_tags($_POST['pwd']);



        if (empty($uname)) {
            header('location:../index.php?uname_empty');
            exit();
        }
        if (empty($pwd)) {
            header('location:../index.php?pwd_empty');
            exit();
        }


        require_once '../config/Database.php';
        require_once '../models/User.php';

        $db = new Database();
        $db = $db->connect();

        $user = new User($db);

        $user->uname = $uname;

        $result = $user->checkUser_Uname();

        //$sql = "SELECT * FROM users WHERE user_uname = '$uname' ";
        //$result = mysqli_query($conn, $sql);

        $num = $result->rowCount();

        if ($num > 0) {


            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                $hashedpwd = $row['user_pwd'];

                $hashedPwdCheck  = password_verify($pwd, $hashedpwd);



                if ($hashedPwdCheck == false) {
                    header("Location: ../index.php?login=error");
                    exit();
                } else {

                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_name'] = $row['user_fullname'];
                    $_SESSION['u_email'] = $row['user_email'];
                    $_SESSION['u_uid'] = $row['user_uname'];

                    header("location: ../index.php");
                    exit();
                }
            }
        } else {
            header('location: ../index.php?uname_err');
            exit();
        }
    }
}
