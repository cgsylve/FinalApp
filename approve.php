<?php	
	session_start();
	
	include("finalapp_hosted_dbconn.php");
	             
	if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['listId']) && !empty($_GET['listId'])){
	    // Verify data
	    $email = mysql_escape_string($_GET['email']); // Set email variable
	    $listId = mysql_escape_string($_GET['listId']); // Set hash variable
	                 
	    $sql = "INSERT INTO approved VALUES ('$email', '$listId')";

	    $retval = mysql_query($sql, $conn) 
	    	or die(mysql_error()); 
		
		mysql_close($conn);	    	                 
	}else{
	    // Invalid approach
	    echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
	}
?>