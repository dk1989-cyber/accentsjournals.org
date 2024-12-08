<?php
 
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_POST);

//print_r($_POST);
$data=array(
'university'=>$euniversity,
'country'=>$ecountry,
'ustate'=>$estate,
'ucity'=>$ecity,
'uzip'=>$ezipcode,
'uaddress'=>$eaddress,
'status'=>$estatus);

$conn->update('ad_university',$data, ['ad_university_id' => $ad_university_id]);
header("refresh:0;url='../view/university_master.php?success=1&msg=University Updated Successfully'");      
 
?>