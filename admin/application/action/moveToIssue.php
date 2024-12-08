<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$q="select * from press_paper where press_paper_id=$id";
$stmt = $conn->query($q);
$row=$stmt->fetchAssociative();
extract($row);
$iss=explode("#",$issue_id)[0];
$datetime=date('Y-m-d H:i:s');
$data=array(
'issue_id'=>$iss,
'paper_id'=>$paper_id,
'title'=>$title,
'journals_id'=>$journals_id,
'authors'=>$authors, 
'no_authors'=>$no_authors, 
'abstract'=>$abstract, 
'keyword'=>$keyword,
'page_no_start'=>$page_no_start,
'page_no_end'=>$page_no_end, 
'doi'=>$doi, 
'doilink'=>$doilink,
'article_type_id'=>$article_type_id, 
'refference'=>$refference, 
'record_type'=>'NEW',
'recieved_date'=>$recieved_date,
'revised_date'=>$revised_date,
'accepted_date'=>$accepted_date, 
'discipline'=>$discipline,
'is_publish'=>0,
'datetime'=>$datetime,
'json_data'=>$json_data,
'type'=>$type);
$sql3 = "SELECT i.year,i.month,i.issue_id,i.volume,i.issue,j.journal_abbri,
(select max(orders) from journalpaper where issue_id='$iss')  as ordr, 
(select count(*) from journalpaper where issue_id='$iss')  as paper_uploaded
FROM   issue i  
LEFT JOIN journals j ON i.journals_id=j.journals_id  
where i.issue_id=$iss";
$stmt3 = $conn->query($sql3);
$row3=$stmt3->fetchAssociative();
$year=$row3['year'];
$volume=$row3['volume'];
$month=$row3['month'];
$abbri=$row3['journal_abbri'];
$issue=$row3['issue'];
$order=$row3['ordr']+1;
$issue_id=$row3["issue_id"];
$new_file_name=$row3['paper_uploaded']+1;
$data['orders']=$order;
$m=$month+1;
$month_in=get_month($month);
$dynamic_variable=["#year#","#month#","#volume#","#issue#"];
$dynamic_data=[$year,$month_in,$volume,$issue];
$citation_v=str_replace($dynamic_variable,$dynamic_data,$citation);
$data["citation"]=$citation_v;
$citation_mla=str_replace($dynamic_variable,$dynamic_data,$citation_mla);
$data["citation_mla"]=$citation_mla;
$citation_ieee=str_replace($dynamic_variable,$dynamic_data,$citation_ieee);
$data["citation_ieee"]=$citation_ieee;
$citation_apa=str_replace($dynamic_variable,$dynamic_data,$citation_apa);
$data["citation_apa"]=$citation_apa;
$citation_h=str_replace($dynamic_variable,$dynamic_data,$citation_h);
$data["citation_apa"]=$citation_h;
$paths_s="../../../PaperDirectory/Journal/$abbri/press/";
$paths_d="../../../PaperDirectory/Journal/$abbri/$year/$m/";
$filename_1=$paths_s."/".$fullpaper;
$filename_2=$paths_s."/".$paperimage;
if(file_exists($filename_1)){
      // echo $filename_1;
       $file_new=$new_file_name.".pdf";
       rename($filename_1,$paths_d.$file_new);
       $data["fullpaper"]=$file_new;
}
if(file_exists($filename_2)){
       //$file_img=$filename_2;
      rename($filename_2,$paths_d.$paperimage);
      $data["paperimage"]=$paperimage;
}
 

//  print_r($data);

// die();
 

if($conn->insert('journalpaper',$data)){
            $jpid =$conn->lastInsertId();
            $q5="select * from authornamespp where press_paper_id=$id";
            $stmt5 = $conn->query($q5);
            while(($row5=$stmt5->fetchAssociative())!==false){
                extract($row5);
                $dt=array(
                'journalpaper_id'=>$jpid,
                'issue_id'=>$issue_id,
                'journals_id'=>$journals_id,
                'year'=>$year,
                'firstname'=>$firstname,
                'middlename'=>$middlename,
                'lastname'=>$lastname,
                'orcid'=>$orcid,
                'scoupus_id'=>$scoupus_id,
                'university_id'=>$university_id,
                'department_id'=>$department_id,
                'designation_id'=>$designation_id,
                'email'=>$email,
                'is_corresponding'=>$is_corresponding,
                'affilation'=>$affilation);
                $conn->insert('authornamesjp',$dt);
            }

            $q6="select * from refrencep where press_paper_id=$id";
            $stmt6 = $conn->query($q6);
                while(($row6=$stmt6->fetchAssociative())!==false){
                  extract($row6);
                  $dt=array('journalpaper_id'=>$jpid,'name'=>$name,'crossref'=>$crossref,'googlescholar'=>$googlescholar);
                  $conn->insert('refrence',$dt);
            }

            $conn->delete('authornamespp', ['press_paper_id' => $id]);
            $conn->delete('refrencep', ['press_paper_id' => $id]);
            $conn->delete('press_paper', ['press_paper_id' => $id]);
            header("refresh:0;url='../view/view_paper_press.php?success=1&msg=Move Successfully to Issue'");      
  }
 

?>