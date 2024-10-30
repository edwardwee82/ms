<?php
	
	//menu selections
	$z="";
	if(isset($_GET['sys']))
	{
		$sys= $_GET['sys'];
		$clause= $_GET['clause'];
		//echo "$sys $clause";
		$z=getclause($sys,$clause);
				
	
	}
	else
	{
		$z="Error";
	}
	
	
?>



<?php
	
	
	
	echo $z;
?>



<?php

function getclause($sysid, $clause)
{
	include "./../.conn.php";
	//echo $username;
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	//$x ="Connected successfully <br>";
	$x="";
	
	
	
	$sql = "SELECT * FROM `tClauses` WHERE `systemName` LIKE '%$sysid%' AND `clauseName`='$clause' ORDER BY `systemName` DESC, `clauseID` ASC;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) 
	{



	  $processName="";
		$cnt=1;
	  while($row = $result->fetch_assoc()) {
		$x.='{"System":"'.$row["systemName"].'", "ClauseName":"'.$row["clauseName"].'", "Clause Description": "'.nl2br($row["clauseDescription"]).'", "Clause Details" :"'.nl2br($row["clauseDetails"]).'"}';

 	  }
	  
	} else {
	  $x.= "0 results";
	}
	$conn->close();
	return $x;
	
}


?>