<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$data=array(
'article_type'=>$earticle_type,
'status'=>$estatus
);
$conn->update('article_type',$data, ['article_type_id' => $article_type_id]);
header("refresh:0;url='../view/article_type_master.php?success=1&msg=Article Type Updated Successfully'");      
?>