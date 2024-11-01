<!DOCTYPE html>
<head>
    <title>Update Clause Details</title>
    <script src="https://cdn.tiny.cloud/1/tjwm8rfvtvnbrk7m1slkwdirjauctg8cffuleg4oqw3y4324/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
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
        <script type="text/javascript">
            tinymce.init({
                selector: '#textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            });

            
        </script>

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
    
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_GET['sys'])&&isset($_GET['clause']))
    {
        $sys=$_GET['sys'];
        $clause=$_GET['clause'];
        $x.="<h1>$sys $clause</h1>";
        $sql = "SELECT * FROM `tClauses` WHERE `systemName` LIKE '$sys' AND `clauseName` LIKE '$clause%' ORDER BY `systemName` DESC, `clauseID` ASC;";
        $result = $conn->query($sql);
	    //echo $sql;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) 
            {
                $clausedesc="";
                $clausedet="";
                $clausename=$row['clauseName'];
                if(is_null($row['clauseDescription'])==false||$row['clauseDescription']!=="")
                {
                    
                    $clausedesc="<textarea>".nl2br($row['clauseDescription'])."</textarea>";}
                
                if($row['clauseDetails']!=="")
                {
                    
                    $clausedet="<textarea>".nl2br($row['clauseDetails'])."</textarea>";}
                $x.= "<h5> $clausename $clausedesc </h5>";
                $x.= $clausedet;

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