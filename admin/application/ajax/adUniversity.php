<?php
 
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);


$q="select * from  ad_university where LOWER(university)=LOWER('$university') and ucity='$city'";

$stmt = $conn->query($q);
$row=$stmt->fetchAll();
if(count($row)==0){
$data=array(
'university'=>$university,
'country'=>$country,
'ustate'=>$state,
'ucity'=>$city,
'uzip'=>$zipcode,
'uaddress'=>$address,
'status'=>'Enable');
if($conn->insert('ad_university',$data)){
  echo $conn->lastInsertId();
}
else{
  echo 0;
}
}
else{
  echo -1;
}
?>