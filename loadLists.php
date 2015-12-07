<?php
	session_start();

	function loadLists(){

	include("finalapp_hosted_dbconn.php");

	$sql = "SELECT listname, listid FROM list WHERE listid IN (";
	$count = 0; 
	$total = count($_SESSION['approvedList']);
	$approvedList = $_SESSION['approvedList'];

	foreach($approvedList as $id){
		if($count != $total - 1){
			$sql .= "'".$id."', ";
			$count++;
		}

		else{
			$sql .= "'".$id."')";
		}
		
	}

	$retval = mysql_query($sql, $conn);
	$countRow = 0; 

	while($row = mysql_fetch_row($retval)){
		if($countRow == 0){
			echo "<div class='row' id='listrow'>";
		}
		echo "<div class='col-xs-4'>";
		echo "<button type='button' class = 'btn btn-info btn-primary listbtn' id ='".$row[0]."' data-toggle='collapse' data-target='#".$row[1]."'>".$row[0]."</button>";
		echo "<div id='".$row[1]."' class='collapse'>";
		$sql = "SELECT itemText, email FROM item WHERE listid = '".$row[1]."'";
		$returned = mysql_query($sql, $conn);
		while($itemRow = mysql_fetch_row($returned)){
			echo "<p><a href='#' data-toggle='popover' title='Added By' data-trigger='hover' data-content='".$itemRow[1]."'>".$itemRow[0]."</a></p>";
		}
		echo "<label for = 'addItemInputField'>Add Item</label>";
		echo "<input type = 'text' class = 'form-control' id='".$row[1]."-input'></input>";
		echo "<button type='button' class='btn btn-info addItemBtn'>Add</button>";
		echo "<p><label for = 'approveUserInputField'>Approve User For This List</label>";
		echo "<input type = 'text' class = 'form-control' id='".$row[1]."-approve'></input>";
		echo "<button type='button' class='btn btn-info approveBtn'>Approve</button></p>";
		echo "</div>";		
		echo "</div>";

		if($countRow == 2){
			echo "</div>";
		}

		if($countRow == 2){
			$countRow = 0; 
		} else{
			$countRow++; 
		}
		
	}

	
	mysql_close($conn);	
	}

	loadLists();
?>