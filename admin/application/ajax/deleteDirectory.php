<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

$paths="../../../PaperDirectory/Journal/$abbri/";
$files1 = scandir($paths);
if($files1!=""){
    
$cnt= count($files1);
if(is_array($files1)){
    if($cnt<=3){
        deleteDirectory($paths);
    }
    else{
        
        $p=$paths."/".$year."/";
        if(file_exists($p)){
            
             $files2 = scandir($p);
             $cnt= count($files2);
                if($cnt<=3){
                     deleteDirectory($p);
                }
                else{
                    $p_m=$paths."/".$year."/".$month;
                    deleteDirectory($p_m);
                } 
        }
    }
  }
}

 
//deleteDirectory($paths);
$conn->delete('issue', ['issue_id' => $id]);
$conn->delete('journalpaper', ['issue_id' => $id]);

$q1="select max(issue_id) as isu_id from issue where journals_id='$journals_id'";
$stmt = $conn->query($q1);
$row=$stmt->fetchAssociative();
$isu_id=$row["isu_id"];

$q="update issue set status='Current' where issue_id='$isu_id'";
$conn->executeStatement($q);
?>