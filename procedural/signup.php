<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>
    Talkin</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>

  <?php if (isset($_REQUEST['sn'])) : ?>
    <form action="signup.php" class="text-center mt-5 p-3 " method="post" enctype="multipart/form-data">
      <input type="text" name="flname" placeholder="fullname"><br>
      <input type="email" name="email" placeholder="email"><br>
      <input type="text" name="uname" placeholder="username"><br>
      <input type="password" name="pwd" placeholder="password">
      <?php
      if (isset($_REQUEST['pwd'])) {
        echo '      <div class="w-100 alert alert-danger" role="alert">
          Minimum 8 characters required
          </div>';
      }
      ?>

      <br>
      <button name="s-btn" type="submit">submit</button>
    </form>
  <?php endif; ?>

  <?php

  if (isset($_POST['s-btn'])) {
    $conn = mysqli_connect("localhost", "root", "", "auth");


    $name = mysqli_real_escape_string($conn, trim(strip_tags($_POST['flname'])));
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['uname']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    //error handlers...
    if (empty($name) || empty($email) || empty($uid) || empty($pwd)) {
      header("Location: index.php?error=empty");
      exit();
    } elseif (!preg_match("/^[a-z A-Z]*$/", $name)) {
      header("Location: index.php?error=" . $name);
      exit();
    }
    if (strlen($pwd) < 8) {

      header("Location:signup.php?sn&pwd=err");
      exit();
    }
    // elseif (!preg_match("/^[a-zA-Z0-9]*$/", $uid) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //   header("Location: signupform.php?error=empty");
    //   exit();
    // }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
      header("Location: index.php?error=incorrect" . $uid);
      exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: index.php?error=empty");
      exit();
    } else {
      $sql = "SELECT * FROM users WHERE user_email ='$email'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      if ($resultCheck > 0) {
        header("Location: index.php?error=email");
        exit();
      }

      $sql = "SELECT * FROM users WHERE user_uname ='$uid'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      if ($resultCheck > 0) {
        header("Location: index.php?error=uname");
        exit();
      } else {
        $hasedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(user_fullname, user_email, user_uname, user_pwd) VALUES ('$name', '$email', '$uid', '$hasedPwd');";
        mysqli_query($conn, $sql);
        header("Location: ../index.php?signup=sucess");
        exit();
      }
    }
  }




  ?>



</body>

</html>