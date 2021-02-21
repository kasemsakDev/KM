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
        $StrategyId = $_POST['Strategyid'];

        $datetime = date('Y-m-d H:i:s');
        $sql = "";
        if($id == 0)
        { //INSERT
            $sql = "INSERT INTO km_project (StrategyID,Name,AgencyID,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn)
            VALUES ('".$StrategyId."','".$name."','".$agencyId."','1','".$userid."','".$datetime."','".$userid."','".$datetime."');";          
          //  echo $sql; exit();
        }else{
            //Update
            //echo $id; exit();
            $sql = "UPDATE  km_project
            SET Name = '$name',StrategyID = $StrategyId
            WHERE ProjectID = $id";
        }
        mysqli_query($link,$sql);
        mysqli_close($link);
        header("location: ../project.php");

    }

?>