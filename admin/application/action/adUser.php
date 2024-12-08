<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

//print_r($_REQUEST);

$q="select * from users where email=?";
$stmt=$conn->prepare($q);
$stmt->bindValue(1, $email);
$resultSet=$stmt->execute();
$users = $resultSet->fetchAllAssociative();
  
if(count($users)==0){
$data=array(
'name'=>$name,
'mobile'=>$mobile,
'email'=>$email,
'type'=>'GENERAL',
'password'=>$password,
'status'=>'Enable');

if($conn->insert('users',$data)){
$id=$conn->lastInsertId();
        if(isset($submenu)){
                    foreach($submenu as $sb){
                        $ecp=explode("-",$sb);
                        $m=$ecp[0];
                        $s=$ecp[1];
                        $dt=array('menu_id'=>$m,'sub_menu_id'=>$s,'users_id'=>$id);
                        $conn->insert('permission',$dt);
                    }
        }
  header("refresh:0;url='../view/add_user.php?success=1&msg=User Registered Successfully'");      
}
}
else{
  header("refresh:0;url='../view/add_user.php?success=0&msg=User Registeration Failed.Email Already Exist '");     
}
?>