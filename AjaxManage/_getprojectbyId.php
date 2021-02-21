<?php

header("Content-type: application/json");
if(isset($_POST['ajax_id']))
{
    
    require_once "../dblink.php";
    $id = $_POST['ajax_id'];
    $id_StrategyID = 0;
    $name = "";
    $mysql = mysqli_query($link,"SELECT StrategyID,Name FROM km_project Where ProjectID =  $id  AND IsActive = 1");
    while($row=mysqli_fetch_array($mysql))
    {
        $name = $row['Name'];
        $id_StrategyID = $row['StrategyID'];
    }
  //  echo $name;
    echo json_encode(array($id_StrategyID,$name));
}
?>