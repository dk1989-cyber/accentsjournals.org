<?php
include '../vendor/autoload.php';
include "../config/config.php";
extract($_REQUEST);
$sql = "SELECT latest_info,article_press_info,most_download_info,most_view_info,most_cite_info FROM journals where journals_id='$jid'";
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
$arr = array_map('utf8_encode', $row);
 echo json_encode($arr);
?>