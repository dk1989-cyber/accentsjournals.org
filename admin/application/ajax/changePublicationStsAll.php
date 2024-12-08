<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$data=array("is_publish"=>$publish_sts);
$conn->update('journalpaper',$data,["issue_id"=>$issue]);


$q="select group_concat(distinct discipline order by orders) as dsp from journalpaper where issue_id ='$issue' and is_publish='1'";
$stmt = $conn->query($q);
$row=$stmt->fetchAssociative();
$displines=$row['dsp'];
$conn->update('issue',['disciplines'=>$displines],['issue_id' => $issue]);


?>