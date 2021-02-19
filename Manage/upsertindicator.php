<?php

session_start();
ob_start();


    if(isset($_POST['save']))
    {
        require_once "../dblink.php";
        $id = $_POST['id'];
        $name = $_POST['name'];
        $agencyId = $_POST['agencyid']; 
        $userId = $_SESSION["id"];
        $purposeId = $_POST['purposeid'];

        $datetime = date('Y-m-d H:i:s');
        $sql = "";
       // echo $id;
       // exit();
        if($id == 0)
        { //INSERT
            $sql = "INSERT INTO km_indicator (PurposeID,Name,AgencyID,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn)
            VALUES ('".$purposeId."','".$name."','".$agencyId."','1','".$userId."','".$datetime."','".$userId."','".$datetime."');";
           
          //  echo $sql; exit();
        }else{
            //Update
        //    echo $id; exit();
            $sql = "UPDATE  km_indicator
            SET Name = '$name',PurposeID = $purposeId
            WHERE IndicatorID = $id";
        /* echo $sql;
         exit(); */
        }
        mysqli_query($link,$sql);
        mysqli_close($link);
        header("location: ../indicator.php");

    }

?>