<?php 

require_once "../dblink.php";

session_start();
ob_start();






if(isset($_POST['save'])){
    $name = "";$name_err = "";$password = "";$passowrd_err = "";
    $agencyId = 0;$roleId = 0;

    //check name
    if(empty(trim($_POST["name"])))
    {
        $name_err = "Please enter username.";
    }else{
        $name = trim($_POST["name"]);
    }

    //check passowrd

    if(empty(trim($_POST['password'])))
    {
        $password_err = "Please enter Password";
    }else{
        $password = trim($_POST['password']);
    }



    //check all 
    if(empty($name_err) && !empty($_POST['roleId']) && !empty($_POST['agencyId']))
    {

        if($_POST['UserID'] == 0){


        $agencyId = $_POST['agencyId'];
        $roleId = $_POST['roleId'];
        $datetime = date('Y-m-d H:i:s');
        //true
        $sql_check = "SELECT Name, IsActive From km_user WHERE  Name = '$name' AND  IsActive = 1";
        $result = mysqli_query($link,$sql_check);

        $rescheck = mysqli_fetch_assoc($result);
    
      
        if($rescheck == null)
        {  //INSERT
            // Is true    VALUES ('".$agencyId."','".$roleId."','".$name."','".$passowrd."',1,'".$_SESSION["id"]."','".$datetime."','".$_SESSION["id"]."','".$datetime."');";        
            $password = password_hash($password, PASSWORD_DEFAULT);  
            $sql_Insert = "INSERT INTO km_user (AgencyID,RoleID,Name,Password,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn)
            VALUES ('".$agencyId."','".$roleId."','".$name."','".$password."',1,'".$_SESSION["id"]."','".$datetime."','".$_SESSION["id"]."','".$datetime."');";

            mysqli_query($link,$sql_Insert);
            header("location: ../listuser.php");

        }else{
           echo 'have a username in db';
        }

    }else{

            //Update
    $userid = $_POST['UserID'];
    $agencyId = $_POST['agencyId'];
    $roleId = $_POST['roleId'];
    $datetime = date('Y-m-d H:i:s');

            $sql_update = "UPDATE km_user SET Name = '$name',AgencyID = $agencyId, RoleID = $roleId
            Where UserID = $userid";

            mysqli_query($link,$sql_update);
            header("location: ../listuser.php");
    }

    }else{
        //false
        echo 'Missing information';
    }
    //redirect 
    
    mysql_close($link);

}
?>