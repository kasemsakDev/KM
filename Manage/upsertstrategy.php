<?php

session_start();
ob_start();

    if(isset($_POST['save']))
    {
        require_once "../dblink.php";
        function _getNumber($indicatorId,$link)
        {
            $numberStrategy = 0;  
            $sql = "select number FROM km_strategy 
			Where IndicatorID = $indicatorId
            ORDER BY number DESC 
            LIMIT 1";
            $result = mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
              $numberStrategy = (string)$row['number'];
            }
            $number = "";
            if($numberStrategy == null || $numberStrategy == 0)
            {
                $numberIndicatorID = 0;
                $sql = "select number FROM km_indicator where IndicatorID = $indicatorId";
                $result = mysqli_query($link,$sql);
                while($row = mysqli_fetch_assoc($result))
                {
                  $numberIndicatorID = (string)$row['number'];
                }       
                $numberStrategy = $numberStrategy + 1;            
                $str = (string)$numberIndicatorID .'.'. (string)$numberStrategy;
                $number = $str;
                //echo $result_number;
            }else {  
                    $integerIDs = array_map('intval', explode('.', $numberStrategy));
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
        $userid = $_SESSION["id"];
        $indicatorId = $_POST['indicatorid'];
        $datetime = date('Y-m-d H:i:s');
        $sql = "";
        if($id == 0)
        { //INSERT
           $number = _getNumber($indicatorId,$link);
            $sql = "INSERT INTO km_strategy (IndicatorID,Name,AgencyID,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn,Number)
            VALUES ('".$indicatorId."','".$name."','".$agencyId."','1','".$userid."','".$datetime."','".$userid."','".$datetime."','".$number."');";          
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