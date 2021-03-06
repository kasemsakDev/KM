<?php

session_start();
ob_start();

 
        require_once "../dblink.php";
        $id = $_POST['id'];
        $agencyId = $_POST['agencyid']; 
        $projectid = $_POST['projectid'];
        $agencylistid = $_SESSION["agencylistid"];    //data from session
        $_SESSION["agencylistid"] = [];
        $name = $_POST['name'];
//================Test===============================
       /* echo "id <br>";
        echo $id. "<br>";
        echo "agencyid <br>";
        echo $agencyId. "<br>";
        echo "projectid <br>";
        echo $projectid. "<br>";
        echo "agencylistid <br>";
        print_r($agencylistid); echo "<br>";
        echo " remark <br>";
        echo $remark;
        exit();
        */
//================End Test===============================

        $strAgencyid = "";
        foreach($agencylistid as $value)
        {
            $strAgencyid .=  (string)$value." ,";
        }
        $strAgencyid = substr($strAgencyid,0,-1);
        $userid = $_SESSION["id"];
        $datetime = date('Y-m-d H:i:s');
        $sql = "";
        if($id == 0)
        { //INSERT
            $sql = "INSERT INTO km_sunit (ProjectID,Name,AgencyID,IsActive,AgencyList,CreateBy,CreateOn,UpdateBy,UpdateOn)
            VALUES ('".$projectid."','".$name."','".$agencyId."','1','".$strAgencyid."','".$userid."','".$datetime."','".$userid."','".$datetime."');";          
          //  echo $sql; exit();
        }
        mysqli_query($link,$sql);
        mysqli_close($link);
        header("location: ../sunit.php");


?>