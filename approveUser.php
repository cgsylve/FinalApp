<?php
	session_start();

	function sendMail($user, $listId, $listName){


		$subject = "You have been invited to the following list!";
		$msg = 'Hello! A user has added you to the list'.$listName.'
				 
				Please click the link to accept the invitiation if you wish.
				 
				http://www.calebsylvester.com/FinalApp/approve.php?email='.$user.'&listId='.$listId.'
				';

		// $headers = "MIME-Version: 1.0" . "\r\n";
		// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers = 'From:cgsylve@calebsylvester.com' . "\r\n";

		mail($user, $subject, $msg, $headers);

		echo "Sent";
	}

	function approveUser($user, $listId, $listName){
		include("finalapp_hosted_dbconn.php");

		sendMail($user, $listId, $listName);
		//$sql = "INSERT INTO approved VALUES ('$user', '$listId')";

		//$retval = mysql_query($sql, $conn);

		echo("Done");

		mysql_close($conn);
	}

	if($_POST['action'] == 'approve'){
		$user = $_POST['user'];
		$listId = $_POST['listId'];
		$listName = $_POST['listName'];
		approveUser($user, $listId, $listName);
	}
?>