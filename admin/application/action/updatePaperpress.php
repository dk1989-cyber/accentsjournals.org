<?php
      session_start();
      require_once '../../../vendor/autoload.php';
      require_once "../../../config/config.php";
      extract($_REQUEST);

      $accepted_date=date('Y-m-d',strtotime($accepted_date));
      $revised_date=date('Y-m-d',strtotime($revised_date));
      $recieved_date=date('Y-m-d',strtotime($recieved_date));
      $j_id=explode('#',$journals_id);
      $data=array(
      'journals_id'=>$j_id[0], 
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
      'type'=>"");
 
        $abbri=$j_id[1];
        $paths="../../../PaperDirectory/Journal/$abbri/press/";
        if (!empty($_FILES['full_graphical_abstract']["name"])){
            if(in_array($_FILES['full_graphical_abstract']['type'], $acceptable_img)){
              $file=date('ymdhiu').$_FILES["full_graphical_abstract"]["name"];
              $s_path = $_FILES["full_graphical_abstract"]["tmp_name"];
              $d_path = "$paths".$file;
              $data["paperimage"]=$file;
              move_uploaded_file($s_path,$d_path);
            }
        }
        if (!empty($_FILES['full_paper']["name"])){
            if(in_array($_FILES['full_paper']['type'], $acceptable_doc)){
              $file=date('ymdhiu').$_FILES["full_paper"]["name"];
              $s_path = $_FILES["full_paper"]["tmp_name"];
              $d_path = "$paths".$file;
              $data["fullpaper"]=$file;
              move_uploaded_file($s_path,$d_path);
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
            $cross="https://doi.org/".$s3[1];
            }
            array_push($refdata,array('cross'=>$cross, 'sch'=>$sch));
        }  
        }
        $conn->update('press_paper',$data,['press_paper_id' => $id]);
        if(1){
        $conn->delete('authornamespp', ['press_paper_id' => $id]);
        $conn->delete('refrencep', ['press_paper_id' => $id]);
        $k=1;
        $n=$no_authors-1;
        $n2=$no_authors-2;
        $authors="";
        if(isset($first_name)){
                    $i=0;
                    foreach($first_name as $fname){
                        $fname=$first_name[$i];
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
                     
                        $dt=array('press_paper_id'=>$id,'
                        firstname'=>$fname,
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
                         $conn->insert('authornamespp',$dt);
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
                 $k=$k+1; 
                 $q4="select jp.*,u.*,c.name as cntry,st.name as stat,dep.department,des.designation from authornamespp jp 
                 LEFT JOIN ad_university u ON  jp.university_id=u.ad_university_id
                 LEFT JOIN department dep ON dep.department_id=jp.department_id
                 LEFT JOIN designation des ON des.designation_id=jp.designation_id
                 LEFT JOIN country c ON c.country_id=u.country
                 LEFT JOIN states st ON st.states_id=u.ustate where jp.authornamespp_id='$lid'";
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
                       "state"=>$row4["stat"]);
                  }
                  
                  $uarray=array_unique($mydata,SORT_REGULAR);
                    foreach($uarray as $u){
                       $new_array[]=$u;
                  }
                
                  $json=json_encode($new_array,JSON_INVALID_UTF8_IGNORE); 
                   $conn->update('press_paper',array("authors"=>$authors,"json_data"=>$json), ['press_paper_id' => $id]);     
        }
        $j=0;
        foreach($reffrences as $ref){
            $dt=array('press_paper_id'=>$id,'name'=>$ref,'crossref'=>$refdata[$j]['cross'],'googlescholar'=>$refdata[$j]['sch']);
            $conn->insert('refrencep',$dt);
          $j=$j+1;  
       }
  header("refresh:0;url='../view/edit_press_paper.php?id=$id&success=1&msg=Article Press Updated Successfully'");      
}
?>