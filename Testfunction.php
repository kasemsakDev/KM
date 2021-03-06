<?php


session_start();
ob_start();

require_once "dblink.php";
include("DateThai.php");

$sql_getsunit = "SELECT s.*,a.Name as Agency_name,a.AgencyID as a_AgencyID,a.IsActive as a_IsActive 
From km_sunit s
INNER JOIN  km_project p on p.ProjectID = s.ProjectID 
INNER JOIN  km_agency a on p.AgencyID = a.AgencyID
Where s.IsActive = 1 AND a.IsActive = 1 AND s.AgencyID = 1 AND p.IsActive = 1";
$sql_resultsunit =  mysqli_query($link,$sql_getsunit);

$sunits = array();
while($row = mysqli_fetch_assoc($sql_resultsunit))
{
    $sunits[] = $row;
}


$listname_agency = array();

    $integerIDs = array_map('intval', explode(',', $sunits[0]['AgencyList']));
   // print_r($integerIDs);exit();

foreach($integerIDs as $item)
{
   $agency_nameValue = "SELECT Name FROM km_agency WHERE IsActive  = 1 AND AgencyID = $item";        
   $result = mysqli_query($link,$agency_nameValue);      
   while($row = mysqli_fetch_assoc($result))
   {
       $listname_agency[] = $row;
   }
}
   //print_r($listname_agency); exit();
   $strragency = "";
   if(count($listname_agency) >  0)
   {
       foreach($listname_agency as $item){
        $strragency .= $item['Name']."<br>";
       }
   }

   echo $strragency; 

?>