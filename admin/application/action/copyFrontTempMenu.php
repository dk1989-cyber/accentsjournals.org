<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
 
$q="select * from  front_menu where journals_id=?";
$stmt=$conn->prepare($q);
$stmt->bindValue(1, $jid);
$resultSet=$stmt->execute();
$menus = $resultSet->fetchAllAssociative();
if(count($menus)==0){

        $q="SELECT * FROM temp_front_menu";
        $stmt=$conn->prepare($q);
        $resultSet=$stmt->execute();
        while(($menu_data=$resultSet->fetchAssociative())!==false){
            $data=array(
            'menu_name'=>$menu_data['menu_name'],
            'menu_url'=>$menu_data['menu_url'],
            'menu_url_back'=>$menu_data['menu_url_back'],
            'order_b'=>$menu_data['order_b'],
            'status'=>$menu_data['status'],
            'menu_type'=>$menu_data['menu_type'],
            'type'=>$menu_data['type'],
            'journals_id'=>$jid);
            $conn->insert('front_menu',$data);
        }
        if(1){
          echo "1";           
        }
}
        else{
        echo "0"; 
        }
?>