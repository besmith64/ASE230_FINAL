<?php
//only need to start session in the settings.php file
// session_start();
require_once('../settings.php');
// sign in
if (count($_SESSION) > 0 && is_numeric($_SESSION['ID'])) {
    header('location: ../index.php');
    die();
}
// print_r(($_POST));

if (count($_POST) > 0) {
    require_once('../libs/auth.php');
    if (signin($connection, $_POST['email'], $_POST['password'])) {
        header('location: ../index.php');
        die();
    } else echo 'Signin failed';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <input name="email" type="email" ?>
        <input name="password" type="password" ?>
        <button type="submit">Submit</button>
    </form>
</body>

</html>