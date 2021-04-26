<?php
require_once "../dblink.php";
include("../fun_progressive.php");
header("Content-type: application/json");

$result = array();  //GET => id,name,progressive

$sql = "select * from km_agency WHERE km_agency.IsActive = 1 AND Name <> 'ผู้บริหาร'";
$sql_result =  mysqli_query($link,$sql);
$agency = array();
    while($row = mysqli_fetch_assoc($sql_result))
    {
        $agency[] = $row;
    }


if(count($agency) > 0){
    $resultprogressiveByagency = array();
    $num = 0;
    foreach ($agency as $value) {
       $id = intval($value['AgencyID']);
       $sql = "select km_issue.IssueID from km_issue
       where km_issue.IsActive = 1 AND km_issue.AgencyID = $id";
       $resultIssue =  mysqli_query($link,$sql);
       $_idissue = array(); 
       while($row = mysqli_fetch_assoc($resultIssue))
       {
           $_idissue[] = $row;
       }
       $totalagency = (count($_idissue) * 100);
       $arrylogIssue = array();
       $logprogressive = 0;
       $index = 0;
       foreach ($_idissue as $item) {
          // echo $item;exit();
        $idissue = intval($item['IssueID']);
        $_progressiveIssue = _progressiveIssue($idissue,$link);
        $arrylogIssue[] += $_progressiveIssue;  
        $index++;
       }
       $tasks = 0;
       $total = 0;
       $progressive = 0;
       if($arrylogIssue != [])
       {
           foreach($arrylogIssue as $row)
           {
              $tasks += $row;
              $total += 100;
           }
           $logprogressive = (float)(($tasks * 100) / $total);
       }

       $result[$num] = [
        'Id' => $id,
        'Name' => $value['Name'],
        'Progressive' => number_format($logprogressive , 2, '.', ''),
        'Count' => Count($_idissue)
    ];
    $num++;
    $arrylogIssue = [];
      }
}


//print_r($result);
//exit();


    echo json_encode($result);


?>