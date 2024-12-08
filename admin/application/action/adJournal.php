<?php
 
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_POST);
$months_=implode(',',$months);
$freq=explode('-',$frequency);

$data=array(
'name'=>$name,
'journal_abbri'=>$journal_abbri,
'issnprint'=>$issnprint,
'issnonline'=>$issnonline,
'journal_about'=>$journal_about,
'doi'=>$doi,
'frequency'=>$freq[0],
'starting_year'=>$starting_year,
'current_year'=>$current_year,
'status'=>'Enable',
'months'=>$months_);

if (!empty($_FILES['journal_logo']["name"])){
  if(in_array($_FILES['journal_logo']['type'], $acceptable_img)){
    $file=date('ymdhiu').$_FILES["journal_logo"]["name"];
    $s_path = $_FILES["journal_logo"]["tmp_name"];
    $d_path = "../../../upload/" .$file;
    $data["journal_logo"]=$file;
    move_uploaded_file($s_path,$d_path);
  }
}
 
if (!empty($_FILES['cover_page']["name"])){
  if(in_array($_FILES['cover_page']['type'], $acceptable_img)){
    $file=date('ymdhiu').$_FILES["cover_page"]["name"];
    $s_path = $_FILES["cover_page"]["tmp_name"];
    $d_path = "../../../upload/" .$file;
    $data["cover_image"]=$file;
    move_uploaded_file($s_path,$d_path);
  }
}

if($conn->insert('journals',$data)){
  $lid=$conn->lastInsertId();
  $abbri=strtoupper($journal_abbri);
  $d_path ="../../../PaperDirectory/Journal/$abbri/press";
  
  if (!file_exists($d_path)) {
    mkdir($d_path, 0777, true);
  }
  
  $url="admin/application/view/journal_content_grid.php?id=$lid";
  $dt1=array("menu_id"=>"5","sub_menu_name"=>strtoupper($journal_abbri),"url"=>$url); 
  $conn->insert('sub_menu',$dt1);
  
  $url2="admin/application/view/journal_timeline.php?journals_id=$lid";
  $dt2=array("menu_id"=>"7","sub_menu_name"=>strtoupper($journal_abbri),"url"=>$url2); 
  $conn->insert('sub_menu',$dt2);
  
  $url3="admin/application/view/journal_score.php?journals_id=$lid";
  $dt3=array("menu_id"=>"8","sub_menu_name"=>strtoupper($journal_abbri),"url"=>$url3); 
  $conn->insert('sub_menu',$dt3);
  
  $url4="admin/application/view/journal_acceptance_rate.php?journals_id=$lid";
  $dt4=array("menu_id"=>"13","sub_menu_name"=>strtoupper($journal_abbri),"url"=>$url4); 
  $conn->insert('sub_menu',$dt4);
  
  $url5="admin/application/view/journal_duration_view_download.php?journals_id=$lid";
  $dt5=array("menu_id"=>"16","sub_menu_name"=>strtoupper($journal_abbri),"url"=>$url5); 
  $conn->insert('sub_menu',$dt5);
  

  header("refresh:0;url='../view/add_journal.php?success=1&msg=Journal Registered Successfully'");      
}
?>