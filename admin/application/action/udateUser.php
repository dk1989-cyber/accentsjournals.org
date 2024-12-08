<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

 

$data=array(
'name'=>$name,
'mobile'=>$mobile,
'password'=>$password);
$conn->update('users',$data, ['users_id' => $id]);
$conn->delete('permission', ['users_id' => $id]);
if(isset($submenu)){
            foreach($submenu as $sb){
                $ecp=explode("-",$sb);
                $m=$ecp[0];
                $s=$ecp[1];
                $dt=array('menu_id'=>$m,'sub_menu_id'=>$s,'users_id'=>$id);
                $conn->insert('permission',$dt);
            }
   }
header("refresh:0;url='../view/edit_user.php?id=$id&success=1&msg=User Update Successfully'");      

?>