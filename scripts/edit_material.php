<?php
require_once('../settings/settings.php');
require_once('../classes/c_materials.php');

$materials = new Materials();

// Create a new project
try {
    $response = $contractors->edit_materials($connection, $_POST['MID'], $_POST['material'], $_POST['desc'], $_POST['cost']);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

echo 'Success!';