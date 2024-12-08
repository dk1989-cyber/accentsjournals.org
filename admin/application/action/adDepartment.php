<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_POST);


$q="select max(order_b) as mxorder from department";
$stmt = $conn->query($q);
$row=$stmt->fetchAssociative();
extract($row);
$order_b=$mxorder+1;

$data=array(
'department'=>$department,
'status'=>$status,
'order_b'=>$order_b
);
if($conn->insert('department',$data)){
  header("refresh:0;url='../view/department_master.php?success=1&msg=Department Registered Successfully'");      
}
?>