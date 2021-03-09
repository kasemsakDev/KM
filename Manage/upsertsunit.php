<?php

session_start();
ob_start();

 
        require_once "../dblink.php";


        function _getNumber($projectid,$link)
        {
            $numberSunit = 0;  
            //Table present
            $sql = "select number FROM km_sunit 
			Where ProjectID = $projectid
            ORDER BY number DESC 
            LIMIT 1";
            $result = mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
              $numberSunit = (string)$row['number'];
            }
            $number = "";
            if($numberSunit == null || $numberSunit == 0)
            {
                $numberProjectID = 0;
                //Table Before 
                $sql = "select number FROM km_project where ProjectID = $projectid";
                $result = mysqli_query($link,$sql);
                while($row = mysqli_fetch_assoc($result))
                {
                  $numberProjectID = (string)$row['number'];
                }       
                $numberSunit = $numberSunit + 1;            
                $str = (string)$numberProjectID .'.'. (string)$numberSunit;
                $number = $str;
                //echo $result_number;
            }else {  
                    $integerIDs = array_map('intval', explode('.', $numberSunit));
                    $_getindex = (count($integerIDs) - 1);
                    $newData = $integerIDs[$_getindex] + 1;
                    $integerIDs[$_getindex] = $newData;
                    foreach($integerIDs as $row)
                    {
                        $number .= (string)$row.'.';
                    }
                    $number = substr($number, 0, -1);
            }
            return $number;
        }

        $id = $_POST['id'];
        $agencyId = $_POST['agencyid']; 
        $projectid = $_POST['projectid'];
        $agencylistid = $_SESSION["agencylistid"];    //data from session
        $_SESSION["agencylistid"] = [];
        $name = $_POST['name'];
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

                $number = _getNumber($projectid,$link);

            $sql = "INSERT INTO km_sunit (ProjectID,Name,AgencyID,IsActive,AgencyList,CreateBy,CreateOn,UpdateBy,UpdateOn,Number)
            VALUES ('".$projectid."','".$name."','".$agencyId."','1','".$strAgencyid."','".$userid."','".$datetime."','".$userid."','".$datetime."','".$number."');";          
            
        }
        mysqli_query($link,$sql);
        mysqli_close($link);
        header("location: ../sunit.php");


?>