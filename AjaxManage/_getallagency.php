<?php

header("Content-type: application/json");

    
    require_once "../dblink.php";

    $return_arr = array();
    $mysql = mysqli_query($link,"select AgencyID,Name from km_agency where IsActive = 1 LIMIT 1");
    while($row=mysqli_fetch_array($mysql))
    {
      $return_arr[] = $row; 
    }

    // Encoding array in JSON format
    echo json_encode($return_arr);

?>