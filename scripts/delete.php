<?php
// Call Project Class to delete
require_once('classes/c_project.php');

//Delete user project
if (isset($_GET['ID'])) {
    try {
        $project->delete_project($connection, $_GET['ID']);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}