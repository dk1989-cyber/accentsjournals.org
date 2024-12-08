<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$data=array('status'=>$sts);
$conn->update('front_menu',$data, ['front_menu_id' => $id]);
?>