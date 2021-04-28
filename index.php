<?php

session_start();
ob_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: issue.php");
	exit();
}

require_once "dblink.php";




$username_err = $username = "";
$password_err = $password =  "";

//check username
if(isset($_POST['save'])){

	if(empty(trim($_POST["username"]))){
		$username_err = "Please enter username.";
	}else{

		$username = trim($_POST["username"]);
	}

if(empty(trim($_POST["password"]))){
	$password_err = "Please enter username.";
}else{
	$password = trim($_POST["password"]);
}

	if(empty($username_err) && empty($password_err)){

		$sql = "SELECT u.UserID,u.AgencyID,u.RoleID,u.Name as username,r.Name as rolename,a.Name as agencyname, u.IsActive,u.UpdateOn,a.IsActive,r.IsActive 
		,u.Password,u.IsManager,u.IsProgrammer,u.IsSupperAdmin,u.IsAdmin
		FROM km_user u left join
		km_role r on u.RoleID = r.RoleID 
		left join km_agency a on u.AgencyID = a.AgencyID 
		Where  u.Name = '$username' AND u.IsActive = 1";



		$stmt = mysqli_query($link,$sql);
				if(mysqli_num_rows($stmt) > 0){
					
					while($row = mysqli_fetch_assoc($stmt)){


						if(password_verify($password, $row["Password"]))  {


								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $row['UserID'];
								$_SESSION["Name"] = $row['username'];
								$_SESSION["AgencyID"] = $row['AgencyID'];
								$_SESSION["AgencyName"] = $row['agencyname'];
								$_SESSION["RoleID"] = $row['RoleID'];
								$_SESSION["Rolename"] = $row['rolename'];
								$_SESSION["IsAdmin"] = $row['IsAdmin'];
								$_SESSION["IsManager"] = $row['IsManager'];
								$_SESSION["IsProgrammer"] = $row['IsProgrammer'];
								$_SESSION["IsSupperAdmin"] = $row['IsSupperAdmin'];

								if($row['IsAdmin'] == 1){
									header("location: issue.php");
								}else if($row['IsManager'] == 1){
									header("location: report.php");
								}else if($row['IsProgrammer'] == 1){
									header("location: issue.php");
								}else if($row['IsSupperAdmin'] == 1){
									header("location: listuser.php");
								}
						}else {
							$passowrd_err = "passowrd not have in database";
							echo  "passowrd not have in database";
						}
					
					}

				}else{
					$username_err = "username not have in database";
				}				
		}
	}
	mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title>KM Login</title>
		<meta name="description" content="Login page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->

		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
        <link href="Content/template/css/css/pages/login/classic/login-4.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <link href="Content/template/css/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="Content/template/css/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="Content/template/css/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="Content/template/assets/media/k.png" />

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed header-bottom-enabled subheader-enabled page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
				<div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('Content/template/assets/media/bg-3.jpg');">
					<div class="login-form text-center p-7 position-relative overflow-hidden">
						<!--begin::Login Header-->
						<div class="d-flex flex-center mb-15">
							<a href="#">
								<img src="assets/media/logos/logo-letter-13.png" class="max-h-75px" alt="" />
							</a>
						</div>
						<!--end::Login Header-->
						<!--begin::Login Sign in form-->
						<div class="login-signin">
							<div class="mb-20">
								<h3>Sign In </h3>
								<div class="text-muted font-weight-bold"></div>
							</div>
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" id="kt_login_signin_form" method="POST">
								<div class="form-group mb-5">
									<input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Name" name="username" autocomplete="off" />
								</div>
								<div class="form-group mb-5">
									<input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
								</div>

								<button id="kt_login_signin_submit" type="submit" name="save" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>
							</form>
						</div>
					
		</div>
		<!--end::Main-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>

		<script src="assets/js/pages/custom/login/login-general.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Content/template/css/global/plugins.bundle.js"></script>
    <script src="Content/template/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="Content/template/js/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="Content/template/js/pages/login.js"></script>

		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>