<?php

header("Content-type: application/json");
if(isset($_POST['ajax_id']))
{
    
    require_once "../dblink.php";
    $id = $_POST['ajax_id'];
    $id_indicatorID = 0;
    $name = "";
    $mysql = mysqli_query($link,"SELECT IndicatorID,Name FROM km_strategy Where StrategyID =  $id  AND IsActive = 1");
    while($row=mysqli_fetch_array($mysql))
    {
        $name = $row['Name'];
        $id_indicatorID = $row['IndicatorID'];
    }
  //  echo $name;
    echo json_encode(array($id_indicatorID,$name));
}


?>