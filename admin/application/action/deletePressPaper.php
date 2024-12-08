<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);

$conn->delete('press_paper', ['press_paper_id' => $id]);
$conn->delete('refrencep', ['press_paper_id' => $id]);
$conn->delete('authornamespp', ['press_paper_id' => $id]);

?>