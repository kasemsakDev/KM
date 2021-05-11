<?php  


if (isset($_GET['id']) && isset($_GET['action'])) {


$id = $_GET['id'];
require_once "../dblink.php";
require_once "../kmIdModel.php";
switch ($_GET['action']) {

  case "sunitdetail":

    $payload  = $_GET['payload']; //id sunit
    $sql = "DELETE FROM km_sunitdetail WHERE SunitDetailID = $id";
    mysqli_query($link,$sql);

    $_masterNumber = ""; //เลขตั้งต้น เวลาจะบันทึกลงฐานข้อมูลของ km_sunitdetail จะเป็น => $_masterNumber.newNumber.Tostring();
    $_getNumber = "select Number  FROM km_sunit  Where SunitID = $payload";
    $sql_result =  mysqli_query($link,$_getNumber);
    while($row = mysqli_fetch_assoc($sql_result))
    {
        $_masterNumber = $row['Number'];
    }
    
    $_sunitdetail = array();
    $_getsunudetail = "select SunitDetailID,UpdateOn from km_sunitdetail Where SunitID = $payload order by UpdateOn asc";
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
      header("location: ../sunit.php");
    break;
  case "sunit":
    $payload  = $_GET['payload'];//projectID
    $sql = "";
    $_masterNumber = "";


    //delete master
    $sql = "DELETE FROM km_sunit WHERE SunitID = $id";
    mysqli_query($link,$sql);

    //delete Sub
    $sql = "DELETE FROM km_sunitdetail WHERE SunitID = $id";
    mysqli_query($link,$sql);

    //getNumber
    $sql = "select Number FROM km_project WHERE km_project.ProjectID = $payload";
    $resultNumberProject = mysqli_query($link,$sql);
    while($row = mysqli_fetch_assoc($resultNumberProject))
    {
        $_masterNumber = $row['Number'];  // Number Project
    }

    $_sunit = array();
    $_getsunit = "select SunitID,UpdateOn from km_sunit Where ProjectID = $payload order by UpdateOn asc";
    $sql_ResultSunuDetail =  mysqli_query($link,$_getsunit);
    while($row = mysqli_fetch_assoc($sql_ResultSunuDetail))
    {
      $_sunit[] = $row;
    }
    //Update number 
    $numberSunit = 0;
    $numberDetail = 0; 
    $_sunitdetail = array();
    if(count($_sunit) > 0){
      foreach ($_sunit as $value) {
        $numberSunit++;
        $_newDataNumber = (string)$_masterNumber .'.'. (string)$numberSunit;
        $id = $value['SunitID'];
        $sql = "UPDATE km_sunit
        SET Number = '$_newDataNumber'
        WHERE SunitID=$id";
        mysqli_query($link,$sql);
        $sql = "select SunitDetailID,UpdateOn from km_sunitdetail Where SunitID = $id order by UpdateOn asc";
        $sql_ResultSunuDetail =  mysqli_query($link,$sql);
        if (mysqli_num_rows($sql_ResultSunuDetail) > 0) {
        while($row = mysqli_fetch_assoc($sql_ResultSunuDetail))
        {
            $_sunitdetail[] = $row;
        }
        foreach($_sunitdetail as $detail){
          $numberDetail++;
          $_newDataNumberDetail = (string)$_newDataNumber .'.'. (string)$numberDetail;
          $id = $detail['SunitDetailID'];
          $sql = "UPDATE km_sunitdetail
          SET Number = '$_newDataNumberDetail'
          WHERE SunitDetailID=$id";
          mysqli_query($link,$sql);
        }
        }
      }
    }
    header("location: ../sunit.php");
    break;
  case "project":
         $sql = "";
         $payload  = $_GET['payload'];
         $_numberStrategy = "";
    //ลบทุกตัวที่เกี่ยวกับ Project   3ตัว Project,sunit,Detail

        //Delete km_sunitdetail
        $SunitDetailID = 0;
         $sql = "Select SunitDetailID FROM km_sunitdetail
        inner join km_sunit on km_sunitdetail.SunitID = km_sunit.SunitID
        inner join km_project on km_sunit.ProjectID = km_project.ProjectID
        where km_project.ProjectID = $id";
        $resultSunitDetailID =  mysqli_query($link,$sql);
        while($row = mysqli_fetch_assoc($resultSunitDetailID))
        {
          $SunitDetailID = $row['SunitDetailID'];
        }

        $sql = "DELETE FROM km_sunitdetail WHERE SunitDetailID = $SunitDetailID";
        mysqli_query($link,$sql);

        //Delete km_sunit
        $sql = "DELETE FROM km_sunit WHERE ProjectID = $id";
        mysqli_query($link,$sql);

        //Delete km_project
         $sql = "DELETE FROM km_project WHERE ProjectID = $id";
         mysqli_query($link,$sql);

        //GetNumber strategy By Id Project
        
        $sql = "select Number from km_strategy Where StrategyID = $payload";
        $sql_result = mysqli_query($link,$sql);
        while($row = mysqli_fetch_assoc($sql_result))
        {
               $_numberStrategy = $row['Number'];
        }

        //Get Project list where  strategy = payload
        $_Project = array();
        $_getProject = "select ProjectID,UpdateOn from km_project Where StrategyID = $payload order by UpdateOn asc";
        $sql_ResultProject =  mysqli_query($link,$_getProject);
        while($row = mysqli_fetch_assoc($sql_ResultProject))
        {
          $_Project[] = $row;
        }
      //if(count(ProjectList) > 0 ){ 
      $numberProject = 0;
      $numberSunit = 0;
      $_sunit = array();
      $_sunitdetail = array();
      $numberSunitDetail = 0;
      if(count($_Project) >  0){
        foreach ($_Project as $value) {
           // update Table project where  strategy = payload
            $numberProject++;
            $_newNumberProject = (string)$_numberStrategy .'.'. (string)$numberProject;
            $id = $value['ProjectID'];
            $sql = "UPDATE km_project
            SET Number = '$_newNumberProject'
            WHERE ProjectID=$id";
            mysqli_query($link,$sql);
            // select  sunit  by Projectid  and update new number
            $sql = "select SunitID,UpdateOn from km_sunit Where ProjectID = $id order by UpdateOn asc";
            $sql_ResultSunit =  mysqli_query($link,$sql);
            if (mysqli_num_rows($sql_ResultSunit) > 0) {
            while($row = mysqli_fetch_assoc($sql_ResultSunit))
            {
                $_sunit[] = $row;
            }
            foreach ($_sunit as $sunit) { 
               //Update Sunit
              $numberSunit++;
              $_newNumbersunit = (string)$_newNumberProject .'.'. (string)$numberSunit;
              $id = $sunit['SunitID'];
              $sql = "UPDATE km_sunit
              SET Number = '$_newNumbersunit'
              WHERE SunitID=$id";
              mysqli_query($link,$sql);
              $sql = "select SunitDetailID,UpdateOn from km_sunitdetail Where SunitID = $id order by UpdateOn asc";
              $sql_ResultSunuDetail =  mysqli_query($link,$sql);
              if (mysqli_num_rows($sql_ResultSunuDetail) > 0) {
              while($row = mysqli_fetch_assoc($sql_ResultSunuDetail))
              {
                 $_sunitdetail[] = $row;
              }
          foreach($_sunitdetail as $detail){
          $numberSunitDetail++;
          $_newNumberSunitDetail = (string)$_newNumbersunit .'.'. (string)$numberSunitDetail;
          $id = $detail['SunitDetailID'];
          $sql = "UPDATE km_sunitdetail
          SET Number = '$_newNumberSunitDetail'
          WHERE SunitDetailID=$id";
          mysqli_query($link,$sql);
        }
        }
        }
      }
    }
  }
  header("location: ../project.php");
    break;
   case "strategy":
    $sql = "";
    $payload  = $_GET['payload'];
    $_numberIndicatorID = "";
    $IdModel = _getIdALL($id,$_GET['action'],$link);
    $SunitID = $IdModel->SunitID;
    $SunitDetailID = $IdModel->SunitDetailID;
    //ลบทุกตัวที่เกี่ยวกับ strategy 
            //Delete km_sunitdetail
            $sql = "DELETE FROM km_sunitdetail
            where km_sunitdetail.SunitDetailID = $SunitDetailID";
            mysqli_query($link,$sql);
        
            //-Del Sunit
            $sql = "DELETE FROM km_sunit 
            Where km_sunit.SunitID = $SunitID";
            mysqli_query($link,$sql);
            
            //Delete km_project ยัง
             $sql = "DELETE FROM km_project WHERE StrategyID = $id";
             mysqli_query($link,$sql);

             //Delete km_strategy
             $sql = "DELETE FROM km_strategy WHERE StrategyID = $id";
             mysqli_query($link,$sql);

             //GetNumber IndicatorID
             $sql = "select Number from km_indicator WHERE km_indicator.IndicatorID = $payload";
             $sql_result = mysqli_query($link,$sql);
             while($row = mysqli_fetch_assoc($sql_result))
             {
                    $_numberIndicatorID = $row['Number'];
             }

      //Get km_strategy list where  strategy = payload
      $_strategy = array();
      $_getStrategy = "select StrategyID,UpdateOn from km_strategy Where IndicatorID = $payload order by UpdateOn asc";
      $sql_Restrategy =  mysqli_query($link,$_getStrategy);
      while($row = mysqli_fetch_assoc($sql_Restrategy))
      {
        $_strategy[] = $row;
      }

    $numberStrategy = 0;
    $_Project = array();
    $numberProject = 0;
    $_sunit = array();
    $numberSunit = 0;
    $_sunitdetail = array();
    $numberSunitDetail = 0; 
      if(count($_strategy) >  0) {
          foreach($_strategy as $strategy) {
            $numberStrategy++;
            $_newNumberStrategy = (string)$_numberIndicatorID .'.'. (string)$numberStrategy;
            $id = $value['StrategyID'];
            $sql = "UPDATE km_strategy
            SET Number = '$_newNumberStrategy'
            WHERE StrategyID=$id";
            mysqli_query($link,$sql);
          
          $sql = "select ProjectID,UpdateOn from km_project Where StrategyID = $id order by UpdateOn asc";
          $sql_ResultProject =  mysqli_query($link,$sql);
          if (mysqli_num_rows($sql_ResultProject) > 0) {
          while($row = mysqli_fetch_assoc($sql_ResultProject))
          {
              $_Project[] = $row;
          }
          foreach($_Project as $project){
          $numberProject++;
          $_newNumberProject = (string)$_newNumberStrategy .'.'. (string)$numberProject;
          $id = $project['ProjectID'];
          $sql = "UPDATE km_project
          SET Number = '$_newNumberProject'
          WHERE ProjectID=$id";
          mysqli_query($link,$sql);
          
          $sql = "select SunitID,UpdateOn from km_sunit Where ProjectID = $id order by UpdateOn asc";
          $sql_ResultSunit =  mysqli_query($link,$sql);
          if (mysqli_num_rows($sql_ResultSunit) > 0) {
            while($row = mysqli_fetch_assoc($sql_ResultSunit))
            {
                $_sunit[] = $row;
            }
            foreach($_sunit as $sunit){
              $numberSunit++;
              $_newNumberSunit = (string)$_newNumberProject .'.'. (string)$numberSunit;
              $id = $sunit['SunitID'];
              $sql = "UPDATE km_sunit
              SET Number = '$_newNumberSunit'
              WHERE SunitID=$id";
              mysqli_query($link,$sql);

              $sql = "select SunitDetailID,UpdateOn from km_sunitdetail Where SunitID = $id order by UpdateOn asc";
              $sql_ResultSunuDetail =  mysqli_query($link,$sql);
              if (mysqli_num_rows($sql_ResultSunuDetail) > 0) {
              while($row = mysqli_fetch_assoc($sql_ResultSunuDetail))
              {
                 $_sunitdetail[] = $row;
              }
              foreach($_sunitdetail as $detail){
              $numberSunitDetail++;
              $_newNumberSunitDetail = (string)$_newNumberSunit .'.'. (string)$numberSunitDetail;
              $id = $detail['SunitDetailID'];
              $sql = "UPDATE km_sunitdetail
              SET Number = '$_newNumberSunitDetail'
              WHERE SunitDetailID=$id";
              mysqli_query($link,$sql);
            } //End loop sunitdetail
            } //End if sunitdetail
            } //End loop Sunit
          }//End if Sunit
        }//End loop project
      }//End if project
    }//End loop strategy
  }//End if strategy
    header("location: ../strategy.php");
    break;
    case "indicator":
    $sql = "";  
    $payload  = $_GET['payload'];
    $_numberPurposeID = "";
    $IdModel = _getIdALL($id,$_GET['action'],$link);
    /*print_r($IdModel);
    echo "<br>";
    echo  $IdModel->ProjectID; 
    exit();*/
    $IndicatorID = $IdModel->IndicatorID;
    $StrategyID = $IdModel->StrategyID;
    $ProjectID = $IdModel->ProjectID;
    $SunitID = $IdModel->SunitID;
    $SunitDetailID = $IdModel->SunitDetailID;

    $sql = "DELETE FROM km_sunitdetail
    where km_sunitdetail.SunitDetailID = $SunitDetailID";
    mysqli_query($link,$sql);

    //-Del Sunit
    $sql = "DELETE FROM km_sunit 
    Where km_sunit.SunitID = $SunitID";
    mysqli_query($link,$sql);

    //-Del project
    $sql = "DELETE FROM km_project 
    Where km_project.ProjectID = $ProjectID";

    mysqli_query($link,$sql);
    //-Del strategy
    $sql = "DELETE FROM km_strategy
    Where km_strategy.StrategyID = $StrategyID";
    mysqli_query($link,$sql);

    //-Del indicator
    $sql = "DELETE FROM km_indicator
    Where km_indicator.IndicatorID = $id";
    mysqli_query($link,$sql);

    //** GetNumber purpose by id payload
    $sql = "SELECT Number FROM km_purpose where  km_purpose.PurposeID = $payload";
    $sql_result = mysqli_query($link,$sql);
    while($row = mysqli_fetch_assoc($sql_result))
    {
           $_numberPurposeID = $row['Number'];
    }

    //Get km_indicator list where  PurposeID = payload
    $_indicator = array();
    $_getindicator = "select IndicatorID,UpdateOn from km_indicator Where PurposeID = $payload order by UpdateOn asc";
    $sql_indicator =  mysqli_query($link,$_getindicator);
    while($row = mysqli_fetch_assoc($sql_indicator))
    {
      $_indicator[] = $row;
    } 

    $numberIndicator = 0;
    $_strategy = array();
    $numberStrategy = 0;
    $_Project = array();
    $numberProject = 0;
    $_sunit = array();
    $numberSunit = 0;
    $_sunitdetail = array();
    $numberSunitDetail = 0;
    if(count($_indicator) >  0) {
      foreach($_indicator as $value) {
        //update Number Indicator
        $numberIndicator++;
        $_newNumberIndicator = (string)$_numberPurposeID .'.'. (string)$numberIndicator;
        $id = $value['IndicatorID'];
        $sql = "UPDATE km_indicator
        SET Number = '$_newNumberIndicator'
        WHERE IndicatorID=$id";
        mysqli_query($link,$sql);

        //update Number strategy
        $sql = "select StrategyID,UpdateOn from km_strategy Where IndicatorID = $id order by UpdateOn asc";
        $sql_Resultstrategy =  mysqli_query($link,$sql);
        if (mysqli_num_rows($sql_Resultstrategy) > 0) {
        while($row = mysqli_fetch_assoc($sql_Resultstrategy))
        {
           $_strategy[] = $row;
        }
        foreach($_strategy as $strategy)
        {
          $numberStrategy++;
          $_numberStrategy = (string)$_newNumberIndicator .'.'. (string)$numberStrategy;
          $id = $strategy['StrategyID'];
          $sql = "UPDATE km_strategy
          SET Number = '$_numberStrategy'
          WHERE StrategyID =$id";
          mysqli_query($link,$sql);
          //
          $sql = "select ProjectID,UpdateOn from km_project Where StrategyID = $id order by UpdateOn asc";
          $sql_ResultProject =  mysqli_query($link,$sql);
          if (mysqli_num_rows($sql_ResultProject) > 0) {
            while($row = mysqli_fetch_assoc($sql_ResultProject))
            {
                $_Project[] = $row;
            }
          foreach($_Project as $project) {
            $numberProject++;
            $_numberProject = (string)$_numberStrategy .'.'. (string)$numberProject;
            $id = $project['ProjectID'];
            $sql = "UPDATE km_project 
            SET Number = '$_numberProject' 
            WHERE ProjectID = $id";
            mysqli_query($link,$sql);

            $sql = "select SunitID,UpdateOn from km_sunit Where ProjectID = $id order by UpdateOn asc";
            $sql_ResultSunit =  mysqli_query($link,$sql);
            if (mysqli_num_rows($sql_ResultSunit) > 0) {
              while($row = mysqli_fetch_assoc($sql_ResultSunit))
              {
                  $_sunit[] = $row;
              }
              foreach($_sunit as $sunit){
                $numberSunit++;
                $_newNumberSunit = (string)$_numberProject .'.'. (string)$numberSunit;
                $id = $sunit['SunitID'];
                $sql = "UPDATE km_sunit
                SET Number = '$_newNumberSunit'
                WHERE SunitID=$id";
                mysqli_query($link,$sql);
  
                $sql = "select SunitDetailID,UpdateOn from km_sunitdetail Where SunitID = $id order by UpdateOn asc";
                $sql_ResultSunuDetail =  mysqli_query($link,$sql);
                if (mysqli_num_rows($sql_ResultSunuDetail) > 0) {
                while($row = mysqli_fetch_assoc($sql_ResultSunuDetail))
                {
                   $_sunitdetail[] = $row;
                }
                foreach($_sunitdetail as $detail){
                $numberSunitDetail++;
                $_newNumberSunitDetail = (string)$_newNumberSunit .'.'. (string)$numberSunitDetail;
                $id = $detail['SunitDetailID'];
                $sql = "UPDATE km_sunitdetail
                SET Number = '$_newNumberSunitDetail'
                WHERE SunitDetailID=$id";
                mysqli_query($link,$sql);
              }//End loop SunitDetail
              }//End if SunitDetail
              }//End loop sunit
            }//End if sunit
          }//End loop project
        }//End if project
      }//End loop strategy
    }// End if strategy
  }// End loop indicator
}//End if indicator
    header("location: ../indicator.php");
    break;  
   case "purpose":
    $sql = "";  
    $payload  = $_GET['payload'];
    $_numberissueID = "";
    $IdModel = _getIdALL($id,$_GET['action'],$link);
    /*print_r($IdModel);
    echo "<br>";
    echo  $IdModel->ProjectID; 
    exit();*/
    $IndicatorID = $IdModel->IndicatorID;
    $StrategyID = $IdModel->StrategyID;
    $ProjectID = $IdModel->ProjectID;
    $SunitID = $IdModel->SunitID;
    $SunitDetailID = $IdModel->SunitDetailID;

    $sql = "DELETE FROM km_sunitdetail
    where km_sunitdetail.SunitDetailID = $SunitDetailID";
    mysqli_query($link,$sql);

    //-Del Sunit
    $sql = "DELETE FROM km_sunit 
    Where km_sunit.SunitID = $SunitID";
    mysqli_query($link,$sql);

    //-Del project
    $sql = "DELETE FROM km_project 
    Where km_project.ProjectID = $ProjectID";

    mysqli_query($link,$sql);
    //-Del strategy
    $sql = "DELETE FROM km_strategy
    Where km_strategy.StrategyID = $StrategyID";
    mysqli_query($link,$sql);

    //-Del indicator
    $sql = "DELETE FROM km_indicator
    Where km_indicator.IndicatorID = $IndicatorID";
    mysqli_query($link,$sql);

    $sql = "DELETE FROM km_purpose
    Where km_purpose.PurposeID = $id";
    mysqli_query($link,$sql);

    //get Number Issue By payload
    
    $sql = "select Number from km_issue WHERE km_issue.IssueID = $payload";
    $sql_result = mysqli_query($link,$sql);
    while($row = mysqli_fetch_assoc($sql_result))
    {
           $_numberissueID = $row['Number'];
    }

    $_purpose = array();
    $_getpurpose = "select PurposeID,UpdateOn from km_purpose Where IssueID = $payload order by UpdateOn asc";
    $resultPurpose =  mysqli_query($link,$_getpurpose);
    while($row = mysqli_fetch_assoc($resultPurpose))
    {
      $_purpose[] = $row;
    } 
 
    $numberPurpose = 0;
    $_Indicator = array();
    $numberIndicator = 0;
    $_strategy = array();
    $numberStrategy = 0;
    $_Project = array();
    $numberProject = 0;
    $_sunit = array();
    $numberSunit = 0;
    $_sunitdetail = array();
    $numberSunitDetail = 0;
    if(count($_purpose) > 0) {
      foreach($_purpose as $purpose) {  
          $numberPurpose++;
          $_numberPurpose = (string)$_numberissueID .'.'.(string)$numberPurpose;
          $id = $purpose['PurposeID'];
          $sql = "UPDATE km_purpose 
          SET Number = '$_numberPurpose'
          Where PurposeID = $id";
          mysqli_query($link,$sql);

          $_indicator = array();
          $_getindicator = "select IndicatorID,UpdateOn from km_indicator Where PurposeID = $payload order by UpdateOn asc";
          $sql_indicator =  mysqli_query($link,$_getindicator);
          if (mysqli_num_rows($sql_indicator) > 0) {
          while($row = mysqli_fetch_assoc($sql_indicator))
          {
            $_indicator[] = $row;
          }
          foreach($_indicator as $indicator){
            $numberIndicator++;
            $_newNumberIndicator = (string)$_numberPurposeID .'.'. (string)$numberIndicator;
            $id = $indicator['IndicatorID'];
            $sql = "UPDATE km_indicator
            SET Number = '$_newNumberIndicator'
            WHERE IndicatorID=$id";
            mysqli_query($link,$sql);
 //update Number strategy
 $sql = "select StrategyID,UpdateOn from km_strategy Where IndicatorID = $id order by UpdateOn asc";
 $sql_Resultstrategy =  mysqli_query($link,$sql);
 if (mysqli_num_rows($sql_Resultstrategy) > 0) {
 while($row = mysqli_fetch_assoc($sql_Resultstrategy))
 {
    $_strategy[] = $row;
 }
 foreach($_strategy as $strategy)
 {
   $numberStrategy++;
   $_numberStrategy = (string)$_newNumberIndicator .'.'. (string)$numberStrategy;
   $id = $strategy['StrategyID'];
   $sql = "UPDATE km_strategy
   SET Number = '$_numberStrategy'
   WHERE StrategyID =$id";
   mysqli_query($link,$sql);
   //
   $sql = "select ProjectID,UpdateOn from km_project Where StrategyID = $id order by UpdateOn asc";
   $sql_ResultProject =  mysqli_query($link,$sql);
   if (mysqli_num_rows($sql_ResultProject) > 0) {
     while($row = mysqli_fetch_assoc($sql_ResultProject))
     {
         $_Project[] = $row;
     }
   foreach($_Project as $project) {
     $numberProject++;
     $_numberProject = (string)$_numberStrategy .'.'. (string)$numberProject;
     $id = $project['ProjectID'];
     $sql = "UPDATE km_project 
     SET Number = '$_numberProject' 
     WHERE ProjectID = $id";
     mysqli_query($link,$sql);

     $sql = "select SunitID,UpdateOn from km_sunit Where ProjectID = $id order by UpdateOn asc";
     $sql_ResultSunit =  mysqli_query($link,$sql);
     if (mysqli_num_rows($sql_ResultSunit) > 0) {
       while($row = mysqli_fetch_assoc($sql_ResultSunit))
       {
           $_sunit[] = $row;
       }
       foreach($_sunit as $sunit){
         $numberSunit++;
         $_newNumberSunit = (string)$_numberProject .'.'. (string)$numberSunit;
         $id = $sunit['SunitID'];
         $sql = "UPDATE km_sunit
         SET Number = '$_newNumberSunit'
         WHERE SunitID=$id";
         mysqli_query($link,$sql);

         $sql = "select SunitDetailID,UpdateOn from km_sunitdetail Where SunitID = $id order by UpdateOn asc";
         $sql_ResultSunuDetail =  mysqli_query($link,$sql);
         if (mysqli_num_rows($sql_ResultSunuDetail) > 0) {
         while($row = mysqli_fetch_assoc($sql_ResultSunuDetail))
         {
            $_sunitdetail[] = $row;
         }
         foreach($_sunitdetail as $detail){
         $numberSunitDetail++;
         $_newNumberSunitDetail = (string)$_newNumberSunit .'.'. (string)$numberSunitDetail;
         $id = $detail['SunitDetailID'];
         $sql = "UPDATE km_sunitdetail
         SET Number = '$_newNumberSunitDetail'
         WHERE SunitDetailID=$id";
         mysqli_query($link,$sql);
       }//End loop SunitDetail
       }//End if SunitDetail
       }//End loop sunit
     }//End if sunit
   }//End loop project
 }//End if project
}//End loop strategy
}// End if strategy
}// End loop indicator
}//End if indicator
}//End loop  purpose
}//End if purpose
header("location: ../purpose.php");
    break;  
   case "issue":
    echo "issue";
    exit();
    break;  
  default:
    echo 'Not Action to Delete';
}

mysqli_close($link);

}




?>