<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$sql = "SELECT * FROM issue where journals_id='$id'  order by issue_id desc";
$stmt = $conn->query($sql);
$op="<option value=''>Select</option>";
while(($row=$stmt->fetchAssociative())!=false){
      extract($row);
      $op.="<option value='$issue_id#$issue-$volume-$year'>Issue-$issue - Volume-$volume - Year-$year</option>";
}
echo $op;
?>