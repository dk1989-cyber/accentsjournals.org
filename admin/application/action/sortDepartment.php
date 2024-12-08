<?php
 
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

if($ordr=="UP"){
    $new_order=$order_b-1;
    $conn->update('department',array("order_b"=>$order_b),['order_b' =>$new_order]);
    $data=array("order_b"=>$new_order);
    $conn->update('department',$data, ['department_id' => $id]);
}
else{

    $new_order=$order_b+1;
    $conn->update('department',array("order_b"=>$order_b),['order_b' =>$new_order]);
    $data=array("order_b"=>$new_order);
    $conn->update('department',$data, ['department_id' => $id]);

}

?>