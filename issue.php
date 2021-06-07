<?php

session_start();
ob_start();



if($_SESSION["IsSupperAdmin"] == 1) {
	header("location: logout.php");
	exit();
}

require_once "dblink.php";
include("DateThai.php");
include("fun_progressive.php");

//get list ประเด็ดยุทธศาสตร์


    $sql_year = "select * from km_year Where km_year.IsActive = 1 order by  km_year.YearName";
    $sql_resultyear =  mysqli_query($link,$sql_year);
    $allyear = array();
    while($row = mysqli_fetch_assoc($sql_resultyear))
        {
            $allyear[] = $row;
        } 
    $year = "";
    if(isset($_GET['year'])){
        $year = $_GET['year'];
    }else{
        $year = $allyear[0]['YearName'];
    }

    $agencyId = $_SESSION["AgencyID"];
    $sql_getIssue  = "";
    $issues = array();
    if($_SESSION["IsManager"] == 0 && $_SESSION["nonUse"] != true) {
    $Whereyear = 0;
    $Whereyear = ((int)$year-543);
    $sql_getIssue = "SELECT i.*,k.Name as Agencyname,k.AgencyID as K_AgencyID,k.IsActive as K_IsActive From km_issue i
    INNER JOIN km_agency k on k.AgencyID = i.AgencyID
    Where i.IsActive = 1 AND k.IsActive = 1 AND i.AgencyID = $agencyId AND YEAR(i.CreateOn) = '$Whereyear' 
    ORDER BY i.Number";
        $sql_resultIssue =  mysqli_query($link,$sql_getIssue);
        while($row = mysqli_fetch_assoc($sql_resultIssue))
        {
            $issues[] = $row;
        }
    }
    $_getId = 0;
    if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 || $_SESSION["nonUse"] == 1){ 
    if(isset($_GET['id']))
    {
        $Whereyear = 0;
        if(isset($_GET['year'])){
        $Whereyear = ((int)$_GET['year']-543);
        }
        $_getId = $_GET['id'];  
        $sql_getIssue = "SELECT i.*,k.Name as agency_name,k.AgencyID as K_AgencyID,k.IsActive as K_IsActive From km_issue i
        INNER JOIN km_agency k on k.AgencyID = i.AgencyID
        Where i.IsActive = 1 AND k.IsActive = 1 AND i.AgencyID = $_getId AND YEAR(i.CreateOn) = '$Whereyear' 
        ORDER BY i.Number ";
            $sql_resultIssue =  mysqli_query($link,$sql_getIssue);
            while($row = mysqli_fetch_assoc($sql_resultIssue))
            {
                $issues[] = $row;
            }
    }

}

    
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
    <link href="Content/template/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" />
    <link rel="shortcut icon" href="Content/template/assets/media/k.png" />
    <!--end::Fonts ~/ -->
    <!--begin::Page Vendors Styles(used by this page)-->
</head>
  
  <body id="kt_body" class="header-fixed header-mobile-fixed header-bottom-enabled page-loading">
    <!--begin::Header-->
    		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile bg-primary header-mobile-fixed">
			<!--begin::Logo-->
			<a href="index.html">
				<img alt="Logo" src="Content/template/assets/media/k.png" class="max-h-30px" />
			</a>
			<!--end::Logo-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
			</div>
			<!--end::Toolbar-->
		</div>

        
		<!--end::Header Mobile-->
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
                        <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 || $_SESSION["nonUse"] == true ){ ?>
                        <li class="nav-item mr-3">
                        <a href="report.php" class="nav-link py-4 px-6" >Reports</a>
                        </li>
                        <?php } ?>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <?php if($_SESSION["IsManager"] != 1 && $_SESSION["nonUse"] != true) { ?>
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
                        <a href="logout.php"> <button class="btn btn-success">Logout</button></a>
                        <?php }else { ?>
                        <a href="login.php"> <button class="btn btn-success">Login</button></a>
                      <?php  } ?>
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
                        <div class="tab-pane py-5 p-lg-0 show active" id="kt_header_tab_1">
                            <!--begin::Menu-->
                            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                                <!--begin::Nav-->
                                <ul class="menu-nav">
                                    <li class="menu-item menu-item-active" aria-haspopup="true">

                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 || $_SESSION["nonUse"] == true){ ?>
                                        <a href="<?php echo "issue.php?id=".$_getId."&year=".$year ?>" class="menu-link">
                                        <?php }else { ?>
                                            <a href="issue.php"class="menu-link">
                                        <?php } ?>
                                            <span class="menu-text" style="color:black">ประเด็นยุทธศาสตร์</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item " aria-haspopup="true">

                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 || $_SESSION["nonUse"] == true){ ?>
                                        <a href="<?php echo "purpose.php?id=".$_getId."&year=".$year ?>" class="menu-link">
                                        <?php }else { ?>
                                            <a href="purpose.php" class="menu-link">
                                        <?php } ?>
                                            <span class="menu-text" style="color:black">เป้าประสงค์</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item" aria-haspopup="true">
                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 || $_SESSION["nonUse"] == true){ ?>
                                        <a href="<?php echo "indicator.php?id=".$_getId."&year=".$year ?>" class="menu-link">
                                        <?php }else { ?>
                                        <a href="indicator.php" class="menu-link">
                                        <?php } ?>
                                            <span class="menu-text" style="color:black">ตัวชีวัด-เป้าประสงค์</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item " aria-haspopup="true">
                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 || $_SESSION["nonUse"] == true){ ?>
                                        <a href="<?php echo "strategy.php?id=".$_getId."&year=".$year ?>" class="menu-link">
                                        <?php }else { ?>
                                        <a href="strategy.php" class="menu-link">
                                        <?php } ?>
                                            <span class="menu-text" style="color:black">กลยุทธ์ เป้าประสงค์</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item " aria-haspopup="true">
                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 || $_SESSION["nonUse"] == true){ ?>
                                        <a href="<?php echo "project.php?id=".$_getId."&year=".$year ?>" class="menu-link">
                                        <?php }else { ?>
                                        <a href="project.php" class="menu-link">
                                        <?php } ?>
                                            <span class="menu-text" style="color:black">โครงการ</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item " aria-haspopup="true">
                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 || $_SESSION["nonUse"] == true){ ?>
                                        <a href="<?php echo "sunit.php?id=".$_getId."&year=".$year ?>" class="menu-link">
                                        <?php }else{ ?>
                                        <a href="sunit.php" class="menu-link">
                                        <?php } ?>
                                            <span class="menu-text" style="color:black">หน่วยส่งมอบผลงาน</span>
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
                        <div class="tab-pane p-5 p-lg-0 justify-content-between" id="kt_header_tab_3">
                            <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center">
                                <!--begin::Actions-->
                                <a href="listuser.php" class="btn btn-light-success font-weight-bold mr-3 my-2 my-lg-0">List User</a>
                                <?php if($_SESSION["IsProgrammer"] == 1 ||  $_SESSION["IsSupperAdmin"] == 1){ ?>
                                <a href="listrole.php" class="btn btn-light-primary font-weight-bold mr-3 my-lg-0">List Role</a>
                                <a href="listagency.php" class="btn btn-light-info font-weight-bold my-2 my-lg-0">List Agency</a>
                                <?php } ?>
                                <?php ?>
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

  <br><br><br>
  <br><br><br> <br><br><br><br><br>
    <div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">

    <div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
											<h3 class="card-label">ประเด็นยุทธศาสตร์
											<span class="d-block text-muted pt-2 font-size-sm">กำหนดประเด็นยุทธศาสตร์</span></h3>
										</div>
										<div class="card-toolbar">
                                            <?php if($_SESSION["IsManager"] == 0 && $_SESSION["nonUse"] != true){ ?>
                                          
                                            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModalSizeLg">สร้าง ประเด็นยุทธศาสตร์</button>
                                            <?php } ?>
											<!--end::Button-->
										</div>
									</div>
									<div class="card-body">
                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 || $_SESSION["nonUse"] == true){
                                        
                                        $sql_allAgency = "select AgencyID,Name from km_agency Where km_agency.IsActive = 1 AND  km_agency.Name <> 'ผู้บริหาร'";
                                        $sql_resultIssue =  mysqli_query($link,$sql_allAgency);
                                        $allAgency = array();
                                        while($row = mysqli_fetch_assoc($sql_resultIssue))
                                        {
                                            $allAgency[] = $row;
                                        }                                            
                                        ?>
                                            <br>
                                      <label for="cars">ค้นหาหน่วยงาน : </label>
                                        <select id="selectAllAgency" class="form-control col-md-6" onchange="selectsearch()">
                                            <option value="0" >=========================Select=======================</option>
                                        <?php foreach ($allAgency as $value) { ?>
                                            <?php if($_getId == $value['AgencyID']){ ?>
                                            <option value="<?php echo $value['AgencyID'] ?>" selected><?php echo $value['Name'] ?></option>
                                            <?php }else { ?>
                                            <option value="<?php echo $value['AgencyID'] ?>"><?php echo $value['Name'] ?></option> 
                                            <?php } ?>
                                            <?php } ?>
                                        </select>  
                                        <br>
                                        <label for="cars">ค้นหาปี : </label>
                                        <select id="selectyear" class="form-control col-md-2" onchange="selectyear()">
                                        <?php foreach ($allyear as $value) { ?>
                                            <?php if($year == $value['YearName']){ ?>
                                            <option value="<?php echo $value['YearID'] ?>" selected><?php echo $value['YearName'] ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $value['YearID'] ?>"><?php echo $value['YearName'] ?></option>
                                            <?php } ?>
                                        </select>                                                                    
                                            <br>
                                            <?php }  ?>
                                      <?php }  ?>
                                      <table class="table table-separate table-head-custom" id="tbI">
                                      <thead>
												<tr>
													<th>Number</th>
													<th>ประเด็นยุทธศาสตร์</th>
													<th>Progressive</th>			
													<th>Agency</th>
                                                    <th> Date</th>
                                                    <?php if($_SESSION["IsManager"] == 0 && $_SESSION["nonUse"] != true){ ?>
                                                    <th>Action</th>
                                                    <?php } ?>                                              
												</tr>
											</thead>
											<tbody>                        
                                            <?php foreach($issues as $row){ ?>
												<tr>
													<td><?php  echo $row['Number']  ?></td>
													<td><?php echo $row['Name'] ?></td>
                                                    <td><?php echo _progressivePurpose($row['IssueID'],$link).'%'; ?></td>																										
                                                    <td><?php echo $row['agency_name'] ?></td>                                   
                                                <td><?php echo DateThai($row['UpdateOn']) ?></td>
                                                <td>
                                                <?php if($_SESSION["IsManager"] == 0 && $_SESSION["nonUse"] != true){ ?>
                                                    <button type="button"  class="btn btn-primary" 
                                                    onClick="onclick_issue(<?php echo $row['IssueID'];  ?>)" data-toggle="modal" data-target="#exampleModal" >
                                                        Edit
                                                    </button>
                                                    <button  class="btn btn-danger" onclick="deleteIssue(<?php echo $row['IssueID']; ?>,<?php echo $agencyId ?>)">Delete</button>
                                                    </td>
                                                <?php } ?>
												</tr>
                                                <?php  } ?>
												
											</tbody>
										</table>
										<!--end: Datatable-->
									</div>
								</div>

</div>
</div>


<!-- Modal-->
<!--
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขประเด็นยุทธศาสตร์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" style="height: 300px;">
                <div class="row">
                <div class="col-md-3"></div>
                <input type="text" class="form control" value="Land Rover" >
                
                
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold">Save changes</button>
            </div>
        </div>
    </div>
</div> -->

<form action="Manage/upsertissue.php" method="POST">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">อัตเดท ประเด็นยุทธศาสตร์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
          
                <div class="modal-body">
                <input type="hidden" name="id" id="ajaxid" value="0">
                <input type="hidden" name="agencyid" value="<?php echo $agencyId;  ?>">
                <div class="form-group row">
				<label class="col-2 col-form-label">หัวข้อ : </label>
				<div class="col-10">
				<input class="form-control" type="text" name="name" value="" id="editname"   required autocomplete="off"/>
				</div>
				</div>
                          

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" name="save" class="btn btn-primary font-weight-bold">Save changes</button>
            </div>
        </div>
    </div>
</div>
</form>

<form action="Manage/upsertissue.php" method="POST">
<div class="modal fade" id="exampleModalSizeLg" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">สร้าง ประเด็นยุทธศาสตร์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="0">
                <input type="hidden" name="agencyid" value="<?php echo $agencyId;  ?>">
                <div class="form-group row">
				<label class="col-2 col-form-label">หัวข้อ : </label>
				<div class="col-10">
				<input class="form-control" type="text" name="name" value="" id="example-text-input"  required autocomplete="off"/>
				</div>
				</div>
                          
                </div>
                
   
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" name="save" class="btn btn-primary font-weight-bold">Save changes</button>
            </div>
        </div>
    </div>
</div>
</form>

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
   
    <script src="Content/template/plugins/custom/datatables/datatables.bundle.js"></script>


    <script>
    function onclick_issue(value)
    {
        document.getElementById("editname").value = "";
        document.getElementById("ajaxid").value = 0;
    $.ajax({
        type: 'post',
        url: 'AjaxManage/_getissuebyId.php',
        data: {
        ajax_id:value
    },
 success: function (response) {
     console.log(response);
     //ajaxid

     document.getElementById("ajaxid").value = value;
     document.getElementById("editname").value = response; 
    }
 });

    }

    </script>
    <script>
        $(document).ready(function () {
            var table = $('#tbI').DataTable({

                columns: [
                    { data: 'Number' },
                    { data: 'ประเด็นยุทธศาสตร์' },
                    { data: 'Progressive' },
                    { data: 'Agency' },
                    { data: 'Date' },
                    { data: 'Action' }
                ],
                "Number": [[ 0, "ASC" ]]
            });
        });

       function selectsearch() {
        var year = $( "#selectyear option:selected" ).text();
        //alert(year);
        var e = document.getElementById("selectAllAgency");
        var value = e.value;
        window.location.href = 'issue.php?id='+value+'&year='+year;
        }

        function selectyear(){
            var year = $( "#selectyear option:selected" ).text();
            var e = document.getElementById("selectAllAgency");
            var value = e.value;
            window.location.href = 'issue.php?id='+value+'&year='+year;
        }

        function deleteIssue(id,payload) {
          if(!confirm('Are you sure?')){
            e.preventDefault();
            return false;
        }
          window.location.href = 'Manage/delete.php?id='+id+'&action=issue&payload='+payload;
        }

    </script>                                          

                    </body>
                    <!--end::Footer-->
    <!--end::Header-->