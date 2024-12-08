<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";

    extract($_REQUEST);
    $datetime=date('Y-m-d h:m:s');
    $data=array(
   'title'=>$etitle,
   'discription'=>$ediscription);
   if (!empty($_FILES['enews_file']["name"])){
        $file=date('ymdhiu').$_FILES["enews_file"]["name"];
        $s_path = $_FILES["enews_file"]["tmp_name"];
        $d_path = "../../../upload/journal_content/news/" .$file;
        $data["image"]=$file;
        move_uploaded_file($s_path,$d_path);
   }
   $conn->update('journals_news',$data, ['journals_news_id' => $journals_news_id]);
   header("refresh:0;url='../view/journal_content_news.php?success=1&id=$id&msg=Added Successfully'");

?>