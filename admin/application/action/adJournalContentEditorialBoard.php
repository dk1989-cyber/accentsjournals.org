<?php
 
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
    extract($_POST);
    $data=array(
    'name'=>$name,
    'journals_id'=>$id,
    'designation'=>$designation,
    'department'=>$department,
    'university'=>$university,
    'domain_research'=>$domain_research,
    'education'=>$education,
    'theses'=>$theses,
    'external_url'=>$external_url,
    'email'=>$email,
    'scopus_id'=>$scopus_id,
    'country'=>$country,
    'state'=>$state,
    'city'=>$city,
    'editorial_board_category_id'=>$editorial_board_category);


    $q="select max(ordby) as mxorder from editorial_board";
    $stmt = $conn->query($q);
    $row=$stmt->fetchAssociative();
    extract($row);
    $ord=$mxorder+1;
    $data["ordby"]=$ord;
    
    if (!empty($_FILES['photo_file']["name"])){
    $file=date('ymdhiu').$_FILES["photo_file"]["name"];
    $s_path = $_FILES["photo_file"]["tmp_name"];
    $d_path = "../../../upload/journal_content/editorial_board/" .$file;
    $data["photo"]=$file;
    move_uploaded_file($s_path,$d_path);
    }

if($conn->insert('editorial_board',$data)){
    header("refresh:0;url='../view/journal_content_editorial_board.php?success=1&type=$type&t=$t&id=$id&msg=Added Successfully'");     
}
?>