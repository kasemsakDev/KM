<?php

session_start();
ob_start();


    if(isset($_POST['save']))
    {
        require_once "../dblink.php";



        function _getNumber(/*กำลังทำ  */)
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

            $number = "";
            if($numberindicator == null || $numberindicator == 0)
            {

                $numberPurposeID = 0;
                $sql = "select number FROM km_purpose where PurposeID = $purposeId";
                $result = mysqli_query($link,$sql);
                while($row = mysqli_fetch_assoc($result))
                {
                  $numberPurposeID = (float)$row['number'];
                }       

                $numberindicator = 0;        
                $numberindicator = $numberindicator + 1;            
                $str = (string)$numberPurposeID .'.'. (string)$numberindicator;
                $number = $str;
                //echo $result_number;
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
        }

        $id = $_POST['id'];
        $name = $_POST['name'];
        $agencyId = $_POST['agencyid']; 
        $userid = $_SESSION["id"];
        $indicatorId = $_POST['indicatorid'];

        $datetime = date('Y-m-d H:i:s');
        $sql = "";
        if($id == 0)
        { //INSERT
            $sql = "INSERT INTO km_strategy (IndicatorID,Name,AgencyID,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn)
            VALUES ('".$indicatorId."','".$name."','".$agencyId."','1','".$userid."','".$datetime."','".$userid."','".$datetime."');";          
          //  echo $sql; exit();
        }else{
            //Update
        //    echo $id; exit();
            $sql = "UPDATE  km_strategy
            SET Name = '$name',IndicatorID = $indicatorId
            WHERE StrategyID = $id";
        }
        mysqli_query($link,$sql);
        mysqli_close($link);
        header("location: ../strategy.php");

    }

?>