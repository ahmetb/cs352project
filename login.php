<?php
require_once 'inc.php';

if ($_SESSION['login'])
	header('Location: index.php');

if ($_POST){
	$type = $_POST['type'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	
	if ($type == 'staff'){
		// staff login
		$user =  mysql_query("SELECT * FROM ground_staff where name='$username' and password='$password';", $mysql) or die(mysql_error());
		
		if(mysql_num_rows($user) < 1){
			$error = 'Username or password is incorrect for staff.';
		} else {
			// login successful
			$_SESSION['login'] = true;
			$_SESSION['staff'] = true;
			$_SESSION['id'] = mysql_result($user, 0, 'id');
			$_SESSION['username'] = $username;
			$_SESSION['type'] = strtolower(mysql_result($user, 0, 'type'));
			header('Location: index.php');			
		}
		
	} else {
		// customer login
		$user = mysql_query("SELECT * FROM customer where name='$username' and password='$password'", $mysql) or die(mysql_error());
		
		if(mysql_num_rows($user) < 1){
			$error = 'Username or password is incorrect for customer.';
		} else {
			// login successful
			
			$_SESSION['login'] = true;
			$_SESSION['id'] = mysql_result($user, 0, 'id');
			$_SESSION['username'] = $username;
			
			header('Location: index.php');
		}
	}
} 

require_once 'view_top.php';
require_once 'view_login.php';
require_once 'view_bottom.php';
