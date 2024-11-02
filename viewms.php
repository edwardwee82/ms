<!DOCTYPE html>
<head>
    <title>View Clause Details</title>
    <script src="https://cdn.tiny.cloud/1/tjwm8rfvtvnbrk7m1slkwdirjauctg8cffuleg4oqw3y4324/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script> 
    


    function submitcd(sys1, clause1) {
       
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("content").innerHTML = this.responseText;
        }
        };
        xmlhttp.open("GET","./api/viewclause.php?sys="+sys1+"&clause="+clause1,true);
        xmlhttp.send();

    }
    </script>

</head>
<?php 

    include ".conn.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
    $menu=setmenu($conn);


    
?>

    <body>

        <table width=100%>
            <tr>
                <td valign=top><div id='menu'><?php echo $menu;  ?></div></td>
                <td valign=top><div id='content'></div></td>
            </tr>
        </table>

    

<?php

function setmenu($conn)
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
        while($row = $result->fetch_assoc())
        {
            
            if($tsys!==$row["systemName"])
            {
                if($cnt>1)
                {
                    $menu.="</ul>";
                }
                $tsys=$row["systemName"];
                $menu.= "<h3>$tsys</h3>";
                $menu.= "<ul>";
            }

            $menu.="<li>";
            $clause=$row["clauseName"];
            $sys=$row["systemName"];

            $menulabel=$row["clauseName"].". ".$row["processName"];
            $menu.="<a onclick=\"submitcd('$sys','$clause')\">$menulabel</a>\n";

            $cnt+=1;

        }
        $menu.="</ul>";
    }
    return $menu;
}

?>