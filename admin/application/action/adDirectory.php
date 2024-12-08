<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
    extract($_POST);
    $journals=explode('#',$journals_id);
    $abbri=$journals[1];
    
    //$q="update issue set status='Previous' where journals_id=".$journals[0];
    $conn->update('issue',array("status"=>'Previous'),['journals_id' => $journals[0]]);
    $datetime=date('Y-m-d H:m:s');
   
    if(isset($is_msgchk)){
        $is_msg=1;
        $data=array(
        'journals_id'=>$journals[0],
        'year'=>$year,
        'month'=>$month,
        'volume'=>$volume,
        'number'=>0,
        'issue'=>$issue,
        'content'=>$content,
        'message_box'=>$message_box,
        'datetime'=>$datetime,
        'mode'=>$chk_mode,
        'message_box_type'=>$chk_type,
        'is_msgbox'=>$is_msg,
        'record_type'=>"NEW",
        'status'=>'Current');
    }
    else{
        $data=array(
            'journals_id'=>$journals[0],
            'year'=>$year,
            'month'=>$month,
            'volume'=>$volume,
            'number'=>0,
            'issue'=>$issue,
            'datetime'=>$datetime,
            'content'=>$content,
             'mode'=>$chk_mode,
             'status'=>'Current',
               'record_type'=>"NEW",
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
    if(!is_dir($paths)){
        mkdir($paths,0777,true);
    }

    if (!empty($_FILES['cover_image']["name"])){
    $file=date('ymdhiu').$_FILES["cover_image"]["name"];
    $s_path = $_FILES["cover_image"]["tmp_name"];
    $d_path = "$paths" .$file;
    $data["issue_cover_image"]=$file;
    move_uploaded_file($s_path,$d_path);
    }

    if($conn->insert('issue',$data)){
    header("refresh:0;url='../view/add_directory.php?success=1&msg=Directory Registered Successfully'");      
    }
?>