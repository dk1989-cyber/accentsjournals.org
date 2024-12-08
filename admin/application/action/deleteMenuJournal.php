<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$conn->delete('front_menu', ['journals_id' => $id]);
$conn->delete('journal_content', ['journals_id' => $id]);
?>