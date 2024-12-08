<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_POST);
 

$ref=strip_tags($refference);
$pattern = '/\[(\d+)\]/'; // Regular expression pattern to match substrings starting with numbers inside square brackets
// Use preg_split to split the string based on the pattern
$substrings = preg_split($pattern,preg_replace("/[\r\n]*/","",$ref), -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
$reffrences=array();
$refdata=array();
foreach($substrings as $s){
  $cross="";
  $sch="";
  if(!is_numeric($s)){
    $s2=explode('Google Scholar:',$s);
    if(strpos($s,'DOI:')!==false){
     $s3=explode('DOI:',$s2[1]);  
    }
    array_push($reffrences,$s2[0]);
    if(isset($s3[0])){
      $sch=$s3[0];
    }
    if(isset($s3[1])){
      $cross="https://".$s3[1];
    }
    array_push($refdata,array('cross'=>$cross, 'sch'=>$sch));
  }  
}
$j=0;
foreach($reffrences as $ref){
    $dt[]=array('journalpaper_id'=>"1",'name'=>$ref,'crossRef'=>$refdata[$j]['cross'],'googleScholar'=>$refdata[$j]['sch']);
    $j=$j+1;
}
?>