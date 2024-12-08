<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$sql = "SELECT * FROM issue where journals_id='$id' and status='Current'";
$stmt = $conn->query($sql);
$op="";
while(($row=$stmt->fetchAssociative())!=false){
      extract($row);
      $op.="<option value='$issue_id#$issue-$volume-$year'>issue-$issue - volume-$volume - year-$year</option>";
}
echo $op;
?>