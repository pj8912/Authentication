<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <div class="container">
        <div class="bg-white mt-5 card card-body col-md-6 m-auto login-form">

			<p align="center" class="h1 p-1">Authentication</p><br>

                        <h4 class="mt-4">SignUp</h4>
            <form action="signup_process.php" method="post">

                <div class="mb-2">
                    <input class="form-control" autocomplete="off"  type="text" name="flname" placeholder="FullName*" required>
                </div>

                <div class="mb-2">
                    <input class="form-control" autocomplete="off"  id="email" type="email" name="email" placeholder="Email*" required>
                </div>


                <div class="mb-2">
                    <input class="form-control" autocomplete="off"  type="password" name="pwd" placeholder="Password*" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" name="sbtn" class="btn btn-success" align="center">

                        Sign Up
                    </button>
                </div>

                <p class="text-center mt-3">Already have an account? <a href="../index.php">Log in</a></p>


            </form>
        </div>

    </div>

</body>

</html>
