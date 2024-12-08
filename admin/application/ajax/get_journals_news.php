<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$sql = "SELECT * FROM journals_news where journals_news_id='$id'";
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
echo json_encode($row); 
?>