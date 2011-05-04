<?php
include 'inc.php';

$flight_id = intval($_POST['flight_id']);
$seat = intval($_POST['seat']);
$luggage = $_POST['luggage'];

$lugs = array();

if ($_POST) if(!$flight_id || !$seat){
	$error = 'Please fill in all fields';
} else{
	$bk = mysql_query("SELECT id,customer_id FROM booking where flight_id=$flight_id and seat=$seat", $mysql) or die(mysql_error());
	if (mysql_num_rows($bk) == 0){
		$error = 'Could not find appropriate booking on this flight. Please check again.';
	} else {
		$booking_id = intval(mysql_result($bk, 0, 'id'));
		$customer_id = intval(mysql_result($bk, 0, 'customer_id'));
		
		if(!$booking_id){
			$error = 'Invalid booking id found. Database inconsistency.';
		} else {
			mysql_query("BEGIN", $mysql) or die(mysql_error());
			
			if (is_array($luggage))
			foreach($luggage as $lug){
				$lug = intval($lug);
				if ($lug > 0){
					$r = mysql_query("INSERT INTO luggage (weight) VALUES ($lug)", $mysql) or die(mysql_error());
					if(!$r){
						mysql_query("ROLLBACK", $mysql) or die(mysql_error());
						$error = 'Error occurred during luggage insertion.';
					}
					$id = mysql_insert_id();
					$r = mysql_query("INSERT INTO booking_luggage (booking_id, luggage_id) VALUES ($booking_id,$id)", $mysql) or die(mysql_error());
					if(!$r){
						mysql_query("ROLLBACK", $mysql) or die(mysql_error());
						$error = 'Error occurred during booking luggage insertion.';
					}
					$lugs[] = $lug;
				}
			}
			
			if(!$error) mysql_query("COMMIT", $mysql) or die(mysql_error());
			$sucess = true;
			
			$cs = mysql_query("SELECT id,name FROM customer where id=$customer_id", $mysql) or die(mysql_error());
			$customer_name = mysql_result($cs, 0, 'name');
			
			$fd = mysql_query("SELECT r.route_name as name, f.departure_date as date FROM flight f, route_listing r where f.route=r.id", $mysql) or die(mysql_error());
			$flight_route = mysql_result($fd, 0, 'name');
			$flight_date = mysql_result($fd, 0, 'date');
		}
		
	}
}

if ($error) { include 'view_top.php'; include 'view_dashboard_sales.php';}
else if($sucess) { include 'view_top.php'; include 'view_itinerary.php';}
else {header('location: index.php'); die();}

include 'view_bottom.php';