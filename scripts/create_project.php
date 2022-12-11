<?php
require_once('settings/settings.php');
require_once('classes/c_project.php');

$project = new Project();

// Create a new project
try {
    $values = array(
        $_POST['inputProject'],
        $_POST['projDesc'],
        $_SESSION['firstname'] . ' ' . $_SESSION['lastname'],
        $_POST['inputContractor'],
        $_POST['inputAddress'],
        $_POST['inputCity'],
        $_POST['state'],
        $_POST['inputZip']
    );
    $project->create_project($connection, $values);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

echo "Project Created";