<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$q="select distinct volume from  issue where year = '$year' and journals_id='$journal_id'";
$stmt = $conn->query($q);
$row=$stmt->fetchAssociative();
if($row!=""){
    if(count($row)==1){
        if($row["volume"]==$volume){
            echo "1";
        }
        else{
            echo "0";
        }
    }
}
else
{
    $q="select count(*) as cnt  from  issue where volume = '$volume' and journals_id='$journal_id'";
    $stmt = $conn->query($q);
    $row=$stmt->fetchAssociative();
    if($row!=""){
        extract($row);
        if($cnt>0){
            echo "2";
        }
        else{
            echo "1";
        }
    }
    else{
        echo "1";
    }
}

?>