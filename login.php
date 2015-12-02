<?php
session_start();

// SQL for creating login table
//
// 	CREATE TABLE `login` (
//  `fname` varchar(100) NOT NULL,
//  `lname` varchar(100) NOT NULL,
//  `email` varchar(100) NOT NULL,
//  `pass` varchar(100) NOT NULL,
//  `validated` varchar(1) NOT NULL,
//  PRIMARY KEY (`email`)
// ) 

	function login($email, $pass){

	include("finalapp_localhost_dbconn.php");
	    
		$sql = "SELECT fname, lname, email, pass, validated
				  FROM login
		 		  WHERE email = '$email'
		 		  AND pass = '$pass'";

		$retval = mysql_query($sql, $conn)
			or die("Failed");

		if(mysql_num_rows($retval)){
			while($row = mysql_fetch_assoc($retval)){

				$user = $row['email'];
				$pass = $row['pass'];
				$validated = $row['validated'];
				$fname = $row['fname'];
				$lname = $row['lname'];
				

				

				if($validated == "n"){
					echo ("not approved");

				}// end if

				else{
					$msg = "passed";
					echo ($msg);
				} //end else

				} // end while
		} // end if			

		else{
			echo ("wrong");
		}// end else


		mysql_close($conn);	
	} //end login()

	function sendMail($email){

		$to = "spplpaintball@gmail.com"; 

		$subject = "Welcome To The List App!";
		$msg = "<h3>Welcome to the list app. Please click below to verify your email</h3>";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: <no-reply@calebsylvester.com>" . "\r\n";

		mail($to, $subject, $msg, $headers);

		return "Sent";
	}

	function createUser($fname, $lname, $email, $pass){

		include("finalapp_localhost_dbconn.php");
	       
		$sql = "INSERT INTO login VALUES ('$fname', '$lname', '$email', '$pass', 'n')"; //fname, lname, email, pass, validated

		$retval = mysql_query($sql, $conn)
			or die("Failed");

		$res = sendMail($email);

		if ($res == "Sent"){
			echo ("Success");
		}

		else{
			echo ("Failed To Send");
		}
		
		mysql_close($conn);		

		}

	

		if($_POST['action'] == "login"){	
			$email = $_POST['email'];
			$pass = $_POST['pass'];		
			login($email, $pass);

							
		}
		else if ($_POST['action'] == "create"){
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$email = $_POST['email'];
			$pass = $_POST['pass'];

			createUser($fname, $lname, $email, $pass);
		}
				
?>