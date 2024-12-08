<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$data=array(
'content'=>$content
);
$conn->update('content',$data, ['type' => $type]);
header("refresh:0;url='../view/other_content.php?type=$type&success=1&msg=Department  Updated Successfully'");      
?>