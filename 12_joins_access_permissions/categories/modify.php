<?php
//modify.php
require_once('../settings.php');

session_start();
if($_SESSION['role']==0 || $_SESSION['role']==1){
	die('You are not authorized to modify a category');
	
}
if(count($_POST)>0){
	$query=$connection->prepare('UPDATE categories SET name=? WHERE ID=?');
	$query->execute([$_POST['name'],$_GET['id']]);
}
$query=$connection->prepare('SELECT * FROM categories WHERE ID=?');
$query->execute([$_GET['id']]);
$category=$query->fetch();

?>

<form method="POST">
Category name: <input name="name" type="text" value="<?= $category['name'] ?>" />
<button type="submit">Submit</button>
</form>