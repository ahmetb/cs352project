<?php
include 'inc.php';
include 'view_top.php';

$action = $_GET['action'];
if($action=='form'){
	$flight_id = intval($_POST['flight_id']);
	
	if(!$flight_id){
		$error = 'Error occurred during reservation. Please try again.';
		include 'view_dashboard_customer.php';
	} else {
		$sql = "SELECT f.id,f.departure_date,  dep.name as departure, dep.code as dcode, arr.name as arrival, arr.code as acode, f.flight_number, f.fare, p.id plane_id, p.name as plane_name, p.capacity as plane_capacity, p.model as plane_model, r.duration FROM flight f, route r, airport dep, airport arr, plane p WHERE f.id=$flight_id AND f.route=r.id AND r.departure=dep.id AND r.destination=arr.id  AND p.id=f.plane AND f.departure_date>NOW() LIMIT 1;";	
		
		$results_query = mysql_query($sql, $mysql) or die(mysql_error());
		
		if(mysql_num_rows($results_query)==0){
			$error = 'Flight not found on the system. Please try again.';
			include 'view_dashboard_customer.php';
		} else {
			$result = null;
			while ($row = mysql_fetch_assoc($results_query)){
				$result = $row;break;
			}
			
			$seats = array();
			$seats_sql = "SELECT seat FROM booking WHERE flight_id=$flight_id";
			$results_query = mysql_query($seats_sql, $mysql) or die(mysql_error());
			while ($row = mysql_fetch_assoc($results_query)){
				$seats[] = intval($row['seat']);
			}
			include 'view_booking.php';
		}
	}
}



include 'view_bottom.php';
?>