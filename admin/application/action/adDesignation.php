<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_POST);


$q="select max(order_b) as mxorder from designation";
$stmt = $conn->query($q);
$row=$stmt->fetchAssociative();
extract($row);
$order_b=$mxorder+1;

$data=array(
'designation'=>$designation,
'status'=>$status,
'order_b'=>$order_b
);
if($conn->insert('designation',$data)){
  header("refresh:0;url='../view/designation_master.php?success=1&msg=Designation Registered Successfully'");      
}
?>