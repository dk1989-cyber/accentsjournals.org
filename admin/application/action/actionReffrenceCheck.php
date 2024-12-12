<?php
ob_start();
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

$pattern = '/\[(\d+)\]./'; // Regular expression pattern to match substrings starting with numbers inside square brackets
// Use preg_split to split the string based on the pattern
$substrings = preg_split($pattern,preg_replace("/[\r\n]*/","",strip_tags($reffrence)), -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
$k=0; 
if(!isset($_SESSION["uniqid"])){
     $uniqid=uniqid();
     $_SESSION["uniqid"]=$uniqid;
}
else{
  $uniqid = $_SESSION["uniqid"];
  $conn->delete('ref_gen', ['unique_id' => $uniqid]);
  $conn->delete('ref_gen_author_id', ['unique_id' => $uniqid]);
}
$articles=array();
$i=1;
foreach($substrings as $s){
  if(!is_numeric($s)){
      $ref_data=check_type_data($s);
     // print_r($ref_data);
      
      $payload=array(
        "unique_id"=>$uniqid,
        "journal_name"=>$ref_data["journal"],
        "type"=>trim($ref_data["type"]),
        "year"=>trim($ref_data["year"]),
        "authors"=>$ref_data["authors"],
        "reffrence"=>$s,
        "position"=>$k
      );


      if($ref_data["type"]!="OTHERS"){
        $payload["title"]=trim($ref_data["title"]);
      }
      else{
        $payload["title"]="Un identified Refference $i";
        $i=$i+1;
      }

      $articles[] =strtolower($ref_data["title"]); 
      $conn->insert('ref_gen',$payload);
      $ref_gen_id=$conn->lastInsertId();  
      
      if($ref_data["authors"]!=""){
        $auths=explode(",",$ref_data["authors"]);
        foreach($auths as $ath ){
          $ath=trim($ath);
          if($ath!=="et al"){
              $q2="select * from gen_authors where author_name='$ath'";
              $stmt = $conn->query($q2);
              $row2=$stmt->fetchAssociative();
              if(!empty($row2)){
                $a_data=array("gen_authors_id"=>$row2['gen_authors_id'],"uniqid"=>$uniqid,"ref_gen_id"=>$ref_gen_id);
                $conn->insert('ref_gen_author',$a_data);
              }
              else{
                $a_data=array("author_name"=>$ath,"uniqid"=>$uniqid);
                $conn->insert('gen_authors',$a_data);
              }
           }
        }
      }

      $k=$k+1;
  } 
}


$firstOccurrence = [];
$relations = [];
foreach ($articles as $index => $article) {
  if (!isset($firstOccurrence[$article])) {
      // First time we see this string, mark its index
      $firstOccurrence[$article] = $index;
      $relations[$index] = []; // Initialize an empty array for relations
  } else {
      // String is a duplicate, link to the original
      $originalIndex = $firstOccurrence[$article];
      $relations[$originalIndex][] = $index;
  }
}

foreach ($relations as $originalIndex => $duplicates) {
  $right_position =$originalIndex;
  //$original=($right_position).":".$articles[$originalIndex];
  if (!empty($duplicates)) {
    $dup=array();
    foreach ($duplicates as $duplicateIndex) {
      $rightduplicate=$duplicateIndex;
      array_push($dup,$rightduplicate);
      $conn->update('ref_gen',array('is_original'=>'NO'),['unique_id' => $uniqid,'position'=>$duplicateIndex]);
    }
      $dupl=implode(",",$dup);
      $conn->update('ref_gen',array('is_original'=>'YES','duplication'=>$dupl),['unique_id' => $uniqid,'position'=>$originalIndex]);
  }
  else{
      $data=array('is_original'=>'YES');
      $conn->update('ref_gen',$data,['unique_id' => $uniqid,'position'=>$originalIndex]);
  }

}




function check_type_data($s){
  $e=explode(".",$s);
  $cnt=count($e);
  $index=$cnt-2;
  $data["journal"]="";
  $data["title"]="";
  $data["year"]="";
  $data["type"]="";
  $data["authors"]="";
  if(str_contains($e[$index],";")){
       $exp_sub=explode(";",$e[$index]);
       if($exp_sub[0]!=""){
             if(is_numeric($exp_sub[0])){
                  $author_list=$e[0];
                  $title=$e[1];
                  $journal_name=$e[2];
                  $year=$exp_sub[0];
                  $data["journal"]=$journal_name;
                  $data["title"]=$title;
                  $data["year"]=$year;
                  $data["authors"]=$author_list;
                  $data["type"]="JOURNAL";
             }
             else if(is_numeric($exp_sub[1])){
                if(str_contains($e[2],";")){ 
                      $author_list=$e[0];
                      $title=$e[1];
                      $journal_name=explode(";",$e[2])[0];
                      $year=$exp_sub[1];
                      $data["journal"]=$journal_name;
                      $data["title"]=$title;
                      $data["year"]=$year;
                      $data["authors"]=$author_list;
                      $data["type"]="BOOK";
                  }
                 else{
                    $data["type"]="OTHER";
                }
             }
             else{
              $cn=count($exp_sub)-1;
              $author_list=$e[0];
              $remove_year=array_pop($exp_sub);
              $journal_name=explode(";",$e[2])[0];
              $year=json_encode($exp_sub);
              $data["journal"]=$journal_name;
              $data["title"]=$e[1];
              $data["year"]=$remove_year;
              $data["authors"]=$author_list;
              $data["type"]="BOOK";
             }
            //  else if(is_numeric($exp_sub[1])){
            
            //  }
       }
       else if($exp_sub[0]==""){
            if(is_numeric($exp_sub[1])){
              if(str_contains($e[2],";")){ 
                $author_list=$e[0];
                $title=$e[1];
                $journal_name=explode($e[2],";")[0];
                $data["journal"]=$journal_name;
                $data["title"]=$title;
                $data["year"]=$exp_sub[1];
                $data["authors"]=$author_list;
                $data["type"]="BOOK";
              }
              else{
                $data["type"]="OTHER";
              }
            }
       }
  }
  else if(is_numeric($e[$index])){

       if(count($e)>4){
          $author_list=$e[0];
          $title=$e[1];
          $journal_name=$e[2];
          $data["journal"]=$journal_name;
          $data["authors"]=$author_list;
          $data["type"]="JOURNAL";
          $data["title"]=$title;
          $data["year"]=$e[$index];
       }
       else{

          $author_list=$e[0];
          $title=$e[1];
          $journal_name=$e[2];
          $data["journal"]="Not Found";
          $data["authors"]=$author_list;
          $data["type"]="JOURNAL";
          $data["title"]=$title;
          $data["year"]=$e[$index];

       }
  }
  else if(str_contains($e[$index],":")){
       if(str_contains($s,"(pp.")){
            $author_list=$e[0];
            $title=$e[1];
            $journal_name=$e[2];
            $data["title"]=$title;
            $j=str_replace("(pp","",$journal_name);
            $jour=substr($j,0,strlen($j)-5);
            $year=substr($j,-5);
            $data["year"]=$year;
            $data["journal"]=$jour;
            $data["authors"]=$author_list;
            $data["type"]="CONFERENCE";
        }
        else{
            $y=explode(":",$e[$index]);
            $author_list=$e[0];
            $title=$e[1];
            $journal_name=$e[2];
            $data["journal"]=$journal_name;
            $data["authors"]=$author_list;
            $data["year"]=$y[0];
            $data["title"]=$title;
            $data["type"]="JOURNAL";
        }
  }
  else if(str_contains($s,"(pp.")){
    $author_list=$e[0];
    $title=$e[1];
    $journal_name=$e[2];
    $data["title"]=$title;
    $j=str_replace("(pp","",$journal_name);
    $jour=substr($j,0,strlen($j)-5);
    $year=substr($j,-5);
    $data["year"]=$year;
    $data["journal"]=$jour;
    $data["authors"]=$author_list;
    $data["type"]="CONFERENCE";
   
  }
  else if(str_contains($s,"Accessed")){
    $cont=explode("Accessed",$s);
    $y=explode(" ",$cont[1]);
    $data["type"]="WEBSITE";
    $data["title"]=$cont[0];
    $data["journal"]="WEBSITE";
    $data["year"]=str_replace(".","",$y[3]);
  }

  else{
    $data["type"]="OTHERS";
  }

  return $data;
}

//header("refresh:0;url='../view/refference_check.php");

?>