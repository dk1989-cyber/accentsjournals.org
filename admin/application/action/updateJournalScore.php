<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
    $data=array(
    'google_scholar_v'=>$google_scholar_v,
    'google_scholar_link'=>$google_scholar_link,
    'citation_v'=>$citation_v,
    'citation_link'=>$citation_link,
    'impact_factor_v'=>$impact_factor_v,
    'impact_factor_link'=>$impact_factor_link);

     $conn->update('journals',$data, ['journals_id' => $id]);
    header("refresh:0;url='../view/journal_score.php?journals_id=$id&success=1&msg=User Update Successfully'");      

?>