<?php
require_once "dblink.php";
session_start();
ob_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
	header("location: index.php");
	exit();
}

$sunit = [];
$sunitDetail = [];
$upload_sunit = [];
$sql = "";
$result = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        //_get master    
        $sql = "SELECT s.*,a.Name as Agency_name,a.AgencyID as a_AgencyID,a.IsActive as a_IsActive 
        ,p.Name as ProjectName
        From km_sunit s
        INNER JOIN  km_project p on p.ProjectID = s.ProjectID 
        INNER JOIN  km_agency a on p.AgencyID = a.AgencyID
        Where s.IsActive = 1 AND a.IsActive = 1 AND s.SunitID = $id AND p.IsActive = 1";
        $result = mysqli_query($link,$sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $sunit[] = $row;
        }
        $sql = "";
        $result = "";
        //_get Detail
        $sql = "select * FROM km_sunitdetail
        where SunitID = $id";
        $result = mysqli_query($link,$sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $sunitDetail[] = $row;
        }

        }
       }

function GetUpload($id,$link){   
    //Detail
    $sql = "SELECT FileName,FilePath from km_upload 
    inner join km_sunitdetail on km_upload.SunitDetailID = km_sunitdetail.SunitDetailID
    where  km_upload.SunitDetailID = $id";
    $result =  mysqli_query($link,$sql);
    $uploadfile = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $uploadfile[] = $row;
    }
    return $uploadfile;
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
print_r($sunit);
echo "<br>";
Print_r($sunitDetail);
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
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom card-stretch">
                        <div class="card-header">
                            <div class="card-title">
                                    <span class="card-icon">
                                        <i class="flaticon2-menu text-danger"></i>
                                    </span>
                                <h3 class="card-label">
                                    โครงการ : 
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="form-group mb-16">
                        <div class="col-9">
                        <div class="d-flex flex-wrap mt-14">
                      
													<div class="mr-12 d-flex flex-column mb-7">
														<span class="d-block font-weight-bold mb-4">Start Date</span>
														<span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">14 Jan, 16</span>
													</div>
													<!--begin::Progress-->
                                                    <?php $totalProgressive =  GetProgressive($sunit[0]['SunitID'],$link) ?>
													<div class="flex-row-fluid mb-7">
														<span class="d-block font-weight-bold mb-4">Progress</span>
														<div class="d-flex align-items-center pt-2">
															<div class="progress progress-xs mt-2 mb-2 w-100">
																<div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $totalProgressive; ?>%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
															<span class="ml-3 font-weight-bolder"><?php echo $totalProgressive; ?>%</span>
														</div>
													</div>
													<!--end::Progress-->
                                                    </div>
						</div>
                                    <div class="form-group row">
                                        <div class="col-2 col-form-label font-weight-bold text-right"><p>หมายเหตุ :</p></div>
                                        <div class="col-4">
                                        <input type="text" class="form-control" value="<?php echo $sunit[0]['Name'] ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                        </div>


           <div class="container">
           <!-- Detail and upload file -->

           <?php  
                   if(count($sunitDetail) > 0){ 
                       foreach($sunitDetail as $detail){
            ?>                                          
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom card-stretch">
                        <div class="card-header">
                            <div class="card-title">
                                    <span class="card-icon">
                                        <i class="flaticon2-menu text-danger"></i>
                                    </span>
                                <h3 class="card-label">
                                    Log Update  <span class="btn btn-light-primary btn-sm font-weight-bold btn-upper btn-text">14 Jan, 16</span> : xxxxx 
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">                                                                                              
                         <div class="form-group row">
                         <div class="col-2 col-form-label font-weight-bold text-right"><p>หมายเหตุ :</p></div>
                                        <div class="col-4">
                                        <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                         <div class="col-2 col-form-label font-weight-bold text-right"><p>Progressive :</p></div>
                                        <div class="col-4">
                                        <input type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                         </div>

                        <?php $Detail = GetUpload($sunit[0]['SunitID'],$link); ?>

                         <div class="form-group row">
                         <div class="col-2 col-form-label font-weight-bold text-right"><p>upload file :</p></div>
                         <div class="container">
                         <table class="table table-bordered table-sm" id="tablePostedFile" width="100%">
                            <tr>
                            <td>#</td>
                            <td>Filename</td>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td></td>
                           </tr>
                        </table>
                        </div>
                        </div>
                        </div>                 
                    </div>
                </div>
            </div>
                        <?php } //end loop sunit Detail  ?>
            <?php } //end if ?>

            </div>
        </div>

        

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--begin::Entry-->
  
        <!--begin::Container-->

        </div>
  
   

       

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Content/template/css/global/plugins.bundle.js"></script>
    <script src="Content/template/css/prismjs/prismjs.bundle.js"></script>
    <script src="Content/template/js/scripts.bundle.js"></script>
    <script src="Content/template/js/fullcalendar/fullcalendar.bundle.js"></script>
    <script src="Content/template/plugins/custom/datatables/datatables.bundle.js"></script>
 </body>
    <script>