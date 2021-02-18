<?php

header("Content-type: application/json");
if(isset($_POST['ajax_id']))
{
    
    require_once "../dblink.php";
    $id = $_POST['ajax_id'];
    $id_issue = 0;
    $name = "";
    $mysql = mysqli_query($link,"SELECT IssueID,Name FROM km_purpose Where PurposeID =  $id  AND IsActive = 1");
    while($row=mysqli_fetch_array($mysql))
    {
        $name = $row['Name'];
        $id_issue = $row['IssueID'];
    }
  //  echo $name;
    echo json_encode(array($id_issue,$name));
}


?>