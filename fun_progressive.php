<?php

/*
  4  เครื่อง = ?%
---------------
  26 เครื่อง = 100%
---------------
  (4 เครื่อง * 100 %) / 26เครื่อง) คือจำนวนทั้งหมด
    == 15.4%
*/

function _progressiveProject($id,$link)
{
    $sql = "select sd.Progressive from km_project p
    inner JOIN km_sunit s on p.ProjectID = s.ProjectID
    inner join km_sunitdetail sd on s.SunitID = sd.SunitID
    WHERE p.ProjectID = $id
    ";
    $result =  mysqli_query($link,$sql);
    $tasks = 0;
    $total = 0;
    $progressive = 0;
    $array = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $array[] = $row['Progressive'];
    }
     if($array != [])
     {
         foreach($array as $row)
         {
            $tasks += $row;
            $total += 100;
         }
         $progressive = (float)(($tasks * 100) / $total);
     }
     return number_format($progressive, 2, '.', '');
}

function _progressiveStrategy($id,$link)
{
    $sql = "select sd.Progressive from km_strategy st
	inner JOIN	km_project p on st.StrategyID = p.StrategyID
    inner JOIN km_sunit s on p.ProjectID = s.ProjectID
    inner join km_sunitdetail sd on s.SunitID = sd.SunitID
    WHERE st.StrategyID = $id
    ";
    $result =  mysqli_query($link,$sql);
    $tasks = 0;
    $total = 0;
    $progressive = 0;
    $array = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $array[] = $row['Progressive'];
    }
     if($array != [])
     {
         foreach($array as $row)
         {
            $tasks += $row;
            $total += 100;
         }
         $progressive = (float)(($tasks * 100) / $total);
     }
     return number_format($progressive, 2, '.', '');
}

function _progressiveIndicator($id,$link)
{
    $sql = "select sd.Progressive from km_indicator i
	inner join	km_strategy st on i.IndicatorID = st.IndicatorID
	inner JOIN	km_project p on st.StrategyID = p.StrategyID
    inner JOIN km_sunit s on p.ProjectID = s.ProjectID
    inner join km_sunitdetail sd on s.SunitID = sd.SunitID
    WHERE i.IndicatorID = $id
    ";
    $result =  mysqli_query($link,$sql);
    $tasks = 0;
    $total = 0;
    $progressive = 0;
    $array = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $array[] = $row['Progressive'];
    }
     if($array != [])
     {
         foreach($array as $row)
         {
            $tasks += $row;
            $total += 100;
         }
         $progressive = (float)(($tasks * 100) / $total);
     }
     return number_format($progressive, 2, '.', '');
}

function _progressivePurpose($id,$link)
{
    $sql = "select sd.Progressive from km_purpose pu
	inner join	km_indicator i on pu.PurposeID = i.PurposeID
	inner join	km_strategy st on i.IndicatorID = st.IndicatorID
	inner JOIN	km_project p on st.StrategyID = p.StrategyID
    inner JOIN km_sunit s on p.ProjectID = s.ProjectID
    inner join km_sunitdetail sd on s.SunitID = sd.SunitID
    WHERE pu.PurposeID = $id
    ";
    $result =  mysqli_query($link,$sql);
    $tasks = 0;
    $total = 0;
    $progressive = 0;
    $array = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $array[] = $row['Progressive'];
    }
     if($array != [])
     {
         foreach($array as $row)
         {
            $tasks += $row;
            $total += 100;
         }
         $progressive = (float)(($tasks * 100) / $total);
     }
     return number_format($progressive, 2, '.', '');
}

function _progressiveIssue($id,$link)
{
    $sql = "select sd.Progressive from  km_issue iss
	inner join 	km_purpose pu on iss.IssueID = pu.IssueID
	inner join	km_indicator i on pu.PurposeID = i.PurposeID
	inner join	km_strategy st on i.IndicatorID = st.IndicatorID
	inner JOIN	km_project p on st.StrategyID = p.StrategyID
    inner JOIN km_sunit s on p.ProjectID = s.ProjectID
    inner join km_sunitdetail sd on s.SunitID = sd.SunitID
    WHERE iss.IssueID = $id
    ";
    $result =  mysqli_query($link,$sql);
    $tasks = 0;
    $total = 0;
    $progressive = 0;
    $array = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $array[] = $row['Progressive'];
    }
     if($array != [])
     {
         foreach($array as $row)
         {
            $tasks += $row;
            $total += 100;
         }
         $progressive = (float)(($tasks * 100) / $total);
     }
     return number_format($progressive, 2, '.', '');
}

?>