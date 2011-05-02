<?php
require_once 'inc.php';
require_once 'view_top.php';
?>
<?php

if(!$_SESSION['login']){
	include 'view_login.php';
} else {
	if ($_SESSION['staff']){
		include 'view_dashboard_staff.php';
	} else {
		include 'view_dashboard.php';
	}
}
?>
<?php
require_once 'view_bottom.php';