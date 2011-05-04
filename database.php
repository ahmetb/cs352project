<?php

$databaseConfig = Array(
	/*"db" => "airline",
	"server" => "localhost",
	"user" => "root",
	"pass" => "root"*/
	"db" => "airlinee",
	"server" => "db.ahmetalpbalkan.com",
	"user" => "airlinee",
	"pass" => "airlinee"
);

$mysql = mysql_connect($databaseConfig["server"],$databaseConfig["user"],$databaseConfig["pass"]) or die("DB CONNECTION ERROR.");

mysql_select_db($databaseConfig["db"], $mysql) or die("SELECT DATABASE ERROR.") or die(mysql_error());
