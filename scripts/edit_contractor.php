<?php
require_once('../settings/settings.php');
require_once('../classes/c_contractors.php');

$contractors = new Contractor();

// Create a new project
try {
    $response = $contractors->edit_contractor($connection, $_POST['CID'], $_POST['name'], $_POST['desc']);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

echo 'Success!';