<?php

session_start();
ob_start();


    if(isset($_POST['save']))
    {
        require_once "../dblink.php";
        $id = $_POST['id'];
        $name = $_POST['name'];
        $agencyId = $_POST['agencyid']; 
        $userid = $_SESSION["id"];
        $datetime = date('Y-m-d H:i:s');
        $sql = "";
        if($id == 0)
        { //INSERT
            $sql = "INSERT INTO km_issue (Name,AgencyID,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn)
            VALUES ('".$name."','".$agencyId."','1','".$userid."','".$datetime."','".$userid."','".$datetime."');";
           
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