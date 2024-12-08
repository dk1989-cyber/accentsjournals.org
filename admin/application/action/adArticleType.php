<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_POST);

$sql="select max(order_b) as mxorder from article_type";
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
extract($row);
$order_b=$mxorder+1;
$data=array(
'article_type'=>$article_type,
'status'=>$status,
 'order_b'=>$order_b
);
if($conn->insert('article_type',$data)){
  header("refresh:0;url='../view/article_type_master.php?success=1&msg=Article Type Registered Successfully'");      
}
?>