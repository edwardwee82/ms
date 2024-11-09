<?php
    $idcol=$_POST['idcol'];
    $col=$_POST['col'];
    $type=$_POST['type'];
    $tbl=$_POST['tbl'];
    $id=$_POST['id'];
    $val=$_POST['val'];
    if (isset($_POST['content'])) {
        $content = $_POST['content'];
        
        
        // Save the content to a file or database
        //file_put_contents('content.txt', $tbl." ".$idcol." ".$id." ".$col." ".$content);
        $x=updatetb($tbl, $id, $idcol, $col, $content);
        //file_put_contents('content.txt', $x);
        //echo '$tid Content saved successfully!';
      } else {
        //echo 'No content received.';
      }

      if(isset($_POST['type']))
      {
        $type=$_POST['type'];
        if($type=='chkboxbool')
        {
            $x=chkboxbool($tbl, $id, $idcol, $col, $val);
        }
      }


function updatetb($tbl, $id, $idcol, $col, $content)
{

    include "./../.conn.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $sql="UPDATE `$tbl` SET `$col`='$content' WHERE `$idcol`=$id;";
      
      if ($res = $conn -> query($sql)) 
      {
        //echo "Returned rows are: " . $res -> num_rows;
        // Free result set
        //$res -> free_result();
      }
      return $sql;
}

function chkboxbool($tbl, $id, $idcol, $col, $val)
{

    include "./../.conn.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      if($val=="Yes")
      {
        $val=TRUE;
      }
      else
      {
        $val=FALSE;
      }

      $sql="UPDATE `$tbl` SET `$col`='$content' WHERE `$idcol`=$id;";
      
      if ($res = $conn -> query($sql)) 
      {
        //echo "Returned rows are: " . $res -> num_rows;
        // Free result set
        //$res -> free_result();
      }
      return $sql;
}

?>