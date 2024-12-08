<?php
 
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_POST);

$data=array(
'university'=>$university,
'country'=>$country,
'ustate'=>$state,
'ucity'=>$city,
'uzip'=>$zipcode,
'uaddress'=>$address,
'status'=>'Enable');

 
if($conn->insert('ad_university',$data)){
  header("refresh:0;url='../view/university_master.php?success=1&msg=University Registered Successfully'");      
}
?>