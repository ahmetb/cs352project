<?php
include 'inc.php';

include 'view_top.php';

$seat = intval($_POST['seat']);
$amount = intval($_POST['amount']);
$flight_id = intval($_POST['flight_id']);
$ccn = trim($_POST['ccn']);
$cvc = trim($_POST['cvc']);
$name = trim($_POST['name']);

$customer_id = $_SESSION['id'];

// Won't use this. 
if(!$seat || !$customer_id || !$amount || !$flight_id){
	$error = 'Please go back and fill in all the fields to proceeed.';
} else{	
	mysql_query("BEGIN;", $mysql) or die(mysql_error());
	$success = mysql_query("INSERT INTO payment (amount, date) VALUES ($amount, NOW())", $mysql) or die(mysql_error());
	if (!$success){
			mysql_query("ROLLBACK;", $mysql) or die(mysql_error());
			die("Error occurred. Please try again later");
	}
	$tx_id = mysql_insert_id();
	$success = mysql_query("INSERT INTO booking (customer_id, flight_id, seat, booking_date, payment) VALUES ($customer_id, $flight_id, $seat, NOW(), $tx_id);");
	if (!$success){
			mysql_query("ROLLBACK;", $mysql) or die(mysql_error());
			die("Error occurred. Please try again later");
	} else {
			mysql_query("COMMIT;", $mysql) or die(mysql_error());
			include 'view_checkout.php';
	}
}

include 'view_bottom.php';
?>