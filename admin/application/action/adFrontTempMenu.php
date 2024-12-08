<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_POST);

$sql="select max(order_b) as mxorder from temp_front_menu";
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
extract($row);
$order_b=$mxorder+1;
$data=array(
'menu_name'=>$menu_name,
'menu_url'=>$menu_url,
'menu_url_back'=>$menu_url_back,
'menu_type'=>$menu_type,
'order_b'=>$order_b,
'status'=>$status
);
if($conn->insert('temp_front_menu',$data)){
  header("refresh:0;url='../view/menu-generate.php?success=1&msg=  Registered Successfully'");      
}
?>