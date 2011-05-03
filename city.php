<?php
require_once 'inc.php';

$action = $_GET['action'];
if ($action == 'new'){
	$add_name = trim($_POST['name']);
	
	if(!$add_name){
		$error = 'Enter a name';
	} else {
	
		$count_query = mysql_query("SELECT COUNT(*) FROM city where name='$add_name'", $mysql) or die(mysql_error());
		$count = intval(mysql_result($count_query,0,0));
		if($count > 0){
			$error = 'City already exists.';
		} else {
			mysql_query("INSERT INTO city (name) VALUES ('$add_name')", $mysql) or die(mysql_error());
			$success = 'City has been inserted.';
		}
	}
} 

if ($action == 'edit'){
	$edit_name = $_POST['name'];
	$edit_id = intval($_POST['id']);
	
	if($edit_id){
		$count_query = mysql_query("SELECT COUNT(*) FROM city where name='$edit_name' AND id != $edit_id", $mysql) or die(mysql_error());
		$count = intval(mysql_result($count_query,0,0));
		if($count > 0){
			$error = 'City already exists.';
		} else {
			mysql_query("UPDATE city SET name='$edit_name' WHERE id=$edit_id ", $mysql) or die(mysql_error());
			$success = 'City has been updated.';
		}		

	} else {
		$error = 'Error occurred. Please try again.';
	}
}

if ($action == 'delete'){
	$delete_id = intval($_GET['id']);
	mysql_query("DELETE FROM city WHERE id=$delete_id", $mysql) or die(mysql_error());
	$success = 'City has been deleted.';
}

// Query cities.
$cities = Array();
$cities_result = mysql_query('SELECT * FROM city ORDER BY name', $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($cities_result)) {
    $city['id'] = $row['id'];
	$city['name'] = $row['name'];
	$cities[] = $city;
}
require_once 'view_top.php';
require_once 'view_city.php';
require_once 'view_bottom.php';
?>