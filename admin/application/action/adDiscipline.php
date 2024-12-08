<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_POST);

$q="select max(order_b) as mxorder from discipline";
$stmt = $conn->query($q);
$row=$stmt->fetchAssociative();
extract($row);
$order_b=$mxorder+1;
$data=array(
'discipline'=>$discipline,
'status'=>$status, 
'order_b'=>$order_b
);
if($conn->insert('discipline',$data)){
  header("refresh:0;url='../view/discipline_master.php?success=1&msg=Discipline Registered Successfully'");      
}
?>