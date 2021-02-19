<?php

header("Content-type: application/json");
if(isset($_POST['ajax_id']))
{
    
    require_once "../dblink.php";
    $id = $_POST['ajax_id'];
    $id_purpose = 0;
    $name = "";
    $mysql = mysqli_query($link,"SELECT PurposeID,Name FROM km_indicator Where IndicatorID =  $id  AND IsActive = 1");
    while($row=mysqli_fetch_array($mysql))
    {
        $name = $row['Name'];
        $id_purpose = $row['PurposeID'];
    }
  //  echo $name;
    echo json_encode(array($id_purpose,$name));
}


?>