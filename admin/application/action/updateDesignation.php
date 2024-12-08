<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$data=array(
'designation'=>$edesignation,
'status'=>$estatus
);

$conn->update('designation',$data, ['designation_id' => $designation_id]);
header("refresh:0;url='../view/designation_master.php?success=1&msg=Designation  Updated Successfully'");      
?>