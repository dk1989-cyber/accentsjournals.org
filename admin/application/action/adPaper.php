<?php
ob_start();
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

$issue=$_SESSION["PAPER_ISSUID"];
$accepted_date=date('Y-m-d',strtotime($accepted_date));
$revised_date=date('Y-m-d',strtotime($revised_date));
$recieved_date=date('Y-m-d',strtotime($recieved_date));
$jid=$_SESSION["PAPER_JID"];
$year= $_SESSION["PAPER_YEAR"];
 


$cnd=array();
if (!empty($_FILES['full_graphical_abstract']["name"])){
    $img=$_FILES["full_graphical_abstract"]["name"];
    array_push($cnd,"paperimage='$img'");
}
if (!empty($_FILES['full_paper']["name"])){
    $fp=$_FILES['full_paper']["name"];
    array_push($cnd,"fullpaper='$fp'");
}
if(!empty($cnd)){
  $cndd=" and (".implode(" or ",$cnd).")";
}
else{
  $cndd='';
}

$q1_="select count(*) as cnt  from journalpaper where issue_id='$issue' $cndd";
 
$stmt_ = $conn->query($q1_);
$rb=$stmt_->fetchAssociative();
$cnt=$rb["cnt"];
if($cnt==0){
      if($no_authors==0|$no_authors==""){
        $no_authors=0;
      }
      $data=array(
      'issue_id'=>$issue,
      'paper_id'=>$paper_id,
      'journals_id'=>$jid,
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
      'record_type'=>'NEW',
      'recieved_date'=>$recieved_date,
      'revised_date'=>$revised_date,
      'accepted_date'=>$accepted_date, 
      'discipline'=>$discipline,
      'citation'=>$citation,
      'citation_mla'=>$citation_mla,
      'citation_apa'=>$citation_apa,
      'citation_ieee'=>$citation_ieee,
      'citation_h'=>$citation_h,
      'is_publish'=>0,
      'datetime'=>date('Y-m-d H:i:s'),
      'type'=>$type);
      if(isset($chk_prev)){
      if($chk_prev=="YES"||$chk_prev=="Yes"){ 

      //Prevous Data Copy to Current
        $q_="select jp.journalpaper_id,jp.fullpaper,i.*,j.journal_abbri from journalpaper jp 
        LEFT JOIN issue i ON i.issue_id=jp.issue_id
        LEFT JOIN journals j ON j.journals_id=i.journals_id
        where journalpaper_id='$modi_paper'";
        $stmt_ = $conn->query($q_);
        $r_=$stmt_->fetchAssociative();
        $m_p=$r_['month']+1;
        $y_p=$r_['year'];
        $journal_abbri=$r_['journal_abbri'];
        $link_url_p=base_url("paperinfo.php?journalPaperId=".$r_["journalpaper_id"]);
        $link_pdf_p=base_url("PaperDirectory/Journal/$journal_abbri/$y_p/$m_p/").$r_['fullpaper'];
        $data['modification_type']=$modification_type;
        $data['link_id']=$modi_paper;
        $data['link_url']=$link_url_p;
        $data['link_pdf']=$link_pdf_p;
        $data['modifi_alert_message']=$modifi_alert_message;
        $data['modification_message']=$modification_message;
        $data['modification_stage']="AFTER";
        $data["is_link"]=1;


      }
      }

      
      //die();
      $sql = "SELECT i.year,i.month,j.journal_abbri,(select max(orders) from journalpaper where issue_id='$issue')  as ordr FROM   issue i  
      LEFT JOIN journals j ON i.journals_id=j.journals_id  
      where i.issue_id=$issue";
      $stmt = $conn->query($sql);
      $row=$stmt->fetchAssociative();
      $year=$row['year'];
      $month=$row['month'];
      $abbri=$row['journal_abbri'];
      $order=$row['ordr']+1;
      $data['orders']=$order;
      $m=$month+1;

      $paths="../../../PaperDirectory/Journal/$abbri/$year/$m/";
      if (!empty($_FILES['full_graphical_abstract']["name"])){
          if(in_array($_FILES['full_graphical_abstract']['type'], $acceptable_img)){
          // $file=date('ymdhiu').$_FILES["full_graphical_abstract"]["name"];
            $file=$_FILES["full_graphical_abstract"]["name"];
            $s_path = $_FILES["full_graphical_abstract"]["tmp_name"];
            $d_path = "$paths".$file;
            $data["paperimage"]=$file;
            move_uploaded_file($s_path,$d_path);
          }
      }
      if (!empty($_FILES['full_paper']["name"])){
        if(in_array($_FILES['full_paper']['type'], $acceptable_doc)){
            //$file=date('ymdhiu').$_FILES["full_paper"]["name"];
            $file=$_FILES["full_paper"]["name"];
            $s_path = $_FILES["full_paper"]["tmp_name"];
            $d_path = "$paths".$file;
            $data["fullpaper"]=$file;
            move_uploaded_file($s_path,$d_path);
        }
      }
 
      //die();

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

      $authors="";

      if($no_authors!=""&&$no_authors!=0){
        $n=$no_authors-1;
        $n2=$no_authors-2;
        $k=1;
        $arr=array_unique($university);
        $aruni=implode(",",$arr);  
        $data["universitylists"]=$aruni;
      }
      if($conn->insert('journalpaper',$data)){
          $id=$conn->lastInsertId();   
          if($no_authors!=""&&$no_authors!=0){
              if(isset($first_name)){
                          $i=0;
                          foreach($first_name as $fname){
                              $l_name=$last_name[$i];
                              $m_name=$middle_name[$i];
                              $l_name=$last_name[$i];
                              $orid=$orcid[$i];
                              $scopid=$scopus_id[$i];
                              $uni=$university[$i];
                              $d_name=$department[$i];
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
                              'issue_id'=>$issue,
                              'journals_id'=>$jid,
                              'year'=>$year,
                              'journalpaper_id'=>$id,
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

                              
                              $ajid=$conn->insert('authornamesjp',$dt);
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
                        }
                        
                        // $uarray=array_unique($mydata,SORT_REGULAR);
                        // $json=json_encode($uarray,JSON_INVALID_UTF8_IGNORE);
                        
                        $uarray=array_unique($mydata,SORT_REGULAR);
                        foreach($uarray as $u){
                              $new_array[]=$u;
                        }
                        
                        $json=json_encode($new_array,JSON_INVALID_UTF8_IGNORE); 
                        $conn->update('journalpaper',array("authors"=>$authors,"json_data"=>$json), ['journalpaper_id' => $id]);     
              }
            }
              $j=0;
              foreach($reffrences as $ref){
                  $dt=array('journalpaper_id'=>$id,'name'=>$ref,'crossref'=>$refdata[$j]['cross'],'googlescholar'=>$refdata[$j]['sch']);
                  $conn->insert('refrence',$dt);
                $j=$j+1;  
            }
            if(isset($chk_prev)){
              if($chk_prev=="YES"||$chk_prev=="Yes"){ 
                //Current Copy to Previous
                $abbri=$_SESSION["PAPER_J"];
                $y=$_SESSION["PAPER_YEAR"];
                $m=$_SESSION["PAPER_M"]+1;
                $fp=$data["fullpaper"];
                $link_url_c=base_url("paperinfo.php?journalPaperId=".$id);
                $link_pdf_c=base_url("PaperDirectory/Journal/$abbri/$y/$m/").$fp;
                $q="update journalpaper set is_link='1',link_url='$link_url_c',link_pdf='$link_pdf_c' where journalpaper_id IN ($modi_paper)";
                $conn->executeStatement($q);
              }
            }
          }
        header("refresh:0;url='../view/add_paper.php?success=1&msg=Paper Add Successfully'");      
}
else{
   header("refresh:0;url='../view/add_paper.php?success=0&msg=Duplicate File Name Found'");    
}

?>