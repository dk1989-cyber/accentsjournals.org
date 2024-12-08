<?php
 
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
    extract($_POST);
  
   if(isset($is_msgchk)){
    $is_msg=1;
    $data=array(
      'volume'=>$volume,
      'issue'=>$issue,
      'content'=>$content,
      'message_box'=>$message_box,
      'mode'=>$chk_mode,
      'message_box_type'=>$chk_type,
      'message_box'=>$message_box,
      'is_msgbox'=>$is_msg  
     );
    }
    else{
    $data=array(
    'volume'=>$volume,
    'issue'=>$issue,
    'content'=>$content,
    'mode'=>$chk_mode,
    'is_msgbox'=>0
    );
  }
  
  if(isset($is_discipline)){
    $data["is_discipline"]=1;
  }
  else{
      $data["is_discipline"]=0;
  }

   $m=$month+1;
   $paths="../../../PaperDirectory/Journal/$abbri/$year/$m/";
   if (!empty($_FILES['cover_image']["name"])){
    $file=date('ymdhiu').$_FILES["cover_image"]["name"];
    $s_path = $_FILES["cover_image"]["tmp_name"];
    $d_path = "$paths".$file;
    $data["issue_cover_image"]=$file;
    move_uploaded_file($s_path,$d_path);
   }

  $conn->update('issue',$data,['issue_id' => $id]);
 header("refresh:0;url='../view/edit_directory.php?id=$id&success=1&msg=Directory Updated Successfully'");      
?>