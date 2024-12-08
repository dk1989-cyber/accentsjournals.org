<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
session_destroy();
$url=base_url('admin/');
header("refresh:0;url=$url");
?>