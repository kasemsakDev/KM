<?php
session_start();
ob_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
	header("location: index.php");
	exit();
}

if($_SESSION["IsSupperAdmin"] == 1){
	header("location: logout.php");
	exit();
}


require_once "dblink.php";
include("DateThai.php");
include("fun_progressive.php");

//get list Project

$agencyId = $_SESSION["AgencyID"];
$sql_getproject  = "";
$projects = array();
$sql_liststrategy = "";
$liststrategy = array();
if($_SESSION["IsManager"] == 0 ) {
$sql_getproject = "SELECT p.*,a.Name as Agencyname,a.AgencyID as a_AgencyID,a.IsActive as a_IsActive From km_project p
INNER JOIN  km_agency a on p.AgencyID = a.AgencyID
INNER JOIN  km_strategy s on p.StrategyID = s.StrategyID 
Where p.IsActive = 1 AND a.IsActive = 1 AND p.AgencyID = $agencyId AND s.IsActive = 1";
$sql_resultproject =  mysqli_query($link,$sql_getproject);

while($row = mysqli_fetch_assoc($sql_resultproject))
{
    $projects[] = $row;
}
//get indicator
$sql_liststrategy = "SELECT StrategyID,Name,AgencyID FROM km_strategy WHERE IsActive  = 1 AND AgencyID = $agencyId";
$result_lisstrategy = mysqli_query($link,$sql_liststrategy);


while($row = mysqli_fetch_assoc($result_lisstrategy))
{
    $liststrategy[] = $row;
}

}
$_getId = 0;
if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 ){ 
if(isset($_GET['id']))
{
    $_getId = $_GET['id'];  
    $sql_getproject = "SELECT p.*,a.Name as Agencyname,a.AgencyID as a_AgencyID,a.IsActive as a_IsActive From km_project p
    INNER JOIN  km_agency a on p.AgencyID = a.AgencyID
    INNER JOIN  km_strategy s on p.StrategyID = s.StrategyID 
    Where p.IsActive = 1 AND a.IsActive = 1 AND p.AgencyID = $_getId AND s.IsActive = 1";
    $sql_resultproject =  mysqli_query($link,$sql_getproject);
    
    while($row = mysqli_fetch_assoc($sql_resultproject))
    {
        $projects[] = $row;
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
                        <div class="tab-pane py-5 p-lg-0 show active" id="kt_header_tab_1">
                            <!--begin::Menu-->
                            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                                <!--begin::Nav-->
                                <ul class="menu-nav">
                                    <li class="menu-item" aria-haspopup="true">
                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 ){ ?>
                                        <a href="<?php echo "issue.php?id=".$_getId?>" class="menu-link">
                                        <?php }else { ?>
                                            <a href="issue.php"class="menu-link">
                                        <?php } ?>
                                            <span class="menu-text">ประเด็นยุทธศาสตร์</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item" aria-haspopup="true">

                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 ){ ?>
                                        <a href="<?php echo "purpose.php?id=".$_getId?>" class="menu-link">
                                        <?php }else { ?>
                                            <a href="purpose.php" class="menu-link">
                                        <?php } ?>
                                            <span class="menu-text">เป้าประสงค์</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item" aria-haspopup="true">
                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 ){ ?>
                                        <a href="<?php echo "indicator.php?id=".$_getId?>" class="menu-link">
                                        <?php }else { ?>
                                        <a href="indicator.php" class="menu-link">
                                        <?php } ?>
                                            <span class="menu-text">ตัวชีวัด-เป้าประสงค์</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item" aria-haspopup="true">
                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 ){ ?>
                                        <a href="<?php echo "strategy.php?id=".$_getId?>" class="menu-link">
                                        <?php }else { ?>
                                        <a href="strategy.php" class="menu-link">
                                        <?php } ?>
                                            <span class="menu-text">กลยุทธ์ เป้าประสงค์</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item menu-item-active" aria-haspopup="true">
                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 ){ ?>
                                        <a href="<?php echo "project.php?id=".$_getId?>" class="menu-link">
                                        <?php }else { ?>
                                        <a href="project.php" class="menu-link">
                                        <?php } ?>
                                            <span class="menu-text">โครงการ</span>
                                        </a>
                                    </li>                         
                                </ul>
                                <ul class="menu-nav">
                                    <li class="menu-item " aria-haspopup="true">
                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 ){ ?>
                                        <a href="<?php echo "sunit.php?id=".$_getId?>" class="menu-link">
                                        <?php }else{ ?>
                                        <a href="sunit.php" class="menu-link">
                                        <?php } ?>
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
                        <div class="tab-pane p-5 p-lg-0 justify-content-between" id="kt_header_tab_3">
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
        <!--end::Bottom-->
    </div>
  
  <br><br><br>
    <div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">

    <div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
											<h3 class="card-label">โครงการ
											<span class="d-block text-muted pt-2 font-size-sm">กำหนดโครงการ</span></h3>
										</div>
										<div class="card-toolbar">
											<!--begin::Dropdown-->

											<!--end::Dropdown-->
											<!--begin::Button-->
                                            <?php if($_SESSION["IsManager"] == 0){ ?>
                                            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModalSizeLg">สร้าง โครงการ</button>
                                            <?php } ?>
											<!--end::Button-->
										</div>
									</div>
									<div class="card-body">
                                    <?php if($_SESSION["IsManager"] == 1 ||  $_SESSION["IsProgrammer"] == 1 ){
                                        
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
                                            <br>
                                      <?php }  ?>
										<div class="mb-7">
											<div class="row align-items-center">
												<div class="col-lg-9 col-xl-8">
													<div class="row align-items-center">
														<div class="col-md-4 my-2 my-md-0">
															<div class="input-icon">
																<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
																<span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
															</div>
														</div>

                                                        <div class="col-md-4 my-2 my-md-0">
                                                        </div>
													</div>
												</div>

											</div>
										</div>
										<!--end::Search Form-->
										<!--end: Search Form-->
										<!--begin: Datatable-->
                                        <table class="table table-separate table-head-custom" id="tbI">
											<thead>
												<tr>
													<th>Number</th>
													<th>โครงการ</th>
													<th>Progressive</th>			
													<th>Agency</th>
                                                    <th>Date</th>
                                                    <?php if($_SESSION["IsManager"] == 0){ ?>
                                                    <th>Action</th>                          
                                                    <?php } ?>                                                                        
												</tr>
											</thead>
											<tbody>

                                            <?php
                                                $num = 1;
                                                
                                            ?>
                                                <?php foreach($projects as $row){ ?>
												<tr>
													<td><?php echo $row['Number'] ?></td>
													<td><?php echo $row['Name'] ?></td>
													<td><?php echo _progressiveProject($row['ProjectID'],$link).'%'; ?></td>																								
													<td><?php echo $row['Agencyname'] ?></td>
                                                    <td><?php echo DateThai($row['UpdateOn']) ?></td>  
                                                    <?php if($_SESSION["IsManager"] == 0){ ?>
                                                    <td><button type="button" class="btn btn-primary" 
                                                    data-toggle="modal" data-target="#exampleModal" 
                                                    onClick="onclick_Edit(<?php echo $row['ProjectID'];  ?>)">
                                                    Edit
                                                    </button>
                                                    <button  class="btn btn-danger" onclick="deleteProject(<?php echo $row['ProjectID']; ?>,<?php echo $row['StrategyID']; ?> )">Delete</button>
                                                    </td>
                                                        <?php } ?>                                    
												</tr>
                                                <?php  }  ?>
											</tbody>
										</table>
										<!--end: Datatable-->
									</div>
								</div>

</div>
</div>

<form action="Manage/upsertproject.php" method="POST" id="postEdit">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไข โครงการ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="id" id="ajaxid">
            <input type="hidden" name="agencyid" value="<?php echo $agencyId;  ?>">   
            <div class="form-group row">
            <label class="col-3 col-form-label">กลยุทธ์-เป้าประสงค์ : </label>
            <div class="col-9">
            <select class="form-control" name="Strategyid" id="StrategyID" required disabled>
															<option value = "">Select</option>
                                                            <?php foreach($liststrategy as $row){ ?>
                                                            <option value="<?php echo $row["StrategyID"]  ?>"><?php echo $row["Name"]   ?></option>
                                                            <?php } ?>
														</select>
													</div>
                                                    </div>
                <div class="form-group row">
				<label class="col-2 col-form-label">หัวข้อ : </label>
				<div class="col-10">
				<input class="form-control" type="text" value="" id="editname" name="name" required autocomplete="off"/>
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


<!-- create -->
<form action="Manage/upsertproject.php" method="POST">
<div class="modal fade" id="exampleModalSizeLg" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">สร้าง โครงการ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="id" id="idcreate" value="0">
            <input type="hidden" name="agencyid" value="<?php echo $agencyId;  ?>">   
            <div class="form-group row">
            <label class="col-3 col-form-label">กลยุทธ์-เป้าประสงค์ : </label>
            <div class="col-9">
                                                        <select class="form-control" name="Strategyid" id="StrategyID" required>
															<option value = "">Select</option>
                                                            <?php foreach($liststrategy as $row){ ?>
                                                            <option value="<?php echo $row["StrategyID"]  ?>"><?php echo $row["Name"]   ?></option>
                                                            <?php } ?>
														</select>
													</div>
                                                    </div>
                
                <div class="form-group row">
				<label class="col-2 col-form-label">หัวข้อ : </label>
				<div class="col-10">
				<input class="form-control" type="text" value="" id="example-text-input"  name="name" required  autocomplete="off"/>
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
    function onclick_Edit(value)
    {
        console.log(value);
        document.getElementById("StrategyID").value = "";
        document.getElementById("ajaxid").value = 0;
    $.ajax({
        type: 'post',
        url: 'AjaxManage/_getprojectbyId.php',
        data: {
        ajax_id:value
    },
 success: function (response) {
     console.log(response);
     //ajaxid
          /*
    response[0] // first $sup variable
    response[1] // second $second_var variable
     */
    
     document.getElementById("ajaxid").value = value;
     document.getElementById("StrategyID").value = response[0];
     document.getElementById("editname").value = response[1]; 
    }
 });

    }
</script>
<script>
        $(document).ready(function () {
            var table = $('#tbI').DataTable({

                columns: [
                    { data: 'Number' },
                    { data: 'โครงการ' },
                    { data: 'Progressive' },
                    { data: 'Agency' },
                    { data: 'Date' },
                    { data: 'Action' }
                ],
                "Number": [[ 0, "ASC" ]]
            });

        });
        function selectsearch() {
        var e = document.getElementById("selectAllAgency");
        var value = e.value;
        window.location.href = 'project.php?id='+value;
        }

        function deleteProject(id,payload) {
          if(!confirm('Are you sure?')){
            e.preventDefault();
            return false;
        }
          window.location.href = 'Manage/delete.php?id='+id+'&action=project&payload='+payload;
        }

        $('#postEdit').on('submit', function() {
            $('input, select').prop('disabled', false);
        });

    </script>  

                    </body>
                    <!--end::Footer-->
    <!--end::Header-->