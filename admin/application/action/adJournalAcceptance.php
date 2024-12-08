<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_POST);

 


 
  if(!empty($countries)){
    $cntr=implode(',',$countries); 
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
'journals_id'=>$id,    
'volume_year'=>$year,
'totalpaper'=>$totalpaper,
'accepted'=>$accepted,
'rejected'=>$rejected,
'volume_year'=>$year,
'volume'=>$volume,
'countries_name'=>$cntry_name,
'countries'=>$cntr,
'record_type'=>"NEW"
);

if($conn->insert('paper_acceptance_rate',$data)){
  header("refresh:0;url='../view/journal_acceptance_rate.php?journals_id=$id&success=1&msg=Journal Registered Successfully'");      
}
?>