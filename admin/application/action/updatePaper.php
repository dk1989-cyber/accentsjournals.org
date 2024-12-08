<?php
 
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_POST);
 
$accepted_date=date('Y-m-d',strtotime($accepted_date));
$revised_date=date('Y-m-d',strtotime($revised_date));
$recieved_date=date('Y-m-d',strtotime($recieved_date));
 
$data=array(
    'paper_id'=>$paper_id,
    'title'=>$paper_title,
    'no_authors'=>$no_authors, 
    'abstract'=>$abstract, 
    'keyword'=>$keywords,
    'page_no_start'=>$page_no_start,
    'page_no_end'=>$page_no_end, 
    'doi'=>$doi, 
    'doilink'=>$doilink,
    'article_type_id'=>$article_type, 
    'refference'=>$refference, 
    'recieved_date'=>$recieved_date,
    'revised_date'=>$revised_date,
    'accepted_date'=>$accepted_date, 
    'discipline'=>$discipline,
    'citation'=>$citation,
    'citation_mla'=>$citation_mla,
    'citation_apa'=>$citation_apa,
    'citation_ieee'=>$citation_ieee,
    'citation_h'=>$citation_h,
    'type'=>$type);
    
    if(isset($modification_type)){
    if($modification_type!=""){ 
        $q="select modification_stage from journalpaper where journalpaper_id='$id'";
        $stmt = $conn->query($q);
        $i=1;
        $row=$stmt->fetchAssociative();
        $data["modification_type"]=$modification_type;
        if($row['modification_stage']==""){
             $data["modification_stage"]="BEFORE";
        }
        $data["link_url"]=$link_url;
        $data['modification_message']=$modification_message;
        $data['modifi_alert_message']=$modifi_alert_message;
    }
   }
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

    $m=$month+1;   
    $paths="../../../PaperDirectory/journal/$abbri/$year/$m/";
    if (!empty($_FILES['full_graphical_abstract']["name"])){
      if(in_array($_FILES['full_graphical_abstract']['type'], $acceptable_img)){
          $file=$_FILES["full_graphical_abstract"]["name"];
          $s_path = $_FILES["full_graphical_abstract"]["tmp_name"];
          $oldpath=$paths.$old_full_graphical_abstract;
          unlink($oldpath);
          $d_path = "$paths".$file; 
          $data["full_graphical_abstract"]=$file;
          $data["paperimage"]=$file;
          move_uploaded_file($s_path,$d_path);
      }
   }
   if (!empty($_FILES['full_paper']["name"])){
       if(in_array($_FILES['full_paper']['type'], $acceptable_doc)){
          $file=$_FILES["full_paper"]["name"];
          $s_path = $_FILES["full_paper"]["tmp_name"];
          $oldpath=$paths.$old_fullpaper;
          unlink($oldpath);
          $d_path = "$paths".$file;
          $data["fullpaper"]=$file;
          move_uploaded_file($s_path,$d_path);
       }
  }
  if($no_authors!=""&&$no_authors!=0){   
  $authors="";
  $n=$no_authors-1;
  $n2=$no_authors-2;
  $k=1;
  $arr=array_unique($university);
  $aruni=implode(",",$arr);  
  $data["universitylists"]=$aruni;
}

$conn->update('journalpaper',$data,['journalpaper_id' => $id]);
   if(1){
        $conn->delete('authornamesjp', ['journalpaper_id' => $id]);
        $conn->delete('refrence', ['journalpaper_id' => $id]);
      
         if(isset($first_name)){
            $i=0;
            foreach($first_name as $fname){
                $l_name=$last_name[$i];
                $m_name=$middle_name[$i];
                $l_name=$last_name[$i];
                $d_name=$department[$i];
                $orid=$orcid[$i];
                $scopid=$scopus_id[$i];
                $uni=$university[$i];
                $desig=$designation[$i];
                $affil=$affilation[$i];
                $mail=$email[$i]; 
                if(isset($is_corresponding[$i])){
                  $is_corresponding=1;
                } 
                else{
                  $is_corresponding=0;
                }   
                $dt=array(
                
                'journalpaper_id'=>$id,
                'journals_id'=>$journals_id,
                'issue_id'=>$issue_id,
                'year'=>$year,
                'firstname'=>$fname,
                'middlename'=>$m_name,
                'lastname'=>$l_name,
                'orcid'=>$orid,
                'scoupus_id'=>$scopid,
                'university_id'=>$uni,
                'department_id'=>$d_name,
                'designation_id'=>$desig,
                'email'=>$mail,
                'is_corresponding'=>$is_corresponding,
                'affilation'=>$affil);
                $conn->insert('authornamesjp',$dt);
                $lid=$conn->lastInsertId();  
                $m=($m_name!="")?$m_name." ":"";
                if($no_authors>1){
                      if($i==$n){
                        $authors.=" and ".$fname." ".$m.$l_name."";
                      }
                      if($i==$n2){
                          $authors.="".$fname." ".$m.$l_name."";
                      }
                      else if($i<$n2){
                        $authors.="".$fname." ".$m.$l_name.",";
                    }
                  }
                  else{
                    $authors.=$fname." ".$m.$l_name."";
                   }
                   
                   $i=$i+1;  

                    $q4="select jp.*,u.*,c.name as cntry,st.name as stat,dep.department,des.designation from authornamesjp jp 
                    LEFT JOIN ad_university u ON  jp.university_id=u.ad_university_id
                    LEFT JOIN department dep ON dep.department_id=jp.department_id
                    LEFT JOIN designation des ON des.designation_id=jp.designation_id
                    LEFT JOIN country c ON c.country_id=u.country
                    LEFT JOIN states st ON st.states_id=u.ustate where jp.authornamesjp_id='$lid'";
                    $stmt4 = $conn->query($q4);
                    $row4=$stmt4->fetchAssociative();
                 
                    $mydata[]=array(
                          "university_id"=>$row4["ad_university_id"],
                          "department_id"=>$row4["department_id"],
                          "designation_id"=>$row4["designation_id"],
                          "affilation"=>$row4["affilation"],
                          "university_name"=>$row4["university"],
                          "department_name"=>$row4["department"],
                          "designation_name"=>$row4["designation"],
                          "country"=>$row4["cntry"],
                          "state"=>$row4["stat"]
                    );
              //$i=$i+1;              
              }
              
                $uarray=array_unique($mydata,SORT_REGULAR);
                foreach($uarray as $u){
                      $new_array[]=$u;
                }
                
               $json=json_encode($new_array,JSON_INVALID_UTF8_IGNORE); 
               $conn->update('journalpaper',array("authors"=>$authors,"json_data"=>$json), ['journalpaper_id' => $id]);     
         }            
         $j=0;
        foreach($reffrences as $ref){
            $ref=str_replace("&nbsp;","",$ref);
            $dt=array('journalpaper_id'=>$id,'name'=>$ref,'crossref'=>$refdata[$j]['cross'],'googlescholar'=>$refdata[$j]['sch']);
            $conn->insert('refrence',$dt);
          $j=$j+1;  
       }
      
      header("refresh:0;url='../view/edit_paper.php?id=$id&success=1&msg=User Updated Successfully'");      
    }
  
?>