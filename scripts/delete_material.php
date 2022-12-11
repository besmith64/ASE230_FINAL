<?php
require_once('../settings/settings.php');
// Call Material Class to delete
require_once('../classes/c_materials.php');

//Delete admin material
Materials::delete_material($connection, $_GET['ID']);

echo 1;