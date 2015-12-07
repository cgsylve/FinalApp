<?php
	session_start();

	$email = $_SESSION['email'];

	function createList($date, $listName, $email){
		include("finalapp_hosted_dbconn.php"); 
		$listId = uniqid(); 

		if(empty($listName)){			
			$sql = "INSERT INTO list VALUES ('$date', '$listId', '$email')";
			$retval = mysql_query($sql, $conn)
				or die("SQL Query Error In Creating List");
		}

		else{
			$sql = "INSERT INTO list VALUES ('$listName', '$listId', '$email')";
			$retval = mysql_query($sql, $conn)
				or die("SQL Query Error In Creating List");
		}

		$sql = "INSERT INTO approved VALUES ('$email', '$listId')";
		$retval = mysql_query($sql, $conn)
			or die("Failed to insert into approved");

		echo($email);

		$_SESSION['approvedList'][] = $listId;
		
		mysql_close($conn);
	}

	if($_POST['action'] == 'createList'){	
		$listName = $_POST['listName'];
		$date = $_POST['date'];
		createList($date, $listName, $email);
	}
?>