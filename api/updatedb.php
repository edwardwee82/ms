<?php
    if (isset($_POST['content'])) {
        $content = $_POST['content'];
        // Save the content to a file or database
        //file_put_contents('content.txt', $content);
        echo 'Content saved successfully!';
      } else {
        echo 'No content received.';
      }



    if(isset($_POST['updatetype']))
    {
        $type=$_POST['updatetype'];
        switch($type)
        {
            case "uClause":
                updateclause();
                break;

            default:
                echo "Wrong Type";
        }
    }


function updateclause()
{

    include "./../.conn.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $sql="";
      if ($res = $conn -> query($sql)) 
      {
        echo "Returned rows are: " . $res -> num_rows;
        // Free result set
        //$res -> free_result();
      }
}

?>