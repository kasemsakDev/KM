<?php
session_start();
ob_start();
require_once "dblink.php";

	$_SESSION["loggedin"] = false;
	$_SESSION["id"] = 0;
	$_SESSION["Name"] = '';
	$_SESSION["AgencyID"] = 0;
	$_SESSION["AgencyName"] = '';
	$_SESSION["RoleID"] = 0;
	$_SESSION["Rolename"] = '';
	$_SESSION["IsAdmin"] = false;
	$_SESSION["IsManager"] = false;
	$_SESSION["IsProgrammer"] = false;
	$_SESSION["IsSupperAdmin"] = false;
	$_SESSION["nonUse"] = true;
	header("location: issue.php");	
