<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>

<body>
    <div class="container">
        <div>
            <!-- to self -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                <div class="form-group">
                    <input type="text" name="flname" id="">
                </div>
                <div class="form-group">
                    <input type="text" name="uname" id="">
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="">
                </div>
                <div class="form-group">
                    <input type="password" name="pwd" id="">
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block">Sign Up</button>
                </div>

            </form>

        </div>
    </div>
</body>

</html>

<?php

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $flname = trim($_POST['flname']);
    $uname = trim($_POST['uname']);
    $email = trim($_POST['email']);
    $pwd = trim($_POST['pwd']);

    function headTo($err)
    {
        header('location:index.php?err=' . $err);
    }

    if (!ctype_alpha($flname)) {
        headTo('FullName should be only alphabets');
    }

    if(!ctype_alnum($uname)){
        headTo('check username');
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        headTo('check email');
    }
    
        
}
