<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$conn->delete('users', ['users_id' => $id]);
$conn->delete('permission',['users_id' => $id]);
header("refresh:0;url='../view/view_user.php?success=1&msg=User Deleted Successfully'");      

?>