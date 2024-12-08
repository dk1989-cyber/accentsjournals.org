<?php
error_reporting(1);
include '../vendor/autoload.php';
include "../config/config.php";
extract($_REQUEST);
if($mode=="paper"){
$sql = "SELECT citation,citation_mla,citation_apa,citation_h,citation_ieee FROM journalpaper where journalpaper_id='$id'";
}
else{
    $sql = "SELECT citation,citation_mla,citation_apa,citation_h,citation_ieee FROM press_paper where press_paper_id='$id'"; 
}
 
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
$arr = array_map('utf8_encode', $row);
echo json_encode($arr);


?>