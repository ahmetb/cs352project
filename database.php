<?php

$databaseConfig = Array(
	"db" => "airlinee",
	"server" => "db.ahmetalpbalkan.com",
	"user" => "airlinee",
	"pass" => "airlinee",
	"pass" => "root"
);

$mysql = mysql_connect($databaseConfig["server"],$databaseConfig["user"],$databaseConfig["pass"]) or die("DB CONNECTION ERROR.");

mysql_select_db($databaseConfig["db"], $mysql) or die("SELECT DATABASE ERROR.") or die(mysql_error());
