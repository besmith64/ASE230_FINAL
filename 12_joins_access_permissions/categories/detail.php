<?php
//detail.php
require_once('../settings.php');

// Simple query
$query=$connection->prepare('SELECT * FROM categories WHERE ID=?');
$query->execute([$_GET['id']]);
$category=$query->fetch();

echo $category['name'];