<?php
	//menu selections
	$z="";
	if(isset($_GET['menu']))
	{
		$menu= $_GET['menu'];
		
		if($menu=="System")
		{
			//$system= $_GET['sysID'];
			
				$z=getclause($_GET['sysID']);
			
		}
		else
		{
			$z=getSystems();
		}
		
	
	}
	else
	{
		$z=getSystems();
	}
	
	
?>

<?php
	//header details
	$title="Integrated Management System Enthusiast";
	//echo $servername;
	
?>

<html>
<head>
<title><?php echo $title; ?></title>
<link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>

<h1><?php echo $title; ?></h1>

<?php
	//$x.= "test";
	
	
	echo $z;
?>


</body>


</html>

<?php

function getSystems()
{
	include_once "conn.php";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	//$x ="Connected successfully <br>";
	$x="";
	
	
	
	$sql = "SELECT * FROM `tSystems`;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	  // output data of each row
	  $x.= "<table border=1>";
/*	  $x.="<tr>
		<th>sysID</th>
		<th>System</th>
		<th>Description</th>
		</tr>";
*/

	  while($row = $result->fetch_assoc()) {
		//$x.= "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
		$x.= "<tr>";
		//$x.= "<td><a href='index.php?menu=System&sysID=".$row["systemName"]."'>".$row["systemID"]."</a></td>";
		$x.= "<td><a href='index.php?menu=System&sysID=".$row["systemName"]."'>".$row["systemName"]."</a></td>";
		$x.= "<td>".$row["systemDescription"]."</td>";
		$x.= "</tr>";
	  }
	  $x.= "</table>";
	} else {
	  $x.= "0 results";
	}
	$conn->close();
	return $x;
	
}

function getclause($sysid)
{
	include_once "conn.php";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	//$x ="Connected successfully <br>";
	$x="";
	
	
	
	$sql = "SELECT * FROM `tClauses` WHERE `systemName` LIKE '%$sysid%' ORDER BY `systemName` ASC, `clauseName` ASC;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	  // output data of each row
	  
	  
	  //$x.=$result->num_rows." Rows For ".$sysid;
	  $processName="";
	  $x.="<h3>".$sysid."</h3>";
		$cnt=1;
	  while($row = $result->fetch_assoc()) {
		  
		if($row["processName"]!=$processName)
		{	
			$processName=$row["processName"];
			if($cnt>1)
			{$x.="</table>\n";}
			$x.="<h4>".$row["systemName"]." - ".$row["clauseName"]." ".$processName."</h4>\n";
			$x.="\n<table border=0>\n";
			$cnt+=1;
			
		}
		else
		{
			$x.= "\n<tr>";
			//$x.= "<td>".$row["clauseID"]."</td>";
			$x.= "<td valign=top>".$row["clauseName"]."</td>\n";
			$x.= "<td>".nl2br($row["clauseDescription"])."<br>\n".nl2br($row["clauseDetails"]);
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
	  }
	  
	} else {
	  $x.= "0 results";
	}
	$conn->close();
	return $x;
	
}


?>