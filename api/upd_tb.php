<?php
    if (isset($_POST['content'])) {
        $content = $_POST['content'];
        $idcol=$_POST['idcol'];
        $col=$_POST['col'];
        $ttype=$_POST['ttype'];
        $tbl=$_POST['tbl'];
        $id=$_POST['id'];
        
        // Save the content to a file or database
        //file_put_contents('content.txt', $tbl." ".$idcol." ".$id." ".$col." ".$content);
        $x=updatetb($tbl, $id, $idcol, $col, $content);
        file_put_contents('content.txt', $x);
        //echo '$tid Content saved successfully!';
      } else {
        //echo 'No content received.';
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

?>