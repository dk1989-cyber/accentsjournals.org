<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$data=array(
'department'=>$edepartment,
'status'=>$estatus
);
$conn->update('department',$data, ['department_id' => $department_id]);
header("refresh:0;url='../view/department_master.php?success=1&msg=Department  Updated Successfully'");      
?>