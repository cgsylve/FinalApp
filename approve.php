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


<!DOCTYPE html>
<html>
<head>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS CDN -->
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> <!-- Bootstrap JS CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> <!-- jQuery 1.11 CDN -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <script type="text/javascript">
    	$(document).ready(function(){
    		window.location.replace("http://calebsylvester.com/FinalApp/LoginPage.php");
    	});
    </script>

</head>
<body>
</body>
</html>