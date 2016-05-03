<?php
$username = "root";
$password = "";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
	or die("Unable to connect to MySQL");
$examples = mysql_select_db("examples",$dbhandle)
	or die("Could not select examples");
?>