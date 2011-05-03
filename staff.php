<?php
require_once 'inc.php';

require_once 'view_top.php';

$action = $_GET['action'];
if ($action == 'new'){
	$name = trim($_POST['name']);
	$salary = intval(trim($_POST['salary']));
	$type = trim($_POST['type']);
	$password = md5(trim($_POST['password']));
	$day = intval($_POST['day']);
	$month = intval($_POST['month']);
	$year = intval($_POST['year']);

	if(!$name || $salary<=0 || !$type || !$day || !$month || !$year){
		$error = 'Fill in all the fields.';
	} else {
		$count_query = mysql_query("SELECT COUNT(*) FROM ground_staff g, flight_staff f where g.name='$name' or f.name='$name'", $mysql) or die(mysql_error());
		$count = intval(mysql_result($count_query,0,0));
		
		if($count > 0){
			$error = 'An employee with this name already exists.';
		} else {
			$date_str = "$year-$month-$day 00:00:00";
			
			if ($type=='SALES' || $type=='EXEC'){
				mysql_query("INSERT INTO ground_staff (name,salary,password,date_joined,type) VALUES ('$name', $salary, '$password', '$date_str', '$type')", $mysql) or die(mysql_error());
			}else{
				mysql_query("INSERT INTO flight_staff (name,salary,date_joined, type) VALUES ('$name', $salary, '$date_str', '$type')", $mysql) or die(mysql_error());
			}
			$success = 'Employee has been added to the system.';
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
$results = array();
$sql = "(SELECT s.id, s.name, s.salary, s.date_joined, s.type FROM ground_staff s) UNION (SELECT s.id, s.name, s.salary, s.date_joined, s.type FROM flight_staff s);";

$results_query = mysql_query($sql, $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) {
	$results[] = $row;
}


require 'view_staff.php';

require_once 'view_bottom.php';