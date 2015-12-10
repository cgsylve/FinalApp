<?php
	session_start();

	include("finalapp_hosted_dbconn.php");

	$listId = $_POST['listId'];

	$sql = "DELETE FROM list WHERE listid='$listId'";

	$retval = mysql_query($sql, $conn); 

	$sql = "DELETE FROM item WHERE listid='$listId'";

	$retval = mysql_query($sql, $conn); 

	

	mysql_close($conn);
?>