<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

$type=str_replace(' ', '_', $emenu_name);
$data=array(
'menu_name'=>$emenu_name,
'menu_url'=>$emenu_url,
'menu_url_back'=>$emenu_url_back,
'menu_type'=>$emenu_type,
'order_b'=>$eorder_b,
'status'=>$estatus,
'type'=>$type
);

$conn->update('temp_front_menu',$data, ['temp_front_menu_id' => $temp_front_menu_id]);
header("refresh:0;url='../view/menu-generate.php?success=1&msg=  Updated Successfully'");      
?>