<?php
require_once('../settings/settings.php');
require_once('../classes/c_user.php');

$user = new User();

// Create a new project
try {
    $response = $user->edit_user($connection, $_POST['UID'], $_POST['GID'], $_POST['fname'], $_POST['lname']);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

echo 'Success!';