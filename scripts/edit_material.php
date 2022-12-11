<?php
require_once('../settings/settings.php');
require_once('../classes/c_materials.php');

$materials = new Materials();

try {
    $response = $materials->edit_materials($connection, $_POST['MID'], $_POST['material'], $_POST['desc'], $_POST['cost']);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

echo 'Success!';