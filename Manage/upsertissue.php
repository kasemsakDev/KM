<?php

session_start();
ob_start();


    if(isset($_POST['save']))
    {
        require_once "../dblink.php";

      $agencySession =  $_SESSION["AgencyID"];
      function _getNumber($link,$agencySession)
      {
        $number = 0;
        $sql = "select number FROM km_issue
        Where km_issue.AgencyID = $agencySession 
        ORDER BY number DESC 
        LIMIT 1";
        $result = mysqli_query($link,$sql);

        while($row = mysqli_fetch_assoc($result))
        {
          $number = (float)$row['number'];
        }
          if($number == null || $number == 0)
          {
            $number = 0;
          }

          $number = $number + 1;
          return $resultNumber = (string)$number;

      }


        $id = $_POST['id'];
        $name = $_POST['name'];
        $agencyId = $_POST['agencyid']; 
        $userid = $_SESSION["id"];
        $datetime = date('Y-m-d H:i:s');
        $sql = "";
        if($id == 0)
        { //INSERT
          
          $number = _getNumber($link,$agencySession);

            $sql = "INSERT INTO km_issue (Name,AgencyID,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn,number)
            VALUES ('".$name."','".$agencyId."','1','".$userid."','".$datetime."','".$userid."','".$datetime."','".$number."');";
           
          //  echo $sql; exit();
        }else{
            //Update
            $sql = "UPDATE km_issue
            SET Name = '$name'
            WHERE IssueID = $id";
          //  echo $sql; exit();
        }
        mysqli_query($link,$sql);
        mysqli_close($link);
        header("location: ../issue.php");

    }

?>