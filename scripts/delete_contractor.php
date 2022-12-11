<?php
require_once('../settings/settings.php');
// Call Contractor Class to delete
require_once('../classes/c_contractors.php');

//Delete admin contractor
Contractor::delete_contractor($connection, $_GET['ID']);

echo 1;