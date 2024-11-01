<?php 

    include "./../.conn.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

    $sql = "SELECT `clauseID`,`clauseDescription`, `clauseDetails`, `ApplicabilityCriteria`, `Intent` FROM `tClauses`;";
    $result = $conn->query($sql);
	if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc())
        {
            $id=$row['clauseID'];
            $cdesc=cleanescape(nl2br($row['clauseDescription']));
            $cdet=cleanescape(nl2br($row['clauseDetails']));
            $ac=cleanescape(nl2br($row['ApplicabilityCriteria']));
            $intent=cleanescape(nl2br($row['Intent']));
            $sql="UPDATE `tClauses` SET `clauseDescription`='$cdesc', `clauseDetails`='$cdet', `ApplicabilityCriteria`='$ac', `Intent`='$intent'";
            $sql.=" WHERE `clauseID`=$id;";

            echo $sql."\n<br>";
            if ($res = $conn -> query($sql)) {
                echo "Returned rows are: " . $res -> num_rows;
                // Free result set
                //$res -> free_result();
              }
        }
        
    }

    function cleanescape($x)
    {
        $x=str_replace("'","\'",$x);
        return $x;

    }
?>
