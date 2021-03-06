<?php 
session_start();
ob_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
	header("location: index.php");
	exit();
}

if($_SESSION["IsManager"] == 1) {
    header("location: logout.php");
	exit();
 }


//get role  get agency


require_once "dblink.php";

$sql_role = "";
$sql_agency = "";
if($_SESSION["Rolename"] == 'superadmin' || $_SESSION["Rolename"] == 'Programmer') {
$sql_role = "SELECT * FROM km_role Where IsActive = 1";
$sql_agency = "SELECT * FROM km_agency Where IsActive = 1";
}else{
    $agencyID = $_SESSION["AgencyID"];
    $sql_role = "SELECT * FROM km_role Where IsActive = 1 AND km_role.Name = 'Admin'";
    $sql_agency = "SELECT * FROM km_agency Where IsActive = 1 AND km_agency.AgencyID = $agencyID";
}
$result_role = mysqli_query($link,$sql_role);
$result_agency = mysqli_query($link,$sql_agency);
$row_role = array();
while($row = mysqli_fetch_assoc($result_role))
{
    $row_role[] = $row;
}
$row_agency = array();
while($row = mysqli_fetch_assoc($result_agency))
{
    $row_agency[] = $row;
}

$user = array();
$user[0]['UserID'] = 0;
$user[0]['AgencyID'] = 0;
$user[0]['RoleID'] = 0;
$user[0]['Name'] = "";



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sql_Edit = "SELECT UserID,AgencyID,RoleID,Name FROM km_user Where UserID = $id";
        $result_user = mysqli_query($link,$sql_Edit);
        $user = [];
        while ($row = mysqli_fetch_assoc($result_user)) {
            $user[] = $row;
        }

    }
}

mysqli_close($link);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />


    <link href="Content/template/css/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="Content/template/css/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="Content/template/css/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="Content/template/css/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="Content/template/assets/media/k.png" />
    <!--end::Fonts ~/ -->
    <!--begin::Page Vendors Styles(used by this page)-->
</head>
  
  <body>





  
    <!--begin::Header-->
    <div id="kt_header" class="header flex-column header-fixed">
        <!--begin::Top-->
        <div class="header-top">
            <!--begin::Container-->
            <div class="container">
            
                <!--begin::Left-->
                <div class="d-none d-lg-flex align-items-center mr-3">
                    <!--begin::Logo-->
                    <a href="index.html" class="mr-20">
                    <i class="fab fa-battle-net text-danger mr-5 icon-4x"></i>
                    </a>
                    <!--end::Logo-->
                    <!--begin::Tab Navs(for desktop mode)-->
                    <ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
                        <!--begin::Item-->
                        <?php if($_SESSION["IsSupperAdmin"] != 1 ){ ?>  
                        <li class="nav-item">
                            <a href="#" class="nav-link py-4 px-6 active" data-toggle="tab" data-target="#kt_header_tab_1" role="tab">Manage</a>
                        </li>
                        <?php } ?>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 ){ ?>
                        <li class="nav-item mr-3">
                        <a href="report.php" class="nav-link py-4 px-6" >Reports</a>
                        </li>
                        <?php } ?>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <?php if($_SESSION["IsManager"] != 1) { ?>
                        <li class="nav-item mr-3">
                            <a href="#" class="nav-link py-4 px-6" data-toggle="tab" data-target="#kt_header_tab_3" role="tab">User</a>
                        </li>
                        <?php }  ?>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <!--end::Item-->
                    </ul>
                    <!--begin::Tab Navs-->
                </div>
                <!--end::Left-->
                <!--begin::Topbar-->
                <div class="topbar bg-primary">
                    <!--begin::Search-->
                    <div class="dropdown">
                        <!--begin::Toggle-->
                        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                            <div class="btn btn-icon btn-hover-transparent-white btn-lg btn-dropdown mr-1">
                                <span class="svg-icon svg-icon-xl">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->

                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                        </div>

                    </div>

                    <!--end::Chat-->
                    <!--begin::User-->
                    <div class="topbar-item">
                        <div class="btn btn-icon btn-hover-transparent-white w-sm-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                            <div class="d-flex flex-column text-right pr-sm-3">
                            <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){ ?>
                                <span class="text-white font-weight-bolder font-size-sm d-none d-sm-inline"><?php echo $_SESSION["Name"]; ?></span>
                                <?php } ?>
                            </div>                                                                                
                        </div>
                        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){ ?>
                        <a href="logout.php" > <button class="btn btn-success">Logout</button></a>
                        <?php } ?>
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Topbar-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Top-->
        <!--begin::Bottom-->
        <div class="header-bottom">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Header Menu Wrapper-->
                <div class="header-navs header-navs-left" id="kt_header_navs">
                    <!--begin::Tab Navs(for tablet and mobile modes)-->
                    <ul class="header-tabs p-5 p-lg-0 d-flex d-lg-none nav nav-bold nav-tabs" role="tablist">
                        <!--begin::Item-->
                        <?php if($_SESSION["IsSupperAdmin"] != 1 ){ ?>  
                        <li class="nav-item mr-2">
                            <a href="#" class="nav-link btn btn-clean active" data-toggle="tab" data-target="#kt_header_tab_1" role="tab">Manage</a>
                        </li>
                        <?php } ?>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1){ ?>
                        <li class="nav-item mr-2">
                            <a href="#" class="nav-link btn btn-clean" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Reports</a>
                        </li>
                        <?php } ?>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item mr-2">
                            <a href="#" class="nav-link btn btn-clean" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Orders</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item mr-2">
                            <a href="#" class="nav-link btn btn-clean" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Help Ceter</a>
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--begin::Tab Navs-->
                    <!--begin::Tab Content-->
                    <div class="tab-content">
                        <!--begin::Tab Pane-->
                        <div class="tab-pane py-5 p-lg-0 show" id="kt_header_tab_1">
                            <!--begin::Menu-->
                            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                                <!--begin::Nav-->
                                <ul class="menu-nav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="issue.php" class="menu-link">
                                            <span class="menu-text">ประเด็นยุทธศาสตร์</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item " aria-haspopup="true">
                                        <a href="purpose.php" class="menu-link">
                                            <span class="menu-text">เป้าประสงค์</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="indicator.php" class="menu-link">
                                            <span class="menu-text">ตัวชีวัด-เป้าประสงค์</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item " aria-haspopup="true">
                                        <a href="strategy.php" class="menu-link">
                                            <span class="menu-text">กลยุทธ์ เป้าประสงค์</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item " aria-haspopup="true">
                                        <a href="project.php" class="menu-link">
                                            <span class="menu-text">โครงการ</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item " aria-haspopup="true">
                                        <a href="sunit.php" class="menu-link">
                                            <span class="menu-text">หน่วยส่งมอบผลงาน</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <!--end::Nav-->
                            </div>
                            <!--end::Menu-->
                        </div>
                        
                        <!--begin::Tab Pane-->
                        <!--begin::Tab Pane-->
                        <div class="tab-pane p-5 p-lg-0 justify-content-between" id="kt_header_tab_2">
                            <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center">
                                <!--begin::Actions-->
                                <a href="#" class="btn btn-light-success font-weight-bold mr-3 my-2 my-lg-0">List Strategy</a>
                                <a href="#" class="btn btn-light-primary font-weight-bold mr-3 my-lg-0">Reports Strategy</a>
                                <!--end::Actions-->
                            </div>
                     <!-- <div class="d-flex align-items-center">
                                begin::Actions
                                <a href="#" class="btn btn-danger font-weight-bold my-2 my-lg-0">Generate Reports</a>
                                
                            </div> -->
                        </div>
                        <div class="tab-pane p-5 p-lg-0 justify-content-between active" id="kt_header_tab_3">
                            <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center">
                                <!--begin::Actions-->
                                <a href="listuser.php" class="btn btn-light-success font-weight-bold mr-3 my-2 my-lg-0">List User</a>
                                <?php if($_SESSION["IsProgrammer"] == 1 ||  $_SESSION["IsSupperAdmin"] == 1){ ?>
                                <a href="listrole.php" class="btn btn-light-primary font-weight-bold mr-3 my-lg-0">List Role</a>
                                <a href="listagency.php" class="btn btn-light-info font-weight-bold my-2 my-lg-0">List Agency</a>
                                <?php } ?>
                                <!--end::Actions-->
                            </div>
                           <!-- <div class="d-flex align-items-center">
                                begin::Actions
                                <a href="#" class="btn btn-danger font-weight-bold my-2 my-lg-0">Generate Reports</a>
                                
                            </div> -->
                        </div>
                        <!--begin::Tab Pane-->
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end::Header Menu Wrapper-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Bottom-->
    </div>
  
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">



  
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Details-->
								<div class="d-flex align-items-center flex-wrap mr-2">
									<!--begin::Title-->
                                    <?php if($user[0]['UserID'] == 0){ ?>
                                        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Create User</h5>
                                   <?php }else{ ?>
                                       <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Edit User</h5>
                                  <?php  } ?>
									<!--end::Title-->
									<!--begin::Separator-->
									<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
									
								</div>

							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Card-->
								<div class="card card-custom gutter-b">
									<div class="card-body">
									
                        <div class="wizard wizard-1" id="kt_contact_add" data-wizard-state="first" data-wizard-clickable="true">
											<!--begin::Wizard Nav-->
					
											<!--end::Wizard Nav-->
											<!--begin::Wizard Body-->
											<div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
												<div class="col-xl-12 col-xxl-7">
													<!--begin::Form Wizard Form-->
													<form action="Manage/adduser.php" method="POST" class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_contact_add_form">
														<!--begin::Form Wizard Step 1-->
                                                        <input type="hidden" name="UserID" value="<?php echo $user[0]['UserID']  ?>">  
														<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
															<h3 class="mb-10 font-weight-bold text-dark">User's Profile Details:</h3>
															<div class="row">
																<div class="col-xl-12">
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">Name</label>
																		<div class="col-lg-9 col-xl-9">
																			<input class="form-control form-control-lg" name="name" type="text" name="name" value="<?php echo $user[0]['Name']  ?>" required autocomplete="off">
																		<div class="fv-plugins-message-container"></div></div>
																	</div>
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">Agency</label>
																		<div class="col-lg-9 col-xl-9">
                                                                <select class="form-control " id="" name="agencyId" required>
                                                               
																	<option value="">Select</option>
                                                                    <?php foreach($row_agency as $row){ ?>
                                                                        <?php if($row['AgencyID'] == $user[0]['AgencyID']){ ?>
                                                                            <option value="<?php echo $row['AgencyID']; ?>" selected><?php echo $row['Name']; ?></option>
                                                                        <?php }else { ?>
                                                                            <option value="<?php echo $row['AgencyID']; ?>"><?php echo $row['Name']; ?></option>
                                                                   <?php }} ?>
																</select>
																		<div class="fv-plugins-message-container"></div></div>
																	</div>
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">Role</label>
																		<div class="col-lg-9 col-xl-9">
                                                                <select class="form-control " id="" name="roleId" required>
																	<option value="">Select</option>
                                                                    <?php foreach($row_role as $row){ ?>
                                                                        <?php if($row['RoleID'] == $user[0]['RoleID']){ ?>
																	<option value="<?php echo $row['RoleID']; ?>" selected><?php echo $row['Name']; ?></option>
                                                                    <?php }else { ?>
                                                                    	<option value="<?php echo $row['RoleID']; ?>"><?php echo $row['Name']; ?></option>
                                                                   <?php }} ?>
																</select>
																		<div class="fv-plugins-message-container"></div></div>
																	</div>
                                                                    <?php if($user[0]['UserID'] == 0){ ?>
																	<div class="form-group row fv-plugins-icon-container">
																		<label class="col-xl-3 col-lg-3 col-form-label">Password</label>
																		<div class="col-lg-9 col-xl-9">
																			<div class="input-group input-group-lg input-group-solid">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-at"></i>
																					</span>
																				</div>
																				<input type="Password" class="form-control form-control-lg" name="password" value="admin1234" placeholder="Email" required>
																			</div>
																		<div class="fv-plugins-message-container"></div></div>
																	</div>
                                                                 <?php   }else{ ?>
                                                                    <input type="hidden" class="form-control form-control-lg" name="password" value=""  >
                                                                <?php } ?>
																	
																</div>
															</div>
														</div>
														<!--end::Form Wizard Step 1-->
														<!--begin::Form Wizard Step 2-->
														<div class="pb-5" data-wizard-type="step-content">
															<div class="row">
																<div class="col-xl-12">
																	<div class="form-group row">
																		<div class="col-lg-9 col-xl-6">
																			<h3 class="mb-10 font-weight-bold text-dark">User's Account Details</h3>
																		</div>
																	</div>
			
																</div>
															</div>
														</div>
														<div class="d-flex justify-content-between border-top pt-10">
															<div class="mr-2">
																<button type="button" class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
															</div>
															<div>
																<button type="submit" name="save" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" >Submit</button>
															</div>
														</div>
														<!--end::Wizard Actions-->
													<div></div><div></div><div></div></form>
													<!--end::Form Wizard Form-->
												</div>
											</div>
											<!--end::Wizard Body-->
										</div>
							
									</div>
								</div>
								<!--end::Card-->
								<!--begin::Modal-->
								<div class="modal fade" id="kt_datatable_records_fetch_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Selected Records</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true"></span>
												</button>
											</div>
											<div class="modal-body">
												<div class="kt-scroll scroll" data-scroll="true" data-height="200" style="height: 200px; overflow: auto;">
													<ul id="kt_apps_user_fetch_records_selected"></ul>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<!--end::Modal-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>






                        <!--begin::Footer-->
                        <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                        <!--begin::Container-->
                        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <!--begin::Copyright-->
                            <div class="text-dark order-2 order-md-1">
                                <span class="text-muted font-weight-bold mr-2">2021©</span>
                                <span class="text-dark-75 text-hover-primary">KM</span>
                            </div>
                        </div>
                        <!--end::Container-->
                    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Content/template/css/global/plugins.bundle.js"></script>
    <script src="Content/template/css/prismjs/prismjs.bundle.js"></script>
    <script src="Content/template/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="Content/template/js/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="Content/template/js/pages/html-table.js"></script>

    <script src="assets/js/pages/custom/contacts/list-datatable.js"></script>

                    </body>
                    <!--end::Footer-->
    <!--end::Header-->