<?php

session_start();
ob_start();

    require_once "../dblink.php";
    // create Detail
    $id = $_POST['Update_id'];
    $projectid = $_POST['Update_projectid'];
    $agencyid = $_POST['Update_agencyid'];
    $projecttext = $_POST['Update_projecttext'];
    $progressive = $_POST['Update_Progressive'];
    $name = $_POST['Update_Name'];
    $userid = $_SESSION["id"];
    $datetime = date('Y-m-d H:i:s');

     $sql = "INSERT INTO km_sunitdetail (SunitID,Name,Progressive,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn)
    VALUES ('".$id."','".$name."','".$progressive."','1','".$userid."','".$datetime."','".$userid."','".$datetime."');";          

    mysqli_query($link,$sql);
    mysqli_close($link);
    header("location: ../sunit.php");

?>