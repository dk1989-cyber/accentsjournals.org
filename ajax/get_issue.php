<?php
include '../vendor/autoload.php';
include "../config/config.php";
extract($_REQUEST);
$sql = "SELECT * from issue  where journals_id='$journal_id'";
$stmt = $conn->query($sql);
$option="";
while(($row=$stmt->fetchAssociative())!==false){
    extract($row);
    $option.="<option value='$issue_id'>Volume-$volume, Issue-$issue</option>";
}
echo $option;
?>