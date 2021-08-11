<?php
session_start();

include '../config/db.php';



if (isset($_SERVER['REQUEST_METHOD']) == "POST") {
    if (isset($_POST['lbtn'])) {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $uname = mysqli_real_escape_string($conn, $_POST['uname']);

        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

        if (empty($uname)) {
            header('location:../index.php?uname_empty');
            exit();
        }
        if (empty($pwd)) {
            header('location:../index.php?pwd_empty');
            exit();
        }


        $sql = "SELECT * FROM users WHERE user_uname = '$uname' ";

        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if ($num  < 0) {
            header('location: ../index.php?uname_err');
            exit();
        } else {
            while ($row = mysqli_fetch_assoc($result)) {

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
        }
    }
}
