<?php

require_once "../dblink.php";

if(isset($_GET['id']))
{
    if(!empty($_GET['id']))
    {

        $id = $_GET['id'];

        $sql = "UPDATE km_agency SET IsActive = 0
        WHERE AgencyID = $id";

        mysqli_query($link,$sql);
        mysqli_close($link);
        header("location: ../listagency.php");
        exit();
    }
}



?>