<?php

header("Content-type: application/json");

if(isset($_POST['ajax_id']))
{
    require_once "../dblink.php";
    $id = $_POST['ajax_id'];
    $return_arr = array();
    $mysql = mysqli_query($link,"SELECT k.SunitID,k.ProjectID,k.Name,p.Name as ProjectName From km_sunit  k
    inner join km_project p on k.ProjectID = p.ProjectID
    where SunitID = $id");

    while($row=mysqli_fetch_array($mysql))
    {
      $return_arr[] = $row; 
    }

    // Encoding array in JSON format
    echo json_encode($return_arr);
}
?>