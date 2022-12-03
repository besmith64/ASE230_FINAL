<?php
// sign out
require_once('../settings/settings.php');

if (count($_SESSION) > 0 && is_numeric($_SESSION['ID'])) {
    require_once('auth.php');
    signout();
}
header('location: signin.php');
die();