<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

$months_=implode(',',$months);
$freq=explode('-',$frequency);
$data=array(
  'name'=>$name,
  'journal_about'=>$journal_about,
  'issnprint'=>$issnprint,
  'issnonline'=>$issnonline,
  'doi'=>$doi,
  'frequency'=>$freq[0],
  'starting_year'=>$starting_year,
  'current_year'=>$current_year,
  'months'=>$months_
);
    
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

   $conn->update('journals',$data, ['journals_id' => $id]);
   header("refresh:0;url='../view/edit_journal.php?id=$id&success=1&msg=User Update Successfully'");      
?>