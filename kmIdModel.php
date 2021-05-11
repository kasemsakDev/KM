<?php

function _getIdALL($id,$Action,$link){
    $Obj = new IdModel();
    switch ($Action) {
        case 'issue':
            
            break;
        case 'purpose':
            $IssueID = 0;
            $PurposeID = 0;
            $IndicatorID = 0;
            $StrategyID = 0;
            $ProjectID = 0;
            $SunitID = 0;
            $SunitDetailID = 0;
            $sql = "";
            $sql = "SELECT SunitDetailID FROM  km_sunitdetail
            inner join km_sunit on km_sunitdetail.SunitID = km_sunit.SunitID
            inner join km_project on km_sunit.ProjectID = km_project.ProjectID
            inner join km_strategy on km_strategy.StrategyID = km_project.StrategyID
            inner join km_indicator on km_strategy.IndicatorID = km_indicator.IndicatorID
            inner join km_purpose on km_purpose.PurposeID = km_indicator.PurposeID
            where km_indicator.PurposeID = $id";
            $result =  mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
                   $SunitDetailID = $row['SunitDetailID'];
            }

            $sql = "SELECT SunitID FROM  km_sunit 
            INNER JOIN km_project on km_project.ProjectID = km_sunit.ProjectID
            INNER JOIN km_strategy on km_strategy.StrategyID = km_project.StrategyID
            INNER JOIN km_indicator on km_strategy.IndicatorID = km_indicator.IndicatorID
            inner join km_purpose on km_purpose.PurposeID = km_indicator.PurposeID
            where km_indicator.PurposeID = $id";
            $result =  mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
                   $SunitID = $row['SunitID'];
            }

            $sql = "SELECT SunitID FROM  km_sunit 
            INNER JOIN km_project on km_project.ProjectID = km_sunit.ProjectID
            INNER JOIN km_strategy on km_strategy.StrategyID = km_project.StrategyID
            INNER JOIN km_indicator on km_strategy.IndicatorID = km_indicator.IndicatorID
            inner join km_purpose on km_purpose.PurposeID = km_indicator.PurposeID
            where km_indicator.PurposeID = $id";
            $result =  mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
                   $SunitID = $row['SunitID'];
            }

            $sql = "SELECT ProjectID FROM  km_project 
            INNER JOIN km_strategy on km_strategy.StrategyID = km_project.StrategyID
            INNER JOIN km_indicator on km_strategy.IndicatorID = km_indicator.IndicatorID
            inner join km_purpose on km_purpose.PurposeID = km_indicator.PurposeID
            where km_indicator.PurposeID = $id";
            $result =  mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
                   $ProjectID = $row['ProjectID'];
            }

            $sql = "SELECT StrategyID   FROM km_strategy
            INNER JOIN km_indicator on km_strategy.IndicatorID = km_indicator.IndicatorID
            inner join km_purpose on km_purpose.PurposeID = km_indicator.PurposeID
            where km_indicator.PurposeID = $id";
            $result =  mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
                {
                    $StrategyID = $row['StrategyID'];
                }
            
                $sql = "SELECT IndicatorID FROM  km_indicator
                inner join km_purpose on km_purpose.PurposeID = km_indicator.PurposeID
                where km_indicator.PurposeID = $id";
                $result =  mysqli_query($link,$sql);
                while($row = mysqli_fetch_assoc($result))
                    {
                        $IndicatorID = $row['IndicatorID'];
                    }

                    $Obj->IssueID=$IssueID;
                    $Obj->PurposeID=$id;
                    $Obj->IndicatorID=$IndicatorID;
                    $Obj->StrategyID=$StrategyID;
                    $Obj->ProjectID=$ProjectID;
                    $Obj->SunitID=$SunitID;
                    $Obj->SunitDetailID=$SunitDetailID;

            break;
        case 'indicator':      
            $IssueID = 0;
            $PurposeID = 0;
            $IndicatorID = 0;
            $StrategyID = 0;
            $ProjectID = 0;
            $SunitID = 0;
            $SunitDetailID = 0;
            $sql = "";
            $sql = "SELECT SunitDetailID FROM  km_sunitdetail
            inner join km_sunit on km_sunitdetail.SunitID = km_sunit.SunitID
            inner join km_project on km_sunit.ProjectID = km_project.ProjectID
            inner join km_strategy on km_strategy.StrategyID = km_project.StrategyID
            inner join km_indicator on km_strategy.IndicatorID = km_indicator.IndicatorID
            where km_indicator.IndicatorID = $id";
            $result =  mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
                   $SunitDetailID = $row['SunitDetailID'];
            }
        
            //-Del Sunit
            $sql = "SELECT SunitID FROM  km_sunit 
            INNER JOIN km_project on km_project.ProjectID = km_sunit.ProjectID
            INNER JOIN km_strategy on km_strategy.StrategyID = km_project.StrategyID
            INNER JOIN km_indicator on km_strategy.IndicatorID = km_indicator.IndicatorID
            Where km_indicator.IndicatorID = $id";
            $result =  mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
                   $SunitID = $row['SunitID'];
            }
            //-Del project
            $sql = "SELECT ProjectID FROM  km_project 
            INNER JOIN km_strategy on km_strategy.StrategyID = km_project.StrategyID
            INNER JOIN km_indicator on km_strategy.IndicatorID = km_indicator.IndicatorID
            Where km_indicator.IndicatorID = $id";
            $result =  mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
                   $ProjectID = $row['ProjectID'];
            }
            //-Del strategy
            $sql = "SELECT StrategyID   FROM km_strategy
            INNER JOIN km_indicator on km_strategy.IndicatorID = km_indicator.IndicatorID
            Where km_indicator.IndicatorID = $id";
            $result =  mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
                {
                    $StrategyID = $row['StrategyID'];
                }
        
            //-Del indicator
            $sql = "SELECT IndicatorID FROM  km_indicator
            Where km_indicator.IndicatorID = $id";
            $result =  mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
                {
                    $IndicatorID = $row['IndicatorID'];
                }
                $Obj->IssueID=$IssueID;
                $Obj->PurposeID=$PurposeID;
                $Obj->IndicatorID=$IndicatorID;
                $Obj->StrategyID=$StrategyID;
                $Obj->ProjectID=$ProjectID;
                $Obj->SunitID=$SunitID;
                $Obj->SunitDetailID=$SunitDetailID;


            break;
        case 'strategy':

            $IssueID = 0;
            $PurposeID = 0;
            $IndicatorID = 0;
            $StrategyID = 0;
            $ProjectID = 0;
            $SunitID = 0;
            $SunitDetailID = 0;
            $sql = "";
            $sql = "SELECT SunitDetailID FROM km_sunitdetail
            inner join km_sunit on km_sunitdetail.SunitID = km_sunit.SunitID
            inner join km_project on km_sunit.ProjectID = km_project.ProjectID
            inner join km_strategy on km_strategy.StrategyID = km_project.StrategyID
            where km_strategy.StrategyID = $id";
            $result =  mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result))
                 {
                    $SunitDetailID = $row['SunitDetailID'];
                 }
    
            //Delete km_sunit 
            $sql = "SELECT SunitID  FROM km_sunit 
            INNER JOIN km_project on km_project.ProjectID = km_sunit.ProjectID
            INNER JOIN km_strategy on km_strategy.StrategyID = km_project.StrategyID
            WHERE km_strategy.StrategyID = $id";
              $result =  mysqli_query($link,$sql);
                while($row = mysqli_fetch_assoc($result))
                   {
                     $SunitID = $row['SunitID'];
                   }

            $Obj->IssueID=$IssueID;
            $Obj->PurposeID=$PurposeID;
            $Obj->IndicatorID=$IndicatorID;
            $Obj->StrategyID=$StrategyID;
            $Obj->ProjectID=$ProjectID;
            $Obj->SunitID=$SunitID;
            $Obj->SunitDetailID=$SunitDetailID;

            break;
            
            default:
    }
        return $Obj;
}

class IdModel {
    public $IssueID = 0;
    public $PurposeID = 0;
    public $IndicatorID = 0;
    public $StrategyID = 0;
    public $ProjectID = 0;
    public $SunitID = 0;
    public $SunitDetailID = 0;
}





?>