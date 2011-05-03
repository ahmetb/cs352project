<?php
require_once 'inc.php';

$action = $_GET['action'];
if ($action == 'new'){
	$name = trim($_POST['name']);
	$model = trim($_POST['model']);
	$capacity = intval($_POST['capacity']);

	if(!$name || !$model || $capacity<=0){
		$error = 'Please fill in all the fields.';
	} else {
	
		$count_query = mysql_query("SELECT COUNT(*) FROM plane where name='$name'", $mysql) or die(mysql_error());
		$count = intval(mysql_result($count_query,0,0));
		if($count > 0){
			$error = 'Airplane name already exists.';
		} else {
			mysql_query("INSERT INTO plane (name, model, capacity) VALUES ('$name', '$model', $capacity)", $mysql) or die(mysql_error());
			$success = 'Airplane has been inserted.';
		}
	}
} 


if ($action == 'edit'){
	$edit_id = intval($_POST['id']);
	$name = $_POST['name'];
	$model = $_POST['model'];
	$capacity = (intval($_POST['capacity']));
	
	if($edit_id){
		$count_query = mysql_query("SELECT COUNT(*) FROM plane where name='$name' AND id != $edit_id", $mysql) or die(mysql_error());
		$count = intval(mysql_result($count_query,0,0));
		if($count > 0){
			$error = 'Airplane name already exists.';
		} else {
			mysql_query("UPDATE plane SET name='$name', model='$model', capacity=$capacity WHERE id=$edit_id ", $mysql) or die(mysql_error());
			$success = 'Airplane has been updated.';
		}		

	} else {
		if(!$add_name || !$model || !$capacity || $capacity<0){
			$error = 'Please fill in all the fields.';
		}else{
			$error = 'Error occurred. Please try again.';
		}
	}
}

if ($action == 'delete'){
	$delete_id = intval($_GET['id']);
	mysql_query("DELETE FROM plane WHERE id=$delete_id", $mysql) or die(mysql_error());
	$success = 'Airplane has been deleted.';
}

// Query airplanes.
$airplanes = Array();
$airplanes_result = mysql_query('SELECT * FROM plane', $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($airplanes_result)) {
    $result['id'] = $row['id'];
	$result['name'] = $row['name'];
	$result['model'] = $row['model'];
	$result['capacity'] = $row['capacity'];
	$airplanes[] = $result;
}

require_once 'view_top.php';
require_once 'view_airplane.php';
require_once 'view_bottom.php';
?>