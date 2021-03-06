<?php
 session_start();
 
$_SESSION['agencylistid'] = [];

$data = json_decode(stripslashes($_POST['data']));

  $_SESSION['agencylistid'] = $data;

  echo "success";
?>