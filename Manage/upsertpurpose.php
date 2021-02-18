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
        $issueId = $_POST['issueId'];

        $datetime = date('Y-m-d H:i:s');
        $sql = "";
        if($id == 0)
        { //INSERT
            $sql = "INSERT INTO km_purpose (IssueID,Name,AgencyID,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn)
            VALUES ('".$issueId."','".$name."','".$agencyId."','1','".$userid."','".$datetime."','".$userid."','".$datetime."');";
           
          //  echo $sql; exit();
        }else{
            //Update
        //    echo $id; exit();
            $sql = "UPDATE  km_purpose
            SET Name = '$name',IssueID = $issueId
            WHERE PurposeID = $id";
         
        }
        mysqli_query($link,$sql);
        mysqli_close($link);
        header("location: ../purpose.php");

    }

?>