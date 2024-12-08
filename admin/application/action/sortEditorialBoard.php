<?php
 
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

if($ordr=="UP"){
    $new_order=$order_b-1;
    $conn->update('editorial_board',array("ordby"=>$order_b),['ordby' =>$new_order]);
    $data=array("ordby"=>$new_order);
    $conn->update('editorial_board',$data, ['editorial_board_id' => $id]);
}
else{

    $new_order=$order_b+1;
    $conn->update('editorial_board',array("ordby"=>$order_b),['ordby' =>$new_order]);
    $data=array("ordby"=>$new_order);
    $conn->update('editorial_board',$data, ['editorial_board_id' => $id]);

}

?>