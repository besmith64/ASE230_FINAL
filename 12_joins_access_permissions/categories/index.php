<?php
/* SIMULATING AUTH */

session_start();
$_SESSION['role']=2;
$_SESSION['ID']=2;




//index.php
require_once('../settings.php');

require_once('../theme/header.php');
// Simple query
$result=$connection->query('
	SELECT categories.ID,categories.name,COUNT(items.ID) AS items_count 
	FROM categories
	LEFT JOIN items ON items.category_ID=categories.ID
	GROUP BY categories.ID');
?>
<div class="container">
<h1>Categories</h1>
<?php
echo '<a href="create.php">Create category</a>';
echo '<table>';
while($category=$result->fetch()){
	echo '<tr>
		<td>'.$category['ID'].'</td>
		<td><a href="detail.php?id='.$category['ID'].'">'.$category['name'].'</a></td>
		<td>'.$category['items_count'].'</td>
		<td><a href="delete.php?id='.$category['ID'].'">DELETE CATEGORY</a></td>
	</tr>';
}
echo '</table>';
?>
</div>
<?php
require_once('../theme/footer.php');