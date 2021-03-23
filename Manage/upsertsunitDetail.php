<?php

session_start();
ob_start();

    require_once "../dblink.php";
    // create Detail
    $id = $_POST['Update_id'];


    function _getNumber($sunitID,$link)
    {
        $numberSunitDetail = 0;  
        //Table present
        $sql = "select number FROM km_sunitdetail 
        Where SunitID = $sunitID
        ORDER BY number DESC 
        LIMIT 1";
        $result = mysqli_query($link,$sql);
        while($row = mysqli_fetch_assoc($result))
        {
          $numberSunitDetail = (string)$row['number'];
        }
        $number = "";
        if($numberSunitDetail == null || $numberSunitDetail == 0)
        {
            $numberSunit = 0;
            //Table Before 
            $sql = "select number FROM km_sunit where SunitID = $sunitID";
            $result = mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
              $numberSunit = (string)$row['number'];
            }       
            $numberSunitDetail = $numberSunitDetail + 1;            
            $str = (string)$numberSunit .'.'. (string)$numberSunitDetail;
            $number = $str;
            //echo $result_number;
        }else {  
                $integerIDs = array_map('intval', explode('.', $numberSunitDetail));
                $_getindex = (count($integerIDs) - 1);
                $newData = $integerIDs[$_getindex] + 1;
                $integerIDs[$_getindex] = $newData;
                foreach($integerIDs as $row)
                {
                    $number .= (string)$row.'.';
                }
                $number = substr($number, 0, -1);
        }
        return $number;
    }

    $projectid = $_POST['Update_projectid'];
    $agencyid = $_POST['Update_agencyid'];
    $projecttext = $_POST['Update_projecttext'];
    $progressive = $_POST['Update_Progressive'];
    $name = $_POST['Update_Name'];
    $userid = $_SESSION["id"];
    $datetime = date('Y-m-d H:i:s');
    $number = _getNumber($id,$link);
     $sql = "INSERT INTO km_sunitdetail (SunitID,Name,Progressive,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn,Number)
    VALUES ('".$id."','".$name."','".$progressive."','1','".$userid."','".$datetime."','".$userid."','".$datetime."','".$number."');";          
     mysqli_query($link,$sql);
     $get_sunitdetail = "select SunitDetailID from km_sunitdetail
     WHERE SunitID = $id
     order by SunitDetailID DESC Limit 1";
     $resultIdDetail =   mysqli_query($link,$get_sunitdetail);
    //  echo      $get_sunitdetail; exit();
     $SunitDetailID = 0;
     while($row = mysqli_fetch_assoc($resultIdDetail))
    {
      $SunitDetailID = intval($row['SunitDetailID']);
    }
    for($i=0;$i<count($_FILES["filUpload"]["name"]);$i++)
{
    if($_FILES["filUpload"]["name"][$i] != "")
    {
    if(move_uploaded_file($_FILES["filUpload"]["tmp_name"][$i],"../Upload/".$_FILES["filUpload"]["name"][$i]))
    {
//*** Insert Record ***//
      $strSQL = "";
      $strSQL = "INSERT INTO km_upload ";
      $strSQL .="(SunitDetailID,FileName,FilePath,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn) VALUES ('".$SunitDetailID."','".$_FILES["filUpload"]["name"][$i]."','"."Upload/".$_FILES["filUpload"]["name"][$i]."','1','".$userid."','".$datetime."','".$userid."','".$datetime."')";
    //  echo $strSQL; exit();
      mysqli_query($link,$strSQL);
    }
  }
} 
    mysqli_close($link);
    header("location: ../sunit.php");

?>