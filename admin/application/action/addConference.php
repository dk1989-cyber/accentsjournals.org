<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_POST);


$title=slugify($title);
$data=array(
'title'=>$title,
'dates'=>$dates,
'location'=>$location,
'city'=>$city,
'discription'=>$discription,
'type'=>$type,
'short_title'=>$short_title
);

if($conn->insert('conference',$data)){
  header("refresh:0;url='../view/add_conference.php?success=1&msg=Conference Registered Successfully'");      
}
?>