<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

// print_r($ecountries);
// die();
   
    if(!empty($ecountries)){
    $cntr=implode(',',$ecountries); 
    $q1="select GROUP_CONCAT(`name`) as cntry  from country where country_id IN ($cntr)";
    $stmt = $conn->query($q1);
    $row=$stmt->fetchAssociative();
    $cntry_name=$row['cntry'];
    }
    else{
        
         $cntry_name="";
         $countries_name="";
    }
    
    $data=array(
      'totalpaper'=>$etotalpaper,
      'accepted'=>$eaccepted,
      'rejected'=>$erejected,
      'countries_name'=>$cntry_name,
      'countries'=>$cntr
   );
   $conn->update('paper_acceptance_rate',$data, ['paper_acceptance_rate_id' => $id]);
   header("refresh:0;url='../view/journal_acceptance_rate.php?journals_id=$journal_id&success=1&msg=User Update Successfully'");      

?>