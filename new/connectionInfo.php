<?php
    $host = "localhost";
	$dbname = "complete_db";
	$username = "admin";
	$password = "soflinux1";
	
	$conn = mysqli_connect($host, $username, $password, $dbname);
	
	if(mysqli_connect_errno()) {
	    die("Connection error: " . mysql_connect_error());
	}
?>