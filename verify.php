<?php
	include("finalapp_hosted_dbconn.php");

	/*
		IMPORTANT - This code was taken from http://code.tutsplus.com/tutorials/how-to-implement-email-verification-for-new-members--net-3824 and modified for my own needs
	*/
	             
	if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
	    // Verify data
	    $email = mysql_escape_string($_GET['email']); // Set email variable
	    $hash = mysql_escape_string($_GET['hash']); // Set hash variable
	                 
	    $search = mysql_query("SELECT email, hash, validated FROM login WHERE email='".$email."' AND hash='".$hash."' AND validated='n'") or die(mysql_error()); 
	    $match  = mysql_num_rows($search);
	                 
	    if($match > 0){
	        // We have a match, activate the account
	        mysql_query("UPDATE login SET validated='y' WHERE email='".$email."' AND hash='".$hash."' AND validated='n'") or die(mysql_error());
	        echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
	    }else{
	        // No match -> invalid url or account has already been activated.
	        echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
	    }
	                 
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