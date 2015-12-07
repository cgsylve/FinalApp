<?php
	session_start();

	function getApproved(){		
		include("finalapp_hosted_dbconn.php");

		$email = $_SESSION['email'];
        
		$sql = "SELECT listid FROM approved WHERE email = '$email'";

		$retval = mysql_query($sql, $conn)
			or die ("Failed");

		$approvedList = array();

		if(mysql_num_rows($retval)){
			while($row = mysql_fetch_assoc($retval)){
				$approvedList[] = $row['listid']; 
			}
		}

		$_SESSION['approvedList'] = $approvedList;

		
	}

	getApproved();

?>