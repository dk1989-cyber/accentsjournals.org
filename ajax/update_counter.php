<?php
include '../vendor/autoload.php';
include "../config/config.php";
extract($_REQUEST);
if($type=="paper"){
    if($mode=="view"){
        $q="update journalpaper  set views_count=views_count+1 where journalpaper_id='$id'";
        $conn->executeStatement($q);
        $sql = "SELECT jp.fullpaper,views_count,jp.record_type,i.year,i.month,j.journal_abbri FROM journalpaper jp
        LEFT JOIN issue i ON jp.issue_id=i.issue_id
        LEFT JOIN journals j ON i.journals_id=j.journals_id
        where jp.journalpaper_id='$id'";
        $stmt = $conn->query($sql);
        $row=$stmt->fetchAssociative();
        $j_arry=array("total_count"=>$row["views_count"],"path"=>"");
        echo json_encode($j_arry);
    }
    else{

        $q="update journalpaper  set download_count=download_count+1 where journalpaper_id='$id'";
        $conn->executeStatement($q);
        $sql = "SELECT jp.fullpaper,download_count,jp.record_type,i.year,i.month,j.journal_abbri FROM journalpaper jp
        LEFT JOIN issue i ON jp.issue_id=i.issue_id
        LEFT JOIN journals j ON i.journals_id=j.journals_id
        where jp.journalpaper_id='$id'";
        $stmt = $conn->query($sql);
        $row=$stmt->fetchAssociative();
        extract($row);
        $m=$month+1;    
        if($record_type=="NEW"){
        $file=base_url('PaperDirectory/Journal/')."$journal_abbri/$year/$m/$fullpaper";
        }
        else{
            $file=$fullpaper;
        }
        $j_arry=array("total_count"=>$row["download_count"],"path"=>$file);
        echo json_encode($j_arry);
    }
}


//echo $r;
?>