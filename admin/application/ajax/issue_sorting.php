<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
 
echo $series;
extract($_REQUEST);
if ($direction == "UP") {
    $sarray = explode(",", $series);
    $cindex = array_search($current, $sarray);
    $up = $cindex - 1;
    $val = $sarray[$up];
} else {
    $sarray = explode(",", $series);
    $cindex = array_search($current, $sarray);
    $down = $cindex + 1;
    $val = $sarray[$down];
}

$conn->update('journalpaper',['orders'=>$current],[ 'issue_id' => $issue_id,'orders'=>$val]);
$conn->update('journalpaper',['orders'=>$val],['journalpaper_id' => $id,'issue_id' => $issue_id]);
$q="select group_concat(distinct discipline order by orders) as dsp from journalpaper where issue_id ='$issue_id' and is_publish='1'";
$stmt = $conn->query($q);
$row=$stmt->fetchAssociative();
$displines=$row['dsp'];
$conn->update('issue',['disciplines'=>$displines],['issue_id' => $issue_id]);
?>