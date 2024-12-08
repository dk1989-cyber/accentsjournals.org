<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

$q="select journal_abbri from journals where journals_id='$id'";
$stmt = $conn->query($q);
$row=$stmt->fetchAssociative();
extract($row);
//$abbri=strtoupper($journal_abbri);
$d_path ="../../../PaperDirectory/Journal/$journal_abbri";
deleteDirectory($d_path);
$conn->delete('sub_menu',['sub_menu_name'=>$journal_abbri]);
$conn->delete('issue', ['journals_id' => $id]);
$conn->delete('press_paper', ['journals_id' => $id]);
$conn->delete('journalpaper', ['journals_id' => $id]);
$conn->delete('journals', ['journals_id' => $id]);




?>