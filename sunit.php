<?php
session_start();
ob_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
	header("location: index.php");
	exit();
}

include("dblink.php");
include("DateThai.php");

$agencyId = $_SESSION["AgencyID"];

//master
$sql_getsunit = "SELECT s.*,a.Name as Agency_name,a.AgencyID as a_AgencyID,a.IsActive as a_IsActive 
,p.Name as ProjectName
From km_sunit s
INNER JOIN  km_project p on p.ProjectID = s.ProjectID 
INNER JOIN  km_agency a on p.AgencyID = a.AgencyID
Where s.IsActive = 1 AND a.IsActive = 1 AND s.AgencyID = $agencyId AND p.IsActive = 1";
$sql_resultsunit =  mysqli_query($link,$sql_getsunit);

$sunits = array();
while($row = mysqli_fetch_assoc($sql_resultsunit))
{
    $sunits[] = $row;
}

//get project
$sql_listproject = "SELECT ProjectID,Name,AgencyID FROM km_project WHERE IsActive  = 1 AND AgencyID = $agencyId";
$result_listproject = mysqli_query($link,$sql_listproject);

$listproject = array();
while($row = mysqli_fetch_assoc($result_listproject))
{
    $listproject[] = $row;
}

function subsplit($list,$link){
    //require_once "dblink.php";
    $listname_agency = array();
    $integerIDs = array_map('intval', explode(',', $list));
   // print_r($integerIDs);exit();
    foreach($integerIDs as $item)
    {
   $agency_nameValue = "SELECT Name FROM km_agency WHERE IsActive  = 1 AND AgencyID = $item";        
   $result = mysqli_query($link,$agency_nameValue);      
   while($row = mysqli_fetch_assoc($result))
    {
       $listname_agency[] = $row;
    }
    }
   //print_r($listname_agency); exit();
   $strragency = "";
   if(count($listname_agency) >  0)
   {
       foreach($listname_agency as $item){
        $strragency .= $item['Name']."<hr>";
       }
   }
    return $strragency; 
}


function GetSunitDetail($id,$link){   
        //Detail
        $sql = "select * FROM km_sunitdetail
        where SunitID = $id";
        $result =  mysqli_query($link,$sql);
        $sunitDetail = array();
        while($row = mysqli_fetch_assoc($result))
        {
            $sunitDetail[] = $row;
        }
        return $sunitDetail;
}

function GetProgressive($id,$link)
{
    $sql = "select Progressive FROM km_sunitdetail
    where SunitID = $id";
    $result =  mysqli_query($link,$sql);
    $_progressive = 0;
    while($row = mysqli_fetch_assoc($result))
    {
        $_progressive =  ((int)$_progressive + (int)$row['Progressive']);
    }
    return $_progressive;
}


/*
echo "sunit<br>";
print_r($sunits);/*
//echo "sunitDetail<br>";
//print_r($sunitDetails);
echo "project<br>";
print_r($listproject);
exit();
*/
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
                        <?php if($_SESSION["Rolename"] != 'superadmin' ){ ?>  
                        <li class="nav-item">
                            <a href="#" class="nav-link py-4 px-6 active" data-toggle="tab" data-target="#kt_header_tab_1" role="tab">Manage</a>
                        </li>
                        <?php } ?>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <?php if($_SESSION["AgencyName"] == 'ผู้บริหาร' ||  $_SESSION["Rolename"] == 'Programmer' ){ ?>
                        <li class="nav-item mr-3">
                        <a href="report.php" class="nav-link py-4 px-6" >Reports</a>
                        </li>
                        <?php } ?>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item mr-3">
                            <a href="#" class="nav-link py-4 px-6" data-toggle="tab" data-target="#kt_header_tab_3" role="tab">User</a>
                        </li>
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
                        <?php if($_SESSION["Rolename"] != 'superadmin' ){ ?>  
                        <li class="nav-item mr-2">
                            <a href="#" class="nav-link btn btn-clean active" data-toggle="tab" data-target="#kt_header_tab_1" role="tab">Manage</a>
                        </li>
                        <?php } ?>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <?php if($_SESSION["AgencyName"] == 'ผู้บริหาร' ||  $_SESSION["Rolename"] == 'Programmer'){ ?>
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
                                    <li class="menu-item  menu-item-active" aria-haspopup="true">
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
                        <div class="tab-pane p-5 p-lg-0 justify-content-between" id="kt_header_tab_3">
                            <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center">
                                <!--begin::Actions-->
                                <a href="listuser.php" class="btn btn-light-success font-weight-bold mr-3 my-2 my-lg-0">List User</a>
                                <?php if($_SESSION["Rolename"] == 'Programmer' ||  $_SESSION["Rolename"] == 'superadmin'){ ?>
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
  
  <br><br><br>
    <div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">

    <div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
											<h3 class="card-label">เจ้าภาพกลยุทธิ์ / หน่วยส่งมอบผลงาน
											<span class="d-block text-muted pt-2 font-size-sm">กำหนดเจ้าภาพกลยุทธิ์ / หน่วยส่งมอบผลงาน</span></h3>
										</div>
										<div class="card-toolbar">
											<!--begin::Dropdown-->
											<div class="dropdown dropdown-inline mr-2">
										
											</div>
											<!--end::Dropdown-->
											<!--begin::Button-->
                                            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModalSizeLg">สร้าง เจ้าภาพกลยุทธิ์ / หน่วยส่งมอบผลงาน</button>
											<!--end::Button-->
										</div>
									</div>
									<div class="card-body">
										<!--begin: Search Form-->
										<!--begin::Search Form-->
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

      
                                        <table class="table table-separate table-head-custom" id="tbI">
											<thead>
												<tr>
													<th>Number</th>
                                                    <th>โครงการ</th>
													<th>หน่วยที่รับผิดชอบ</th>
													<th>Progressive</th>			                                                   
                                                    <th>Name</th>                                                
                                                    <th>Date</th>
                                                    <th>Action</th> 
                                                                                   
												</tr>
											</thead>
											<tbody>
                                            <?php foreach($sunits as $master){?>
                                                <?php $totalProgressive =  GetProgressive($master['SunitID'],$link) ?>
												<tr style="background-color:#F0FFFE">
													<td><?php echo $master['Number'] ?></td>
													<td><?php  echo $master['ProjectName'] ?></td>
                                                    <td><?php echo subsplit($master['AgencyList'],$link);   ?></td>
													<td><?php echo  $totalProgressive.'%' ?></td>						
                                                    <td><?php  echo $master['Name'] ?></td>     		
                                                    <td><?php echo DateThai($master['UpdateOn']) ?></td>  																													
                                                    <td>
                                                    <?php if($totalProgressive != 100){ ?>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"                                                    
                                                     data-target="#exampleModal"
                                                     onClick="onclick_Update(<?php echo $master['SunitID'];  ?>)"
                                                     >Update</button>                                                 
                                                     <?php } ?>
                                                     <a href="sunitdetail.php?id=<?php echo $master['SunitID']; ?>" target="_blank">
                                                        <input type="button" class="btn btn-danger btn-shadow font-weight-bold mr-2" value="Detail"></a>   
                                                     </td>
                                                                                               
												</tr>

                                                <?php  $Detail = GetSunitDetail($master['SunitID'],$link);
                                                    if(count($Detail) > 0){ ?>
                                                 <?php  
                                                  foreach($Detail as $detail){
                                                 ?>   
                                                <tr>
													<td><?php echo $detail['Number'] ?></td>
													<td><?php  echo $master['ProjectName'] ?></td>
                                                    <td><?php echo subsplit($master['AgencyList'],$link);   ?></td>
													<td><?php  echo $detail['Progressive']."%" ?></td>			
                                                    <td><?php  echo $detail['Name'] ?></td>
                                                    <td><?php  echo DateThai($detail['UpdateOn']) ?></td>     																																		
                                                    <td></td>
                                                                                               
												</tr>
                                                <?php } ?>
                                            <?php } ?>
                                            
                                         <?php   } ?>
											</tbody>
										</table>
                                                

									</div>
								</div>

</div>
</div>

<form action="Manage/upsertsunitDetail.php" method="POST" enctype="multipart/form-data">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">อัตเดท เจ้าภาพกลยุทธิ์ / หน่วยส่งมอบผลงาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="Update_id" id="ajaxid">
            <input type="hidden" name="Update_projectid" id="Update_projectid" >
            <input type="hidden"  name="Update_agencyid" value="<?php echo $agencyId ?>">
                <div class="form-group row">
								<label class="col-2 col-form-label">หัวข้อ</label>
														<div class="col-10">
															<input class="form-control" type="text" value="" name="Update_projecttext" id="Update_projecttext" readonly />
														</div>
								</div>
                <div class="form-group row">               
                                <label class="col-3 col-form-label">Progressive: </label>
            <div class="col-9">
            <input class="form-control" type="text" value="" name = "Update_Progressive" id="Update_Progressive" onchange="handleChange(this);" onkeypress="return isNumber(event)"
            autocomplete="off" required
            />	

            </div>               
                </div>
    <div class="form-group row">
    
    <label class="col-2 col-form-label">หมายเหตุ</label>
                            <div class="col-10">
                                <input class="form-control" type="text" value="" name="Update_Name" id="Update_Name" autocomplete="off" required />
    </div>
    </div>
    <div class="form-group row">
    <label class="col-4 col-form-label">อัพโหลดไฟล์</label>
    <div class="col-lg-8 col-md-8 col-xl-8">
                                <input type="file" id="fileInput" name="filUpload[]" multiple><br /><br />
                                <button class="btn btn-danger" type="button" id="Remove">Remove</button>
                            </div>
    </div>
    <div class="form-group row">
    <table class="table table-sm" id="tablePostedFile" width="100%">

<tr>
    <td>Filename</td>
</tr>
    <tr id="myTableFileRow">
        <td></td>
    </tr>
         <tr>

        </tr>
</table>                                              
    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" name="save"  class="btn btn-primary font-weight-bold">Save changes</button>
            </div>
        </div>
    </div>
</div>
</form>


<form action="Manage/upsertsunit.php" method="POST" name="RegForm" 
id="createform">
<div class="modal fade" id="exampleModalSizeLg" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">สร้าง เจ้าภาพกลยุทธิ์ / หน่วยส่งมอบผลงาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="id" id="id" value = "0">
            <input type="hidden" name="agencyid" value="<?php echo $agencyId ?>">
            <div class="form-group row">
            <label class="col-3 col-form-label">โครงการ : </label>
            <div class="col-9">
														<select class="form-control" name="projectid" id = "projectid">
															<option value="">Select</option>
                                                            <?php
                                                            foreach($listproject as $row)
                                                            { ?>
                                                            <option value="<?php echo $row['ProjectID'] ?>"><?php echo  $row['Name']?></option>
                                                     <?php  } ?>
                                                            
														</select>
													</div>
                                                    </div>
        
        <div id="div0">
        <div class="form-group row">
            <label class="col-3 col-form-label">หน่วยงาน : </label>
            <div class="col-9">
														<select class="form-control evenagency" name="agencylistid[]" id = "stratagency">
															<option value="">Select</option>
														</select>
													</div>
                                                    </div>
        </div>
                
                
           
                <div class="form-group row">
                <div class="col-1"></div>
                <div class="col-2">
                <button type="button" class="btn btn-primary btn-sm" id="addagency">เพิ่มหน่วยงาน</button>
                </div>
               <!-- <button type="button" class="btn btn-danger btn-sm" id="del_agency">ลบหน่วยงาน</button> -->
                </div>
                

    <div class="form-group row">
            <label class="col-3 col-form-label">หมายเหตุ : </label>
            <div class="col-9">
            <input class="form-control" type="text" value="" id="example-text-input" name="name" autocomplete="off" />
        </div>
    </div>   
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" id="save" name="save" class="btn btn-primary font-weight-bold">Save changes</button>
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



                    </body>
    <script> 
$(document).ready(function() {
    $.ajax({
        type: 'post',
        dataType: 'JSON',
        url: 'AjaxManage/_getallagency.php',
        success: function (response) {     
     //       console.log(response); 
            if(response.length > 0){   
            AddSelectList_Agency(response,'stratagency');
            }
        }    
});

        var Click_num = 0;
        var Div_num = 0;
        $("#addagency").click(function(){
            $('#addagency').prop('disabled', true);
            Click_num +=  + 1;
        var data;
        $.ajax({
        type: 'post',
        dataType: 'JSON',
        url: 'AjaxManage/_getallagency.php',
        success: function (response) {
            data = response;     
            $('#addagency').prop('disabled', false);
           // console.log(data);
            if(data.length > 0)
            {
                idtagselect = "agencylist"+Click_num;
                Div_num = "div"+Click_num;
             //   console.log(idtagselect);
                if(Click_num == 1){
                    // alert("log");
                    $( "#div0" ).after( $( ` <div id=`+Div_num+`>
                    <div class="form-group row">
            <label class="col-3 col-form-label">หน่วยงาน : </label>
            <div class="col-9">
														<select class="form-control evenagency" name="agencylistid[]"id=`+idtagselect+`>
															<option value="">Select</option>
														</select>
													</div>
              </div>
              </div>`) );        
                }else{
                //prepend() and .after(), .before()  
                    var log = Click_num - 1;
                    var div_old = "#div"+log;
                    console.log(div_old);
                    $( div_old ).after( $( ` <div id=`+Div_num+`>
                    <div class="form-group row">
            <label class="col-3 col-form-label">หน่วยงาน : </label>
            <div class="col-9">
														<select class="form-control evenagency" name="agencylistid[]" id=`+idtagselect+`>
															<option value="">Select</option>
														</select>
													</div>
              </div>
              </div>` ) );
                }             
              if(data.length > 0){
              AddSelectList_Agency(data,idtagselect);
              }
            }
        }
        });
    });

        $("#save").click(function(){
   //         alert("test: button");
            var inp = [];
            var inps = document.getElementsByName('agencylistid[]');
            for (var i = 0; i <inps.length; i++) {
                if(inps[i].value != 0) {
                inp.push(inps[i].value);
            }
        }

          var jsonString = JSON.stringify(inp);
          console.log(jsonString);
          $.ajax({
        type: 'post',
        url: 'AjaxManage/_createSessionAgencyList.php',
        data: {
        data:jsonString
    },
            success: function (response) {
            //alert(response);
            if(ValidateCreate()){
            $("#createform").submit();
            }
            
        }
    });
           
        });
        
        function AddSelectList_Agency(value,idname)
        {
            idname = "#"+idname;
            for(var i = 0; i< value.length; i++){
                    $(idname).append('<option value="'+value[i].AgencyID+'">'+value[i].Name+'</option>');
                }
        }

    });
            function onclick_Update(value)
        {
     document.getElementById("ajaxid").value = "";
     document.getElementById("Update_projectid").value = "";
     document.getElementById("Update_projecttext").value = "";
     document.getElementById("Update_Progressive").value = ""; 
     document.getElementById("Update_Name").value = "";
        $.ajax({
            type: 'post',
            url: 'AjaxManage/_getUpdateSunitgybyId.php',
            data: {
            ajax_id:value
        },
            success: function (response) {
              //  console.log(response);
     document.getElementById("ajaxid").value = response[0].SunitID;
     document.getElementById("Update_projectid").value = response[0].ProjectID;
     document.getElementById("Update_projecttext").value = response[0].ProjectName;
     document.getElementById("Update_Progressive").value = ""; 
     document.getElementById("Update_Name").value = "";
                }
             });
        }

        function handleChange(input) {

            var id = $("#ajaxid").val();

            $.ajax({
            type: 'post',
            url: 'AjaxManage/_getProgressiveById.php',
            data: {
            ajax_id:id
        },
            success: function (response) {
                var total = 100;
                console.log(response);
                //response is total all project
                if(response == 0)
                {
                if (input.value < 0) input.value = 0;
                if (input.value > 100) input.value = 100;
                }else {
                if(input.value > response) {                
                    input.value = (total - response);
                }
               
                if(input.value < 0) input.value = 0;                
                }

                }
             });



             //get Update_Progressive
        }
        function isNumber(evt) {
           evt = (evt) ? evt : window.event;
           var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
        }
    return true;
}

function ValidateCreate() { 
        var project = $("#projectid").val();
        var agency = $("#stratagency").val();
        var name = document.forms["RegForm"]["name"]; 
 
  //  alert(project);

        if (name.value == "") { 
            window.alert("Please enter your name."); 
            name.focus(); 
            return false; 
        } 
  
        if (agency == "" || agency == undefined) { 
            window.alert("Please enter your agency."); 
            agency.focus(); 
            return false; 
        } 
  
        if (project == ""  || project == undefined) { 
            window.alert( 
              "Please enter a valid  project."); 
              project.focus(); 
            return false; 
        }  
    
        return true; 
    } 


    </script> 

<script type="text/javascript">
    $(document).ready(function () {
        //UploadFile Action




        $("#fileInput").change(function() {
          //  alert("fileInput");
            var files = document.getElementById("fileInput").files;
            var formdata = new FormData();
            //   validateUpload = document.getElementById("fileInput");
            var myTable = document.getElementById("tablePostedFile");
            var rowCount = myTable.rows.length;
          //  alert(rowCount);
            for (var x=rowCount-1; x>0; x--) {
            myTable.deleteRow(x);
            }
            
            for (var i = 0; i < files.length; i++) {
                formdata.append("fileInput", files[i]);

                var tBody = $("#tablePostedFile")[0];

                //Add Row.
                var row = tBody.insertRow(-1);

                //Add Number Cell
                var cell = $(row.insertCell(-1)).attr("hidden", "hidden");
                cell.html(tblRowCountFile);

                var tblRowCountFile = 0;
                if (tblRowCountFile == 0) {
                    $('#myTableFileRow').remove();
                }

                //Add IsRemove Cell
                var cell = $(row.insertCell(-1)).attr("hidden", "hidden");
                var isRemoveCell = "<input id='File" + tblRowCountFile + "__IsRemove' name='KM_[" + tblRowCountFile + "].IsRemove' type='hidden' value='false'>";
                cell.html(isRemoveCell);

                //Add FileName<td> cell.
                var cell = $(row.insertCell(-1)).addClass('text-left');
                var FileName = "<input id='File" + tblRowCountFile + "__FileName' name='KM_[" + tblRowCountFile + "].FileName' type='hidden' value='" + files[i].name + "'><label  id='PR" + tblRowCountFile + "MaterialText' for='" + files[i].name + "' >" + "<i class='flaticon2-file text-info'></i>     "+files[i].name + "</label >";
                cell.html(FileName);
                tblRowCountFile++;
            }
            /*var xhr = new XMLHttpRequest();
            xhr.open('POST', "/PurchaseRequest/Upload");
            xhr.send(formdata);
            xhr.onreadystatechange = function () {

            }*/
        });   

        $('#Remove').on('click', function () {
            $('#fileInput').val('');
            var myTable = document.getElementById("tablePostedFile");
            var rowCount = myTable.rows.length;
        //    alert(rowCount);
            for (var x=rowCount-1; x>0; x--) {
            myTable.deleteRow(x);
            }
        });


    })
            </script>
    <script>
        $(document).ready(function () {
            var table = $('#tbI').DataTable({

                columns: [
                    { data: 'Number' },
                    { data: 'โครงการ' },
                    { data: 'หน่วยที่รับผิดชอบ' },
                    { data: 'Progressive' },
                    { data: 'Name' },
                    { data: 'Date' },
                    { data: 'Action' }
                ],
                "Number": [[ 0, "ASC" ]]
            });

        });

    </script>
