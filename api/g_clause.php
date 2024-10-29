<?php
	include_once "./.conn.php";
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
	//header details
	$title="Integrated Management System Enthusiast";
	//echo $servername;
	
?>


<?php
	
	
	
	echo $z;
?>



<?php

function getclause($sysid, $clause)
{
	
	
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
	if ($result->num_rows > 0) {



	  $processName="";
		$cnt=1;
	  while($row = $result->fetch_assoc()) {
		$x.="{'System':'".$row["systemName"]."', 'ClauseName':'".$row["clauseName"]."', 'Clause Description': '".nl2br($row["clauseDescription"])."', 'Clause Details' :'".nl2br($row["clauseDetails"])."'}";


		/* if($row["processName"]!=$processName)
		{	
			$processName=$row["processName"];
			if($cnt>1)
			{
			$x.="}";
			}

			$x.="{'System':'".$row["systemName"]."', 'ClauseName':'".$row["clauseName"]."' ".$processName."</h4>\n";
			$x.="\n<table border=0>\n";
			$cnt+=1;
			
		


		if($row["processName"]!=$processName)
		{	
			$processName=$row["processName"];
			if($cnt>1)
			{
			$x.="<h4>".$row["systemName"]." - ".$row["clauseName"]." ".$processName."</h4>\n";
			$x.="\n<table border=0>\n";
			$cnt+=1;
			
		}
		else
		{
			
			//$x.= "<td>".$row["clauseID"]."</td>";
			$x.= "$row["clauseName"].";\n";
			$x.= nl2br($row["clauseDescription"]).";".nl2br($row["clauseDetails"]);
			if($row["ApplicabilityCriteria"]!=null)
			{
					$x.= "<br><b>Applicability</b><br>".nl2br($row["ApplicabilityCriteria"])."<br>\n";
					
			}
			if($row["Intent"]!=null)
			{
					$x.= "<br><b>Intent</b><br>".nl2br($row["Intent"])."<br>\n";
					
			}
			if($row["IntRef"]!=null)
			{
					$x.= "<br><b>Internal Ref</b><br>".nl2br($row["IntRef"])."<br>\n";
					
			}
			if($row["ExtRef"]!=null)
			{
					$x.= "<br><b>Internal Ref</b><br>".nl2br($row["ExtRef"])."<br>\n";
					
			}
			
					
					
			
			
			$x.="</td>\n";
			$x.= "</tr>\n";
			$cnt+=1;
		}
 */	  }
	  
	} else {
	  $x.= "0 results";
	}
	$conn->close();
	return $x;
	
}


?>