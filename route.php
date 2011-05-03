<?php
require_once 'inc.php';

$action = $_GET['action'];
if ($action == 'new'){
	$departure = intval($_POST['departure']);
	$destination = intval($_POST['destination']);
	$duration = intval($_POST['duration']);
	
	if(!$departure || !$destination || $duration<=0){
		$error = 'Please fill in all the fields.';
	} else if($departure==$destination){
		$error = 'Departure and arrival must be different.';
	}
	else {

		$count_query = mysql_query("SELECT COUNT(*) FROM route where departure=$departure and destination=$destination", $mysql) or die(mysql_error());		
		$count = intval(mysql_result($count_query,0,0));
		if($count > 0){
			$error = 'Route with given cities already exists.';
		} else {
			mysql_query("INSERT INTO route (departure, destination, duration) VALUES ($departure, $destination, $duration)", $mysql) or die(mysql_error());
			$success = 'Route has been created.';
		}
	}
} 


if ($action == 'edit'){
	$edit_id = intval($_POST['id']);
	$departure = intval($_POST['departure']);
	$destination = intval($_POST['destination']);
	$duration = intval($_POST['duration']);
	
	if($edit_id){
		$count_query = mysql_query("SELECT COUNT(*) FROM route where departure=$departure and destination=$destination and id!=$edit_id", $mysql) or die(mysql_error());
		
		$count = intval(mysql_result($count_query,0,0));
		if($count > 0){
			$error = 'A route with given endpoints already exists.';
		} else {
			mysql_query("UPDATE route SET departure=$departure, destination=$destination, duration=$duration WHERE id=$edit_id ", $mysql) or die(mysql_error());
			$success = 'Route has been updated.';
		}		

	} else {
		if(!$departure || !$destination || $duration<=0){
			$error = 'Please fill in all the fields.';
		}else{
			$error = 'Error occurred. Please try again. (no_id)';
		}
	}
}

if ($action == 'delete'){
	$delete_id = intval($_GET['id']);
	mysql_query("DELETE FROM route WHERE id=$delete_id", $mysql) or die(mysql_error());
	$success = 'Route has been deleted.';
}


// Query airports.
$airports = array();
$results = mysql_query('SELECT * FROM airport ORDER BY name', $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results)) {
	$res = null;
	$airports[] = $row;
}

// Query routes.
$results = array();
$results_query = mysql_query('SELECT * FROM route_listing', $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) {
	$results[] = $row;
}

require_once 'view_top.php';
require_once 'view_route.php';
require_once 'view_bottom.php';
?>