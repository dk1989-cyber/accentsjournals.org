<?php
 
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
    extract($_POST);
    $created=date('Y-m-d h:m:s');
    $data=array(
    'journals_id'=>$id,
    'title'=>$title,
    'discription'=>$discription,
    'created'=>$created
);

    if (!empty($_FILES['news_file']["name"])){
    $file=date('ymdhiu').$_FILES["news_file"]["name"];
    $s_path = $_FILES["news_file"]["tmp_name"];
    $d_path = "../../../upload/journal_content/news/" .$file;
    $data["image"]=$file;
    move_uploaded_file($s_path,$d_path);
    }

if($conn->insert('journals_news',$data)){
    header("refresh:0;url='../view/journal_content_news.php?success=1&id=$id&msg=News Added Successfully'");     
}
?>