<?php
require_once 'inc.php';

if ($_SESSION['login'])
	header('Location: index.php');
	
require_once 'view_top.php';

if ($_POST){
	// staff signup
	$username =  trim($_POST['username']);
	$password = md5($_POST['password']);
	$type = $_POST['type'];
	
	$type = ($type=='sales') ? 'SALES' : 'EXEC';
	
	$count_query = mysql_query("SELECT COUNT(*) FROM ground_staff where name='$username'", $mysql) or die(mysql_error());
	$count = intval(mysql_result($count_query,0,0));
	
	if ($count>0){
		$error = 'Username in use.';
	} else {
		$insert_query = "INSERT INTO ground_staff (name,password,type,date_joined) VALUES ('$username', '$password', '$type', NOW());";
		
		mysql_query($insert_query, $mysql) or die(mysql_error());
		$success = 'Registration completed.';
	}
}
require 'view_signup_staff.php';

require_once 'view_bottom.php';