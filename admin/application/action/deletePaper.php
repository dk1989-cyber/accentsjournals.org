<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

$conn->delete('journalpaper', ['journalpaper_id' => $id]);
$conn->delete('refrence', ['journalpaper_id' => $id]);
$conn->delete('authornamesjp', ['journalpaper_id' => $id]);

?>