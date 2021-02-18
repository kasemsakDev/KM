<?php

if(isset($_POST['ajax_id']))
{
    require_once "../dblink.php";
    $id = $_POST['ajax_id'];
    $name = "";
    $mysql = mysqli_query($link,"SELECT Name FROM km_issue Where IssueID =  $id  AND IsActive = 1");
    while($row=mysqli_fetch_array($mysql))
    {
        $name = $row['Name'];
    }
    echo $name;
}


?>