<?php
require_once('../settings/settings.php');
require_once('../classes/c_project.php');

$project = new Project();

// Create a new project
try {
    $response = $project->edit_proj_materials($connection, $_POST['project'], $_POST['pmid'], $_POST['projcost'], $_POST['qty'], $_POST['paid']);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

echo $_POST['project'];