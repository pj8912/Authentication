<!-- signup -->

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>


<div class="m-auto mt-5 card card-body col-md-6">
    <p class="h1 " align="center">NotesApp</p>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3">
            <input class="form-control" type="text" name="flname" placeholder="FullName">
        </div>

        <div class="mb-3">
            <input class="form-control" type="email" name="email" placeholder="Email">
        </div>

        <div class="mb-3">
            <input class="form-control" type="text" name="uname" placeholder="UserName">
        </div>

        <div class="mb-3">

            <input class="form-control" type="password" name="pwd" placeholder="Password (Not less than 8 characters*)">
            <!-- <p</pre> -->
            <!-- <PRE></PRE> -->
        </div>

        <div class="mb-3 d-grid gap-2  ">
            <button type="submit" name="sbtn" class=" btn btn-success" align="center">

                Sign Up
            </button>
        </div>
        <p class="text-center">Already have an account <a href="../index.php">Log in</a></p>
    </form>

</div>


<?php

//include '../config/db.php';

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    if (isset($_POST['sbtn'])) {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	/**
        $name = mysqli_real_escape_string($conn, $_POST['flname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $uid = mysqli_real_escape_string($conn, $_POST['uname']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	**/

	$name = htmlentities(strip_tags($_POST['flname']));
	$email = htmlentities(strip_tags($_POST['email']));
	$uid = htmlentities(strip_tags($_POST['uname']));
	$pwd = strip_tags($_POST['pwd']);


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
        } elseif (!preg_match("/^[a-z A-Z0-9]*$/", $uid)) {
            header("Location: index.php?error=incorrect" . $uid);
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: index.php?error=empty");
            exit();
	} else {

            /**$sql = "SELECT * FROM users WHERE user_uname = '$uid' ";

            $result = mysqli_query($conn, $sql);

	    $num = mysqli_num_rows($result);
	    **/

		require '../models/User.php';
		require '../config.php';

		$db = new Database();
		$db = $db->connect();
		$user = new User($db);
		$user->fullname = $name;
		$user->email = $email;
		$user->uname = $uid;

		$result = $user->checkUser_Uname();
		$num = $result->rowCount();

            if ($num > 0) {
		   header("Location: ../index.php?err=uname");
                exit();
            } else {
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
		$user->pwd = $hashedPwd;
		$user->createUser();

		//$sql = "INSERT INTO users(user_fullname, user_email, user_uname, user_pwd,created_at) VALUES('$name', '$email', '$uid', '$hashedPwd', NOW()) ";
                //mysqli_query($conn, $sql);
		
		header("Location: ../index.php?signup=sucess");
                exit();
            }
        }
    }
}
