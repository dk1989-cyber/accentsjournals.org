<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

 
    $data=array(
    'title'=>$title,
    'short_title'=>$short_title,
    'dates'=>$dates,
    'location'=>$location,
    'city'=>$city,
    'discription'=>$discription,
    'type'=>$type
);
    
 
 
   $conn->update('conference',$data, ['conference_id' => $conference_id]);
   header("refresh:0;url='../view/view_conference.php?success=1&msg=User Update Successfully'");      

?>