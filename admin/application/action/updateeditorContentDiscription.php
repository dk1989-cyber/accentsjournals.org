<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$data=array(
'editorial_board_discription'=>$editorial_board_discription,
'editorial_board_position'=>$editorial_board_position
);
$conn->update('journals',$data, ['journals_id' => $id]);
header("refresh:0;url='../view/journal_content_editorial_board.php?id=$id&type=$type");      
?>