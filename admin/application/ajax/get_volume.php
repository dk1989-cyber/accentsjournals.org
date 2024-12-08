<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$sql = "SELECT distinct volume FROM  issue where year='$year' and journals_id='$journals_id'";
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
echo json_encode($row); 

?>