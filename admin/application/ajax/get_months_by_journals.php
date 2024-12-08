<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

$q1="SELECT group_concat(month) as upmnths,(select max(issue)  from issue where journals_id='$journal_id') as mx from issue where year='$year' and journals_id='$journal_id'";
$stmt0 = $conn->query($q1);
$row0=$stmt0->fetchAssociative();
extract($row0);

$sql = "SELECT months,journals_id FROM journals where current_year = '$year' and journals_id = $journal_id";
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative(); 
if(is_array($row)){
    $mx=$row0['mx']+1;
    echo $row['months']."-".$row0['upmnths']."-".$mx;
}
else{
    echo 0;
}
?>