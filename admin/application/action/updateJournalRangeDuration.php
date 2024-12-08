<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

$v_f=date("Y-m-d",strtotime($view_range_from));
$v_t=date("Y-m-d",strtotime($view_range_to));
$d_f=date("Y-m-d",strtotime($download_range_from));
$d_t=date("Y-m-d",strtotime($download_range_to));

$data=array(
    'view_range_from'=>$v_f,
    'view_range_to'=>$v_t,
    'download_range_from'=>$d_f,
    'download_range_to'=>$d_t,
    'latest_info'=>$latest_info,
    'article_press_info'=>$article_press_info,
    'most_download_info'=>$most_download_info,
    'most_view_info'=>$most_view_info,
    'most_cite_info'=>$most_cite_info
    );
   $conn->update('journals',$data, ['journals_id' => $id]);
   header("refresh:0;url='../view/journal_duration_view_download.php?journals_id=$id&success=1&msg=User Update Successfully'");      

?>