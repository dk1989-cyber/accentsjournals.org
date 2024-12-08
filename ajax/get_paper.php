<?php
include '../vendor/autoload.php';
include "../config/config.php";
extract($_REQUEST);
$sql = "SELECT * from journalpaper  where issue_id='$issue_id'";
$stmt = $conn->query($sql);
$option="";
while(($row=$stmt->fetchAssociative())!==false){
    extract($row);
    $option.="<option value='$journalpaper_id'>$title</option>";
}
echo $option;
?>