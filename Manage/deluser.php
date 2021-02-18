<?php

require_once "../dblink.php";

if(isset($_GET['id']))
{
    if(!empty($_GET['id']))
    {

        $id = $_GET['id'];
        $isactive = $_GET['IsActive'];



        $sql = "UPDATE km_user SET IsActive = $isactive
        WHERE UserID = $id";

        mysqli_query($link,$sql);
        mysqli_close($link);
        header("location: ../listuser.php");
        exit();
    }
}



?>