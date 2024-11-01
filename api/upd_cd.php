<?php
    if (isset($_POST['content'])) {
        $content = $_POST['content'];
        $tid=$_POST['tid'];

        $id=str_replace("cdet","",$tid);
        $x=updateclause($id, $content);
        // Save the content to a file or database
        file_put_contents('content.txt', $id." ".$x);
        echo '$tid Content saved successfully!';
      } else {
        echo 'No content received.';
      }


function updateclause($cid, $content)
{

    include "./../.conn.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $sql="UPDATE `tClauses` SET `clauseDetails`='$content' WHERE `clauseID`=$cid;";
      
      if ($res = $conn -> query($sql)) 
      {
        //echo "Returned rows are: " . $res -> num_rows;
        // Free result set
        //$res -> free_result();
      }
      return $sql;
}

?>