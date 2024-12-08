<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$conn->delete('editorial_board', ['editorial_board_id' => $id]);
?>