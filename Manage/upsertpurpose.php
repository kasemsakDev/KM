<?php

session_start();
ob_start();


    if(isset($_POST['save']))
    {
        require_once "../dblink.php";



        function _getNumber($issueId,$link)
        {
            $result_number = 0;
            $numberpurpose = 0;
            $sql = "select number FROM km_purpose 
			Where IssueID = $issueId
            ORDER BY number DESC 
            LIMIT 1";
            $result = mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
              $numberpurpose = (float)$row['number'];
            }
            if($numberpurpose == null || $numberpurpose == 0)
            {
                $numberpurpose = 0;
                $numberIssueID = 0;
                $sql = "select number FROM km_issue where IssueID = $issueId";
                $result = mysqli_query($link,$sql);
                while($row = mysqli_fetch_assoc($result))
                {
                  $numberIssueID = (float)$row['number'];
                }
                $numberpurpose = $numberpurpose + .1;
                $result_number = $numberIssueID + $numberpurpose;
            }else {
                $result_number = $numberpurpose + .1;
            }
                
                return (string)$result_number;
        }
        
        $id = $_POST['id'];
        $name = $_POST['name'];
        $agencyId = $_POST['agencyid']; 
        $userid = $_SESSION["id"];
        $issueId = $_POST['issueId'];

        $datetime = date('Y-m-d H:i:s');
        $sql = "";
        if($id == 0)
        { //INSERT        
            
            $number = _getNumber($issueId,$link);
            
            $sql = "INSERT INTO km_purpose (IssueID,Name,AgencyID,IsActive,CreateBy,CreateOn,UpdateBy,UpdateOn,Number)
            VALUES ('".$issueId."','".$name."','".$agencyId."','1','".$userid."','".$datetime."','".$userid."','".$datetime."','".$number."');";
           
          //  echo $sql; exit();
        }else{
            //Update
        //    echo $id; exit();
            $sql = "UPDATE  km_purpose
            SET Name = '$name',IssueID = $issueId
            WHERE PurposeID = $id";
         
        }
        mysqli_query($link,$sql);
        mysqli_close($link);
        header("location: ../purpose.php");

    }

?>