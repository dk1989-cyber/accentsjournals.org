<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";


extract($_REQUEST);
$data=array(
'name'=>$ename,
'designation'=>$edesignation,
'department'=>$edepartment,
'university'=>$euniversity,
'domain_research'=>$edomain_research,
'education'=>$eeducation,
'theses'=>$etheses,
'external_url'=>$eexternal_url,
'email'=>$eemail,
'scopus_id'=>$escopus_id,
'country'=>$ecountry,
'state'=>$estate,
'city'=>$ecity,
'editorial_board_category_id'=>$eeditorial_board_category,
);

if (!empty($_FILES['photo_file']["name"])){
  $file=date('ymdhiu').$_FILES["photo_file"]["name"];
  $s_path = $_FILES["photo_file"]["tmp_name"];
  $d_path = "../../../upload/journal_content/editorial_board/" .$file;
  $data["photo"]=$file;
  move_uploaded_file($s_path,$d_path);
 }
  $conn->update('editorial_board',$data,['editorial_board_id' => $editorial_board_id]);
  header("refresh:0;url='../view/journal_content_editorial_board.php?success=1&type=$type&t=$t&id=$id&msg=Added Successfully'");     
?>