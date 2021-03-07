<?php

header("Content-type: application/json");

if(isset($_POST['ajax_id']))
{
    require_once "../dblink.php";
    $id = $_POST['ajax_id'];
    $sql = "select Progressive FROM km_sunitdetail
    where SunitID = $id";
    $result =  mysqli_query($link,$sql);
    $_progressive = 0;
    while($row = mysqli_fetch_assoc($result))
    {
    $_progressive =  ((int)$_progressive + (int)$row['Progressive']);
    }
        echo $_progressive;
    mysqli_close($link);
}
?>