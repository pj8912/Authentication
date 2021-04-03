<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>authentication</title>
</head>

<body>
    <!-- logout -->
    <?php
    if (isset($_SESSION['u_id'])) {
        echo '<a href="logout.php" class="btn btn-danger">Logout</a>';
    } else {
    }
    ?>
    <!-- login -->
    <form method="post" action="login.php">
        <h3>
            Login
        </h3>
        <input type="text" name="uname"  placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit" name="lbtn">login</button>
    </form>

    <p>
        Don't have an account?
        <a href="signup.php">Sign Up</a>
    </p>
    <!-- signup -->
</body>

</html>