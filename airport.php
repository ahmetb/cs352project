<?php
require_once 'inc.php';

$action = $_GET['action'];
if ($action == 'new'){
	$name = trim($_POST['name']);
	$code = trim($_POST['code']);
	$city = intval($_POST['city']);
	
	if(!$name || !$code || !$city){
		$error = 'Fill in all the fields.';
	} else {
		$count_query = mysql_query("SELECT COUNT(*) FROM airport where name='$name' OR code='$code'", $mysql) or die(mysql_error());
		$count = intval(mysql_result($count_query,0,0));
	
		if($count > 0){
			$error = 'Airport already exists.';
		} else {
			mysql_query("INSERT INTO airport (name,code,city) VALUES ('$name', '$code', $city)", $mysql) or die(mysql_error());
			$success = 'Airport has been inserted.';
		}
	}
} 

if ($action == 'edit'){
	$name = $_POST['name'];
	$code = $_POST['code'];
	$city_id = intval($_POST['city']);
	$edit_id = intval($_POST['id']);
	
	if($edit_id && $city_id){

		$count_query = mysql_query("SELECT COUNT(*) FROM airport where (name='$name' OR code='$code') AND id <> $edit_id", $mysql) or die(mysql_error());
		$count = intval(mysql_result($count_query,0,0));
	
		if($count > 0){
			$error = 'Airport already exists.';
		} else {
			mysql_query("UPDATE airport SET name='$name', code='$code', city=$city_id WHERE id=$edit_id", $mysql) or die(mysql_error());
			$success = 'Airport has been updated.';
		}		
	} else {
		$error = 'Error occurred. Please try again.';
	}
}

if ($action == 'delete'){
	$delete_id = intval($_GET['id']);
	mysql_query("DELETE FROM airport WHERE id=$delete_id", $mysql) or die(mysql_error());
	$success = 'Airport has been deleted.';
}

// Query cities.
$cities = array();
$cities_result = mysql_query('SELECT * FROM city ORDER BY name', $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($cities_result)) {
	$city = null;
    $city['id'] = $row['id'];
	$city['name'] = $row['name'];
	$cities[] = $city;
}


// Query airports.
$results = array();
$airports_result = mysql_query("SELECT a.id, a.name,a.code,c.name as city, a.city as city_id FROM airport a, city c WHERE a.city=c.id ORDER BY a.code", $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($airports_result)) {
	$result = null;
    $result['id'] = $row['id'];
	$result['name'] = $row['name'];
	$result['code'] = $row['code'];
	$result['city'] = $row['city'];
	$result['city_id'] = $row['city_id'];
	$results[] = $result;
}

require_once 'view_top.php';
require_once 'view_airport.php';
require_once 'view_bottom.php';
?>