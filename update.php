<!DOCTYPE html>
<head>
    <title>Update Clause Details</title>
    <!--<script src="https://cdn.tiny.cloud/1/tjwm8rfvtvnbrk7m1slkwdirjauctg8cffuleg4oqw3y4324/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>-->
     <script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<?php 

    include ".conn.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
    $menu=setmenu($conn);
    $output=getoutput($conn);

    
?>





    
    <body>

        <table width=100%>
            <tr>
                <td valign=top><?php echo $menu;  ?></td>
                <td valign=top><?php echo $output; ?></td>
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
    $sql = "SELECT * FROM `tClauses` WHERE `systemName` LIKE '%ISO%' AND `clauseName` NOT LIKE '%.%' ORDER BY `systemName` DESC, `clauseID` ASC;";
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
            $menu.="<a href='./update.php?sys=$sys&clause=$clause'>$menulabel</a>\n";

            $cnt+=1;

        }
        $menu.="</ul>";
    }
    return $menu;
}

function getoutput($conn)
{
    $x="";
    include('inc.tools.php');
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_GET['sys'])&&isset($_GET['clause']))
    {
        $sys=$_GET['sys'];
        $clause=$_GET['clause'];
        $x.="<h3>$sys </h3>";
        $sql = "SELECT * FROM `tClauses` WHERE `systemName` LIKE '$sys' AND `clauseName` LIKE '$clause%' ORDER BY `systemName` DESC, `clauseID` ASC;";
        $result = $conn->query($sql);
	    //echo $sql;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) 
            {
                $clausedesc="";
                $clausedet="";
                $clausename=$row['clauseName'];
                $isheader=true;
                $cid=$row['clauseID'];
               
                
                $clausedesc=$row['clauseDescription'];
                $docevidence=$row['docevidence'];
                $recevidence=$row['recevidence'];
                
                $x.= "<h5> $clausename $clausedesc  </h5>";
                $tbl="tClauses";
                $idcol="clauseID";
                $id="$cid";


                if($row['clauseDetails']!=="")
                {
                    $tid="cdet".$cid;                 
                    $cd=$row['clauseDetails'];
                    $tbid="det_$tbl$id";
                    $ttype="$tbid";
                    $col="clauseDetails";
                    $content= "$cd";
                    $tbheight=300;
                    $x.= jsTextbox($tbid, $ttype,$idcol,$id, $tbl, $content, $col,$tbheight);
                
                    $tbid="doc_$tbl$id";
                    $ttype="$tbid";
                    $col="docevidence";
                    $content="$docevidence";
                    $val=$row['docreq'];
                    
                        $x.="<b>Documents Required </b>";
                        $x.= jsTextbox($tbid, $ttype,$idcol,$id, $tbl, $content, $col,$tbheight);
                    

                
                }
                
                

                $tbid="doc_$tbl$id";
                $ttype="$tbid";
                $col="docevidence";
                $content="$docevidence";
                $val=$row['docreq'];
                if($val==1)
                {
                    //$x.="<b>Documents Required </b>";
                    //$x.= jsTextbox($tbid, $ttype,$idcol,$id, $tbl, $content, $col,$tbheight);
                }

                $tbid="rec_$tbl$id";
                $ttype="$tbid";
                $col="recevidence";
                $content="$recevidence";
                $val=$row['recreq'];
                if($val==1)
                {
                    //$x.="<b>Records Required </b>";
                    //$x.= jsTextbox($tbid, $ttype,$idcol,$id, $tbl, $content, $col,$tbheight);
                }
                
                


            }
            return $x;
        }
        else
        { 
            return "0 Clause Selected";
        }

    }
    else
    {
        return '0 Clause Selected Yet';
    }

}
?>

</body>
</html>

<?php

function cleanname($x)
{
    $x=str_replace(".","",$x);
    return $x;

}
function br2nl($string)
{
    $breaks = array("<br />","<br>","<br/>");  
    return str_ireplace($breaks, "\r\n", $string); 
}

?>