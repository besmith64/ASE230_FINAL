<?php
//delete.php
require_once('../settings.php');

// Simple query
$query=$connection->prepare('DELETE FROM categories WHERE ID=?');
$query->execute([$_GET['id']]); 
echo 'The category has been deleted.';
