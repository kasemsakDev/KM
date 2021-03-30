<?php 

require_once "../dblink.php";

session_start();
ob_start();

if(isset($_POST['save'])){

    $name = $_POST['name'];
    if($_POST['AgencyID'] == 0){
        //INSERT
        $sql = "INSERT INTO km_agency (Name,IsActive)
        VALUES ('$name',1);";
        mysqli_query($link,$sql);

    }else{
        //Update
        $id = $_POST['AgencyID'];
        $sql = "UPDATE km_agency
        SET Name = '$name',IsActive = 1
        WHERE AgencyID = $id";

        mysqli_query($link,$sql);
    
    }
    mysqli_close($link);
    header("location: ../listagency.php");

}


?>