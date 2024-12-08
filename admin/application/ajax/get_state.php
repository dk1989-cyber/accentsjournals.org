<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$sql = "SELECT * FROM states where country_id='$id'";
$stmt = $conn->query($sql);
$op="";
while(($row=$stmt->fetchAssociative())!=false){
      extract($row);
      $op.="<option value='$states_id'>$name</option>";
}
echo $op;
?>