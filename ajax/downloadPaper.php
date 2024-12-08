<?php
include '../vendor/autoload.php';
include "../config/config.php";
extract($_REQUEST);
$sql = "SELECT jp.fullpaper,jp.record_type,i.year,i.month,j.journal_abbri FROM journalpaper jp
LEFT JOIN issue i ON jp.issue_id=i.issue_id
LEFT JOIN journals j ON i.journals_id=j.journals_id
where jp.journalpaper_id='$id'";

$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
extract($row);
if($record_type=="NEW"){
$m=$month+1;    
$file="../PaperDirectory/Journal/$journal_abbri/$year/$m/$fullpaper";
header("Cache-Control: public");
header("Content-Description: File Transfer");
// header("Content-Disposition: attachment; filename=".$file."");
 header("Content-Transfer-Encoding: binary");
 header("Content-Type: binary/octet-stream");
// It will be called downloaded.pdf
header("Content-Disposition: attachment; filename=$file");
// The PDF source is in original.pdf
 
readfile($file);
} 
else{
//$r="../$fullpaper";
}

//echo $r;
?>