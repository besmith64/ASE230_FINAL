<?php
// sign out
//only need to start session in the settings.php file
// session_start();
require_once('../settings.php');

if (count($_SESSION) > 0 && is_numeric($_SESSION['ID'])) {
    require_once('../libs/auth.php');
    signout();
}
header('location: ../signin.php');
die();