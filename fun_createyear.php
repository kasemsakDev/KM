<?php 
function UpdateYear($year,$link){
    //check year in db
    $sql = "select * from km_year where km_year.YearName = '$year'";
    $result =  mysqli_query($link,$sql);
    if (mysqli_num_rows($result) == 0) {// Not have year in db
        //Create year.DB in $year
        $sql = "INSERT INTO km_year (YearName,IsActive)
        VALUES ('$year',1);";
        mysqli_query($link,$sql);
    }
}

?>