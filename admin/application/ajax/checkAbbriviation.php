<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$q="select * from  journals where LOWER(`journal_abbri`)=LOWER('$abbri')";
$stmt = $conn->query($q);
$row=$stmt->fetchAll();
if(count($row)==0){
echo "1";
}
else{
echo "0";
}
?>