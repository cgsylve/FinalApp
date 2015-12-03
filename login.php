<?php
session_start();

// SQL for creating login table

// 	CREATE TABLE `login` (
//  `fname` varchar(100) NOT NULL,
//  `lname` varchar(100) NOT NULL,
//  `email` varchar(100) NOT NULL,
//  `pass` varchar(100) NOT NULL,
//  `validated` varchar(1) NOT NULL,
//  `hash` varchar(32) NOT NULL, 
//  PRIMARY KEY (`email`)
// ) 

	function login($email, $pass){

	include("finalapp_hosted_dbconn.php");
	    
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

	function sendMail($pass, $email, $hash){


		$subject = "Welcome To The List App!";
		$msg = 'Thanks for signing up!
				Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
				 
				------------------------
				Username: '.$email.'
				Password: '.$pass.'
				------------------------
				 
				Please click this link to activate your account:
				http://www.calebsylvester.com/FinalApp/verify.php?email='.$email.'&hash='.$hash.'
				';

		// $headers = "MIME-Version: 1.0" . "\r\n";
		// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers = 'From:cgsylve@calebsylvester.com' . "\r\n";

		mail($email, $subject, $msg, $headers);

		return "Sent";
	}

	function createUser($fname, $lname, $email, $pass){

		include("finalapp_hosted_dbconn.php");

	    $hash = md5( rand(0,1000) );
	       
		$sql = "INSERT INTO login VALUES ('$fname', '$lname', '$email', '$pass', 'n', '$hash')"; //fname, lname, email, pass, validated, hash

		$retval = mysql_query($sql, $conn)
			or die("Failed");

		$res = sendMail($pass, $email, $hash);

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