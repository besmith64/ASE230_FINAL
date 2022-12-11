<?php
require_once('../settings/settings.php');
// Call User Class to delete
require_once('../classes/c_user.php');

//Delete user
User::delete_user($connection, $_GET['ID']);

echo 1;