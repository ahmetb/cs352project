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

			mysql_query("BEGIN", $mysql) or die(mysql_error());
			mysql_query("INSERT INTO flight (flight_number, departure_date, fare, route, plane) VALUES ('$number', '$date_str', $fare, $route, $plane)", $mysql) or die(mysql_error());
			$flight_id = mysql_insert_id($mysql);
			if (!$flight_id) {
				mysql_query("ROLLBACK", $mysql) or die(mysql_error());
				$error = 'Error occurred during insertion. Try again later.';
			}
			else {
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
	$number = trim($_POST['number']);
	$cpt = intval(trim($_POST['cpt']));
	$asst = intval(trim($_POST['asst']));
	$host = intval(trim($_POST['host']));
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
		$count_query = mysql_query("SELECT COUNT(*) FROM flight WHERE flight_number='$number' and id<>$edit_id", $mysql) or die(mysql_error());
		$count = intval(mysql_result($count_query,0,0));

		if($count > 0){
			$error = 'A flight with this flight number has already been arranged.';
		} else {
			$date_str = "$year-$month-$day $hour:$minute:00";

			mysql_query("BEGIN", $mysql) or die(mysql_error());
			mysql_query("DELETE FROM flight_crew WHERE flight_id=$edit_id", $mysql) or die(mysql_error());
			mysql_query("UPDATE flight SET flight_number='$number', departure_date='$date_str', fare=$fare, route=$route, plane=$plane WHERE id=$edit_id", $mysql) or die(mysql_error());
			mysql_query("INSERT INTO flight_crew (flight_id, staff_id, role) VALUES ($edit_id, $cpt, 'CPT')", $mysql) or die(mysql_error());
			mysql_query("INSERT INTO flight_crew (flight_id, staff_id, role) VALUES ($edit_id, $asst, 'ASST')", $mysql) or die(mysql_error());
			mysql_query("INSERT INTO flight_crew (flight_id, staff_id, role) VALUES ($edit_id, $host, 'HOST')", $mysql) or die(mysql_error());
			mysql_query("COMMIT", $mysql) or die(mysql_error());
			
			$success = 'Flight is modified!';

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



// Query flights 
$flights = array();
$sql = "SELECT f.id, f.flight_number, f.departure_date,f.fare, f.route, f.plane, r.route_name, p.name as plane_name, a.staff_id as asst, c.staff_id as cpt, h.staff_id as host FROM flight f, route_listing r, plane p, flight_crew c, flight_crew a, flight_crew h WHERE r.id=f.route AND p.id=f.plane AND a.role='ASST' and a.flight_id=f.id AND c.role='CPT' and c.flight_id=f.id AND h.role='HOST' and h.flight_id=f.id ORDER BY departure_date DESC";

$results_query = mysql_query($sql, $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) $flights[] = $row;

require 'view_flight.php';

require_once 'view_bottom.php';