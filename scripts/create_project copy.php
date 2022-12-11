<?php
require_once('../settings/settings.php');
require_once('../classes/c_project.php');

$project = new Project();

// Create a new project
try {
    $values = array(
        $_POST['project'],
        $_POST['description'],
        $_SESSION['ID'],
        $_POST['contractor'],
        $_POST['address'],
        $_POST['city'],
        $_POST['state'],
        $_POST['zipcode']
    );
    $response = $project->create_project($connection, $values);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

echo $response['Project_ID'];