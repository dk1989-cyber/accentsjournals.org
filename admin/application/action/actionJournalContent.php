<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
if($action=="Edit"){
    $data=array(
    'title'=>'',
    'discription'=>$discription
    );
    if (!empty($_FILES['img_file']["name"])){
            if(in_array($_FILES['img_file']['type'], $acceptable_img)){
                $file=date('ymdhiu').$_FILES["img_file"]["name"];
                $s_path = $_FILES["img_file"]["tmp_name"];
                $d_path = "../../../upload/journal_content/" .$file;
                $data["image"]=$file;
                move_uploaded_file($s_path,$d_path);
        }
    }
    if( $conn->update('journal_content',$data, ['journals_id' => $journals_id,'type'=>$type])){
       header("refresh:0;url='../view/journal_content.php?success=1&type=$type&id=$journals_id&msg=Update Successfully'");      
    }
    else{
        header("refresh:0;url='../view/journal_content.php?success=1&type=$type&id=$journals_id&msg=Update Successfully'");      
    }
}
else{
      $data=array(
        'journals_id'=>$journals_id,
        'title'=>'',
        'front_menu_id'=>$front_menu_id,
        'discription'=>$discription,
        'type'=>$type
       );
        if (!empty($_FILES['img_file']["name"])){
            if(in_array($_FILES['img_file']['type'], $acceptable_img)){
                $file=date('ymdhiu').$_FILES["img_file"]["name"];
                $s_path = $_FILES["img_file"]["tmp_name"];
                $d_path = "../../../upload/journal_content/" .$file;
                $data["image"]=$file;
                move_uploaded_file($s_path,$d_path);
            }
        }
        if($conn->insert('journal_content',$data)){
            header("refresh:0;url='../view/journal_content.php?success=1&type=$type&id=$journals_id&msg=Added Successfully'");    
        }
}
?>