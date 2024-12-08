<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$data=array(
'discipline'=>$ediscipline,
'status'=>$estatus
);
$conn->update('discipline',$data, ['discipline_id' => $discipline_id]);
header("refresh:0;url='../view/discipline_master.php?success=1&msg=Discipline  Updated Successfully'");      
?>