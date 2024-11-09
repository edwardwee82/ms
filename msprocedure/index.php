<!DOCTYPE html>
<?php 
	include './../inc.tools.php'; 
	include "./../.conn.php";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) 
    {
		die("Connection failed: " . $conn->connect_error);
	}
        $menu="";
        $output="";

?>

<head>
    <title>Management System Procedures</title>
	<?php
		echo callHeader();
		echo vms();
		$menu=getmenu($conn);
		$output=getcontent($conn);
	?>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-sm">
      <?php	echo $menu;	?>
    </div>
    <div class="col-lg">
	<?php	echo $output;		?>
    </div>
  </div>
</div>

</body>


<?php
function getmenu($conn)
{
	$x="";
	$x.="<h3>Menu</h3>";
	$msmenu=setviewmsmenu($conn);
	$x.="<div class=\"btn-group\">
			<button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
			Standards
			</button>
			$msmenu
			
			
		</div>";


	//$x.="Test";
	return $x;

}

function getcontent($conn)
{
	$x="";
	//$x.="Test";
	$x.="<div id='content'>a</div>";
	//$x.="Test";
	return $x;


}

function setviewmsmenu($conn)
{
    
    $menu='';
    $cnt=1;
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

    $tsys="";
    $sql = "SELECT * FROM `tClauses` WHERE `systemName` LIKE 'ISO%' AND `clauseName` NOT LIKE '%.%' ORDER BY `systemName` DESC, `clauseID` ASC;";
    $result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$menu.= '<ul  class="dropdown-menu">';
        while($row = $result->fetch_assoc())
        {
            
            if($tsys!==$row["systemName"])
            {
                if($cnt>1)
                {
                    $menu.='<li><hr class="dropdown-divider"></li><br>';
                }
                $tsys=$row["systemName"];
                
				$menu.= "<li>$tsys</li><br>";
            }

            $clause=$row["clauseName"];
            $sys=$row["systemName"];

            $menulabel=$row["clauseName"].". ".$row["processName"];
            $menu.="<li><a  class=\"dropdown-item\" onclick=\"submitcd('$sys','$clause')\">$menulabel</a></li><br>\n";

            $cnt+=1;

        }
        $menu.="</ul>";
    }
    return $menu;
}

function vms()
{
	$x='<script> 
    
    function submitcd(sys1, clause1) {
       
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("content").innerHTML = this.responseText;
        }
        };
        xmlhttp.open("GET","./../api/viewclause.php?sys="+sys1+"&clause="+clause1,true);
        xmlhttp.send();

    }
    </script>';
	return $x;
}

?>