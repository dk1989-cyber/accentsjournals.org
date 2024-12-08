<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$sql = "SELECT * FROM journalpaper where issue_id='$issue_id' and modification_type='$modification_type' and modification_stage='BEFORE' and is_link='0'";
 
$stmt = $conn->query($sql);
$op="<option value=''>Please Select</option>";
while(($row=$stmt->fetchAssociative())!=false){
      extract($row);
      $op.="<option value='$journalpaper_id'>$title</option>";
}
echo $op;
?>