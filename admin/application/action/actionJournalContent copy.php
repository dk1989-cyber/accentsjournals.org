<?php
 
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
if($action=="Edit"){

             $data=array(
               "editorial_board_discription"=>$editorial_board_discription,
               "editorial_board_position"=>$editorial_board_position
            );
            $conn->update('journals',$data, ['journals_id' => $id]);
            header("refresh:0;url='../view/journal_content_editorial_board_content.php?success=1&type=$type&t=$t&id=$id&index=$index&msg=Update Successfully'");      
   }
   else{
    $data=array($dt[$index]=>$discription);
        if (!empty($_FILES['img_file']["name"])){
            $file=date('ymdhiu').$_FILES["img_file"]["name"];
            $s_path = $_FILES["img_file"]["tmp_name"];
            $d_path = "../../../upload/journal_content/" .$file;
            $im=$dt[$index]."_"."img";
            $data[$im]=$file;
            move_uploaded_file($s_path,$d_path);
        }

        $conn->update('journals',$data, ['journals_id' => $id]);
        header("refresh:0;url='../view/journal_content.php?success=1&type=$type&t=$t&id=$id&index=$index&msg=Update Successfully'");      
   }
}

?>