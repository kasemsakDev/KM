<?php 

   header('Content-Type: application/json');
   $link = @mysqli_connect("localhost","root","","pmqa") or die(mysqli_connect_error());
   $link->set_charset("utf8");

   $sql = "SELECT AgencyID,Name FROM IsActive = 1";
   $query = mysqli_query($link,$sql);
   $resultArray = array();
   while($result = mysqli_fetch_assoc($query,MYSQLI_ASSOC))
   {
       array_push($resultArray,$result);
   }
   mysqli_close($link);
   echo json_encode($resultArray);

?>