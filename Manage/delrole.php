<?php

require_once "../dblink.php";

if(isset($_GET['id']))
{
    if(!empty($_GET['id']))
    {

        $id = $_GET['id'];

        $sql = "UPDATE km_role SET IsActive = 0
        WHERE RoleID = $id";

        mysqli_query($link,$sql);
        mysqli_close($link);
        header("location: ../listrole.php");
        exit();
    }
}



?>