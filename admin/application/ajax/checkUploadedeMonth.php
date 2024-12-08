<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$sql = "SELECT GROUP_CONCAT(month) as m FROM issue where journals_id='$journal_id' and  year='$year'";
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
echo $row['m'];
?>