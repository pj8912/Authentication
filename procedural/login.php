<?php
session_start();
?>


    <?php

    if (isset($_POST['l-btn'])) {
      // db connection
      $conn = mysqli_connect('localhost', 'root', '', 'auth');

      $uname = mysqli_real_escape_string($conn, $_POST['uname']);
      $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);



      if (empty($uname) || empty($pwd)) {
        header("Location: ../index.php?err=empty");
        exit();
      }

      if (empty($uname)) {
        header("Location: ../index.php?err=u/e");
        exit();
      }
      if (empty($pwd)) {
        header("Location: ../index.php?err=p_empty");
        exit();
      } else {
        $sql = "SELECT * FROM users WHERE user_uname = '$uname' OR user_email ='$uname' ";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck < 1) {

          header("Location: ../index.php?login=err");
          exit();
        } else {
          while ($row = mysqli_fetch_assoc($result)) {
            $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
            if ($hashedPwdCheck == false) {
              header("Location: ../index.php?login=error");
              exit();
            } elseif ($hashedPwdCheck == true) {

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
    // else{
    //   header("Location: ../index.php?login=error");
    //   exit();
    // }





    ?>

    
        
