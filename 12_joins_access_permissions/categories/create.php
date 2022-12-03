<?php
session_start();

if($_SESSION['role']==0){
	die('You are not authorized to create a category');
	
}
//create.php
require_once('../settings.php');
	
require_once('../theme/header.php');
if(count($_POST)>0){
	$query=$connection->prepare('INSERT INTO categories (name) VALUES (?)');
	$query->execute([$_POST['name']]);
}

?>

<form method="POST">
Category name: <input name="name" type="text" />
<button type="submit">Submit</button>
</form>
<?php

require_once('../theme/footer.php');