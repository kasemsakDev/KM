<?php
include("dblink.php");

$_masterNumber = ""; //เลขตั้งต้น เวลาจะบันทึกลงฐานข้อมูลของ km_sunitdetail จะเป็น => $_masterNumber.newNumber.Tostring();
$_getNumber = "select Number  FROM km_sunit  Where SunitID = 44";
$sql_result =  mysqli_query($link,$_getNumber);
while($row = mysqli_fetch_assoc($sql_result))
{
    $_masterNumber = $row['Number'];
}

$_sunitdetail = array();
$_getsunudetail = "select SunitDetailID,UpdateOn from km_sunitdetail Where SunitID = 44 order by UpdateOn asc";
$sql_ResultSunuDetail =  mysqli_query($link,$_getsunudetail);
while($row = mysqli_fetch_assoc($sql_ResultSunuDetail))
{
    $_sunitdetail[] = $row;
}

//_get Data km_sunitdetail and loop update Table newnumber $_masterNumber.newNumber.Tostring(); เรียกตามวันที่ล่าสุดไปหลังสุด
$_newNumber = 0;
$_newDataNumber = "";
foreach ($_sunitdetail as $value) {
    $_newNumber++;
    $_newDataNumber = (string)$_masterNumber .'.'. (string)$_newNumber;

    $id = $value['SunitDetailID'];
    $sql = "UPDATE km_sunitdetail
    SET Number = '$_newDataNumber'
    WHERE SunitDetailID=$id";
    mysqli_query($link,$sql);
  }

  echo 'success';
  exit();


?>