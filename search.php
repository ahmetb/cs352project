<?php
require_once 'inc.php';
require_once 'view_top.php';

$action = $_GET['act'];

$flights = array();
$airports = array();
$search_str = '';

if($action == 'upcoming'){
	$search_str = 'Listing soonest upcoming flights of the company.';
	
	$sql = "SELECT f.id,f.departure_date, r.duration, dep.name as departure, dep.code as dcode, arr.name as arrival, arr.code as acode, f.flight_number, f.fare FROM flight f, route r, airport dep, airport arr where f.route=r.id AND r.departure=dep.id AND r.destination=arr.id AND f.departure_date>NOW() ORDER BY f.departure_date ASC LIMIT 30;";	
	
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
	
	$search_str = 'Showing flights on the specified route beginning from '.date("M d, Y.", strtotime($date_str));
	
	$sql = "SELECT f.id,f.departure_date, r.duration, dep.name as departure, dep.code as dcode, arr.name as arrival, arr.code as acode, f.flight_number, f.fare FROM flight f, route r, airport dep, airport arr where f.route=r.id AND r.departure=dep.id AND r.destination=arr.id AND f.departure_date>NOW() AND DATE(f.departure_date)>=DATE('$date_str') and r.departure='$departure' and r.destination='$destination' ORDER BY f.departure_date ASC;";
}

if(!$error){
	$results_query = mysql_query($sql, $mysql) or die(mysql_error());
	while ($row = mysql_fetch_assoc($results_query)) {
		$flights[] = $row;
		$airports[$row['acode']] = $row['arrival'];
		$airports[$row['dcode']] = $row['departure'];
	}
	include 'view_results.php';
}
include_once 'view_bottom.php';
