<?php
require_once('../settings/settings.php');
// Call Project Class to delete
require_once('../classes/c_project.php');

//Delete user project
Project::delete_proj_material($connection, $_GET['ID'], $_GET['PMID']);

echo 1;