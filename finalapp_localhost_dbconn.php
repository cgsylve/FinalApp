<?php
	$username = "root";
    $password = "root";
    $hostname = "localhost"; 

        //connection to the database
    $conn = mysql_connect($hostname, $username, $password) 
    	or die("Unable to connect to MySQL");

    mysql_select_db("finaldb");
?>