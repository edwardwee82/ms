<?php 

    include "./../.conn.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $x="";
      if (isset($_REQUEST['sys'])&&isset($_REQUEST['clause']))
      {
          $sys=$_REQUEST['sys'];
          $clause=$_REQUEST['clause'];
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
                $cd="";
                  
                  if($row['clauseDetails']!=="")
                  {
  
                      $tid="cdet".$cid;
                      
                     
                      $cd=$row['clauseDetails'];
                      
                  }
                  $x.= "<h5> $clausename $clausedesc  </h5>";
                  $x.= $cd;
                  
                  
                  $val=$row['docreq'];
                  if($val==1)
                  {
                      
                      $x.="<div class=\"bg-warning text-black\">";
                      $x.="<p><b>Documents Required </b></p>";
                      $x.= $row['docevidence'];
                      $x.="</div>";
                  }
                  $val=$row['recreq'];
                  if($val==1)
                  {
                      
                      $x.="<div class=\"bg-warning text-black\">";
                      $x.="<p><b>Records Required </b></p>";
                      $x.= $row['recevidence'];
                      $x.="</div>";
                  }
                  $x.= "<br> <hr class='hr-blurry'>";
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