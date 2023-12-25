<?php
$host ="localhost";
$port = 5432;
$dbname = "postgres";
$user="postgres";
$password="rahul@2003";

$db = pg_connect("
	host=$host
	port=$port
	dbname=$dbname
	user=$user
	password=$password
") or die("Connection Failed");

if($db){
	echo "DB connected";
}

?>