<?php
//detail.php
require_once('../settings.php');

session_start();
/*
// Simple query
$query=$connection->prepare('SELECT * FROM items WHERE ID=?');
$query->execute([$_GET['id']]);
$item=$query->fetch();

echo $item['name'].'<br />';
echo $item['user_ID'].'<hr />';


$query=$connection->prepare('SELECT * FROM users WHERE ID=?');
$query->execute([$item['user_ID']]);
$user=$query->fetch();
echo $user['firstname'].' '.$user['lastname'];
*/

$query=$connection->prepare('
	SELECT items.ID,items.user_ID,items.name,categories.name AS category_name,users.firstname,users.lastname FROM items 
	JOIN users ON items.user_ID=users.ID
	JOIN categories ON items.category_ID=categories.ID
	WHERE items.ID=?');
$query->execute([$_GET['id']]);
$result=$query->fetch();
if($_SESSION['ID']!=$result['user_ID']) die('You are not authorized to view this item');
echo $result['name'].'<br />';
echo $result['category_name'].'<br />';
echo $result['firstname'].' '.$result['lastname'];

