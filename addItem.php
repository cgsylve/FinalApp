<?php
session_start();

	$email = $_SESSION['email'];

	function addItem($itemName, $listId, $email, $pos, $itemPriority){
		include("finalapp_hosted_dbconn.php"); 

		$nameId = "Test";

		$sql = "INSERT INTO item VALUES ('$nameId', '$listId', '$itemName', '$email', '$pos', '$itemPriority')";

		$retval = mysql_query($sql, $conn); 

		echo ("done");

		mysql_close($conn);
	}

	if($_POST['action'] == 'addItem'){
		$itemPriority = $_POST['itemPriority'];
		$pos = $_POST['pos'];
		$itemName = $_POST['itemName'];
		$listId = $_POST['listId'];
		addItem($itemName, $listId, $email, $pos, $itemPriority);
	}

?>