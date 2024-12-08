<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$sql = "SELECT * FROM  ad_university where ad_university_id='$id'";
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
echo json_encode($row); 

?>