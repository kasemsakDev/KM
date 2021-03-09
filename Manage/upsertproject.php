<?php

session_start();
ob_start();


    if(isset($_POST['save']))
    {
        require_once "../dblink.php";

        function _getNumber($StrategyId,$link)
        {
            $numberProject = 0;  
            //Table present
            $sql = "select number FROM km_project 
			Where StrategyID = $StrategyId
            ORDER BY number DESC 
            LIMIT 1";
            $result = mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
              $numberProject = (string)$row['number'];
            }
            $number = "";
            if($numberProject == null || $numberProject == 0)
            {
                $numberStrategyID = 0;
                //Table Before 
                $sql = "select number FROM km_strategy where StrategyID = $StrategyId";
                $result = mysqli_query($link,$sql);
                while($row = mysqli_fetch_assoc($result))
                {
                  $numberStrategyID = (string)$row['number'];
                }       
                $numberProject = $numberProject + 1;            
                $str = (string)$numberStrategyID .'.'. (string)$numberProject;
                $number = $str;
                //echo $result_number;
            }else {  
                    $integerIDs = array_map('intval', explode('.', $numberProject));
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
        $StrategyId = $_POST['Strategyid'];

        $datetime = date('Y-m-d H:i:s');
        $sql = "";
        if($id == 0)
        { //INSERT

            $number = _getNumber($StrategyId,$link);
          //  echo  $number; exit();

            $sql = "INSERT INTO km_project (StrategyID,Name,AgencyID,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn,Number)
            VALUES ('".$StrategyId."','".$name."','".$agencyId."','1','".$userid."','".$datetime."','".$userid."','".$datetime."','".$number."');";          
            //echo $sql; exit();
        }else{
            //Update
            //echo $id; exit();
            $sql = "UPDATE  km_project
            SET Name = '$name',StrategyID = $StrategyId
            WHERE ProjectID = $id";
        }
        mysqli_query($link,$sql);
        mysqli_close($link);
        header("location: ../project.php");

    }

?>