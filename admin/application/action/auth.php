<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$sql = "SELECT * FROM users where email='$email' and password='$password'";
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
if(is_array($row)){
extract($row);
$q2="select  Group_CONCAT(distinct menu_id) as menus from permission where users_id='$users_id'";
$stmt = $conn->query($q2);
$row1=$stmt->fetchAssociative();
extract($row1);
$q3="select   Group_CONCAT(distinct sub_menu_id) as smenus from permission where users_id='$users_id'";
$stmt = $conn->query($q3);
$row2=$stmt->fetchAssociative();
extract($row2);
$_SESSION['menu_id']=$menus;
$_SESSION['submenu_id']=$smenus;
$_SESSION["type"]=$row['type'];
$_SESSION["name"]=$row['name'];
$_SESSION["id"]=$row['users_id'];
echo "1";
}
else{
echo "0";
}
?>