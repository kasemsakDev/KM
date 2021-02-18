<?php 

require_once "../dblink.php";

session_start();
ob_start();

if(isset($_POST['save'])){

    $name = $_POST['name'];
    if($_POST['RoleID'] == 0){
        //INSERT
        $sql = "INSERT INTO km_role (Name,IsActive)
        VALUES ('$name',1);";
        mysqli_query($link,$sql);

    }else{
        //Update
        $id = $_POST['RoleID'];
        $sql = "UPDATE km_role
        SET Name = '$name',IsActive = 1
        WHERE RoleID = $id";

        mysqli_query($link,$sql);
    
    }
    mysqli_close($link);
    header("location: ../listrole.php");

}


?>