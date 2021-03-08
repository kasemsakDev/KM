<?php

session_start();
ob_start();


    if(isset($_POST['save']))
    {
        require_once "../dblink.php";

        function _getNumber($purposeId,$link)
        {
            $numberindicator= 0;  
            $sql = "select number FROM km_indicator 
			Where PurposeID = $purposeId
            ORDER BY number DESC 
            LIMIT 1";
            $result = mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
              $numberindicator = (string)$row['number'];
            }

            $numberPurposeID = 0;
            $sql = "select number FROM km_purpose where PurposeID = $purposeId";
            $result = mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
              $numberPurposeID = (float)$row['number'];
            }       

            $number = "";
            if($numberindicator == null || $numberindicator == 0)
            {
                $numberindicator = 0;        
                $numberindicator = $numberindicator + 1;            
                $str = (string)$numberPurposeID .'.'. (string)$numberindicator;
                $number = $str;
            }else {     
                    $integerIDs = array_map('intval', explode('.', $numberindicator));
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

            $number = _getNumber($purposeId,$link);

            $sql = "INSERT INTO km_indicator (PurposeID,Name,AgencyID,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn,Number)
            VALUES ('".$purposeId."','".$name."','".$agencyId."','1','".$userId."','".$datetime."','".$userId."','".$datetime."','".$number."');";
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