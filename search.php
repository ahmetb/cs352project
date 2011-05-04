<?php
require_once 'inc.php';
require_once 'view_top.php';

$action = $_GET['act'];

$flights = array();
$airports = array();

if($action == 'upcoming'){
	$sql = "SELECT f.departure_date, r.duration, dep.name as departure, dep.code as dcode, arr.name as arrival, arr.code as acode, f.flight_number, f.fare FROM flight f, route r, airport dep, airport arr where f.route=r.id AND r.departure=dep.id AND r.destination=arr.id AND f.departure_date>NOW() ORDER BY f.departure_date ASC;";	
} else {
	$departure = intval(trim($_POST['departure']));
	$destination = intval(trim($_POST['destination']));
	$day = intval($_POST['day']);
	$month = intval($_POST['month']);
	$year = intval($_POST['year']);
	
	$date_str = $year.'-'.$month.'-'.$day;
	
	if($departure == $destination){
		$error = 'Departure and destination should be different.';
		include 'view_dashboard_customer.php';	
	}
	
	$sql = "SELECT f.departure_date, r.duration, dep.name as departure, dep.code as dcode, arr.name as arrival, arr.code as acode, f.flight_number, f.fare FROM flight f, route r, airport dep, airport arr where f.route=r.id AND r.departure=dep.id AND r.destination=arr.id AND f.departure_date>NOW() AND DATE(f.departure_date)>=DATE('$date_str') and r.departure='$departure' and r.destination='$destination' ORDER BY f.departure_date ASC;";
}

if(!$error){
	echo($sql);

	$results_query = mysql_query($sql, $mysql) or die(mysql_error());
	while ($row = mysql_fetch_assoc($results_query)) {
		$flights[] = $row;
		$airports[$row['acode']] = $row['arrival'];
		$airports[$row['dcode']] = $row['departure'];
	}
	include 'view_results.php';
}
include_once 'view_bottom.php';
