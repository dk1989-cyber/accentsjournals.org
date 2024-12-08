<?php
ob_start();
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

$pattern = '/\[(\d+)\]./'; // Regular expression pattern to match substrings starting with numbers inside square brackets
// Use preg_split to split the string based on the pattern
$substrings = preg_split($pattern,preg_replace("/[\r\n]*/","",$reffrence), -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
$i=1; 
foreach($substrings as $s){
 
  if(!is_numeric($s)){
  
    echo $i.$s."<b>".check_type($s)."</b><br/><br/>";
    $i=$i+1; 
  }

  if(!is_numeric($s)){
    if(check_type($s)=="JOURNAL"){
      $reffrence_list[]=$s;
      $aut=explode(".",$s);
      $authors_list[]=$aut[0];
      $paper_list[]=$aut[1];
      $journal_list[]=$aut[2];
      $year=explode(";",$aut[3])[0];
      if(is_numeric($year)){
          $yearlist[]=$year;
      }
      $type[]="JOURNAL";
      $link[]="";
    }
    if(check_type($s)=="WEBSITE"){
      $authors_list[]="";
      $paper_list[]="";
      $journal_list[]="";
      $type[]="WEBSITE";
      $auth=explode(" ",$s);
      $link[]=$auth[0];
      $year=$auth[count($auth)-3]."-".$auth[count($auth)-2]."-".$auth[count($auth)-1];
      $yearlist[]=$year;
    }
  } 

}



// sort($yearlist);
// $res=array_count_values($yearlist);
// foreach($res as  $key => $value){
//    echo $key."=>".$value;
// }


$counts = array_count_values($paper_list);
$duplicates = array_filter($counts, function ($count) {
    return $count > 1;
});


// Display duplicates
foreach ($duplicates as $article => $count) {
   // echo "$article => $count <br/>";
}


function check_type($s){
  $e=explode(".",$s);
 // print_r($e);
  $cnt=count($e);
  $index=$cnt-2;
  if(str_contains($e[$index],";")){
       $exp_sub=explode(";",$e[$index]);
       if($exp_sub[0]!=""){
             if(is_numeric($exp_sub[0])){
                 return "JOURNAL";
             }
             else{
               return "".$exp_sub[0];
             }
       }
       else if($exp_sub[0]==""){
        if(is_numeric($exp_sub[1])){
          return "BOOK";
        }
       }
  }
  else if(str_contains($e[$index],":")){
    return "JOURNAL With :";
  }
  else if(str_contains($s,"(pp.")){
    return "CONFERENCE";
  }
  else if(str_contains($s,"www")){
     return "WEBSITE";
  }
  else{
    return "OTHERS";
  }
}

 
?>