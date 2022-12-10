<?php
// sign up
require_once('../settings/settings.php');

if (count($_SESSION) > 0 && is_numeric($_SESSION['ID'])) {
    header('location: ../index.php');
    die();
}

$error = '';

if (count($_POST) > 0) {
    require_once('auth.php');
    $var = $_POST['isadmin'];
    if (isset($var)) {
        if (!signup($connection, $var, $_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname'])) $error = '<div class="alert alert-danger" role="alert">Unsuccessful</div>';
        else $error = '<div class="alert alert-success" role="alert" >Success! <a href="signin.php"><i class="fa-solid fa-right-to-bracket"></i></i> Sign In</a></div>';
    } else {
        $var = 2;
        if (!signup($connection, $var, $_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname'])) $error = '<div class="alert alert-danger" role="alert">Unsuccessful</div>';
        else $error = '<div class="alert alert-success" role="alert" >Success! <a href="signin.php"><i class="fa-solid fa-right-to-bracket"></i></i> Sign In</a></div>';
    }
}
?>

<!DOCTYPE html>
<html style="font-size: 16px" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon" href="../settings/favicon.ico">
    <link rel="stylesheet" href="css/nicepage.css" media="screen" />
    <link rel="stylesheet" href="css/login.css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/057979aec3.js" crossorigin="anonymous"></script>
    <script class="u-script" type="text/javascript" src="js/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="js/nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.19.3, nicepage.com" />
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i" />

    <meta name="theme-color" content="#478ac9" />
    <meta property="og:title" content="Sign Up" />
    <meta property="og:type" content="website" />
</head>

<body class="u-body u-xl-mode" data-lang="en"
    style="background-image: url('../settings/background.jpg'); background-size: cover;">
    <header>
        <nav class="navbar bg-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php"><i class="fa-solid fa-wrench"></i> Mr. Fixit!</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            <i class="fa-solid fa-wrench"></i> Mr. Fixit!
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="signin.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="signup.php">Signup</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="container shadow" style="padding-top: 50px; padding-bottom: 50px; background-color: lightgrey;">
        <div id="liveAlertPlaceholder"><?= $error ?></div>
        <h2 class="text-center" style="padding-top: 10px;">Create an Account</h2>
        <div class="u-form u-login-control u-block-4b94-24">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="firstname">
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="isadmin" value="1" class="form-check-input">
                    <label class="form-check-label">Is Admin?</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>