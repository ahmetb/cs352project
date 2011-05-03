<?php
require_once 'inc.php';

require_once 'view_top.php';

$action = $_GET['action'];
if ($action == 'new'){
	$number = trim($_POST['number']);
	$cpt = trim($_POST['cpt']);
	$asst = trim($_POST['asst']);
	$host = trim($_POST['host']);
	$fare = intval(trim($_POST['fare']));
	$route = intval(trim($_POST['route']));
	$plane = intval(trim($_POST['plane']));
	$day = intval($_POST['day']);
	$month = intval($_POST['month']);
	$year = intval($_POST['year']);
	$hour = intval($_POST['hour']);
	$minute = intval($_POST['minute']);
	
	if(!$number || $fare<=0 || !$plane || !$route || !$asst || !$cpt || !$host || !$day || !$month || !$year){
		$error = 'Fill in all the fields.';
	} else if ($cpt == $asst){
		$error = 'Captain and asst. pilots cannot be the same.';
	}else {
		$count_query = mysql_query("SELECT COUNT(*) FROM flight WHERE flight_number='$number'", $mysql) or die(mysql_error());
		$count = intval(mysql_result($count_query,0,0));
		
		if($count > 0){
			$error = 'A flight with this flight number has already been arranged.';
		} else {
			$date_str = "$year-$month-$day $hour:$minute:00";

			
			mysql_query("INSERT INTO flight (flight_number, departure_date, fare, route, plane) VALUES ('$number', '$date_str', $fare, $route, $plane)", $mysql) or die(mysql_error());
			$flight_id = mysql_result(mysql_query("SELECT last_insert_id() as t", $mysql) or die(mysql_error()), 0, 't');
			var_dump($flight_id);
			if (!$flight_id) {
				$error = 'Error occurred during insertion. Try again later.';
			}
			else {
				mysql_query("BEGIN", $mysql) or die(mysql_error());
				mysql_query("INSERT INTO flight_crew (flight_id, staff_id, role) VALUES ($flight_id, $cpt, 'CPT')", $mysql) or die(mysql_error());
				mysql_query("INSERT INTO flight_crew (flight_id, staff_id, role) VALUES ($flight_id, $asst, 'ASST')", $mysql) or die(mysql_error());
				mysql_query("INSERT INTO flight_crew (flight_id, staff_id, role) VALUES ($flight_id, $host, 'HOST')", $mysql) or die(mysql_error());
				mysql_query("COMMIT", $mysql) or die(mysql_error());
				$success = 'Flight is arranged!';
			}
			

		}
	}
} else if ($action == 'edit'){
		$edit_id = intval($_POST['id']);
		$name = trim($_POST['name']);
		$salary = intval(trim($_POST['salary']));
		$type = trim($_POST['type']);
		$password = md5(trim($_POST['password']));
		$day = intval($_POST['day']);
		$month = intval($_POST['month']);
		$year = intval($_POST['year']);

		if(!$name || $salary<=0 || !$type || !$day || !$month || !$year){
			$error = 'Fill in all the fields properly.';
		} else {
			$count_query = mysql_query("SELECT COUNT(*) FROM ground_staff g, flight_staff f where (g.name='$name' AND g.id != $edit_id) OR  (f.name='$name' AND f.id!=$edit_id)", $mysql) or die(mysql_error());
			$count = intval(mysql_result($count_query,0,0));

			if($count > 0){
				$error = 'An employee with this name already exists.';
			} else {
				$date_str = "$year-$month-$day 00:00:00";

				if ($type=='SALES' || $type=='EXEC'){
					mysql_query("UPDATE ground_staff SET name='$name',salary=$salary, date_joined='$date_str' WHERE id=$edit_id", $mysql) or die(mysql_error());
				}else{
					mysql_query("UPDATE flight_staff SET name='$name',salary=$salary, date_joined='$date_str' WHERE id=$edit_id", $mysql) or die(mysql_error());
				}
				$success = 'Employee '.$name.' has been updated.';
			}
		}
	}

if ($action == 'delete'){
	$delete_id = intval($_GET['id']);
	$type = trim($_GET['type']);
	if ($type=='SALES' || $type=='EXEC'){
		$table = 'ground_staff';
	} else {
		$table = 'flight_staff';
	}
	mysql_query("DELETE FROM $table WHERE id=$delete_id", $mysql) or die(mysql_error());
	$success = 'Employee has been fired.';
}


// Query routes.
$routes = array();
$sql = "SELECT * FROM route_listing";
$results_query = mysql_query($sql, $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) {
	$routes[] = $row;
}

// Query pilots 
$pilots = array();
$sql = "SELECT * FROM flight_staff where type='PILOT'";
$results_query = mysql_query($sql, $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) $pilots[] = $row;

// Query hostesses 
$hostess = array();
$sql = "SELECT * FROM flight_staff where type='HOSTESS'";
$results_query = mysql_query($sql, $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) $hostess[] = $row;


// Query airplanes 
$planes = array();
$sql = "SELECT * FROM plane";
$results_query = mysql_query($sql, $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) $planes[] = $row;


require 'view_flight.php';

require_once 'view_bottom.php';