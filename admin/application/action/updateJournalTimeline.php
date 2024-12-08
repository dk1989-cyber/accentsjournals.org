<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
    $data=array(
    'timeline'=>$timeline,
    'm_turn_arround_time'=>$m_turn_arround_time,
    'editorial_review_duration'=>$editorial_review_duration,
    'first_review_duration'=>$first_review_duration,
    'over_s_to_d'=>$over_s_to_d,
    'rev_duration'=>$rev_duration,
    'publication_duration'=>$publication_duration,
    'abstract_indexing'=>$abstract_indexing,
    'acceptance_rate'=>$acceptance_rate
    );
   $conn->update('journals',$data, ['journals_id' => $id]);
   header("refresh:0;url='../view/journal_timeline.php?journals_id=$id&success=1&msg=User Update Successfully'");      

?>