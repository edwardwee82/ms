<?php 

    include "./../.conn.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $x="";
      if (isset($_POST['sys'])&&isset($_POST['clause']))
      {
          $sys=$_GET['sys'];
          $clause=$_GET['clause'];
          $x.="<h3>$sys $clause</h3>";
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
                $cd="";
                  
                  if($row['clauseDetails']!=="")
                  {
  
                      $tid="cdet".$cid;
                      
                     
                      $cd=$row['clauseDetails'];
                      
                  }
                  $x.= "<h5> $clausename $clausedesc  </h5>";
                  $x.= $cd;
                  
  
              }
              echo $x;
          }
          else
          { 
            echo "0 Clause Selected";
          }
  
      }
      else
      {
        echo '0 Clause Selected Yet';
      }



?>