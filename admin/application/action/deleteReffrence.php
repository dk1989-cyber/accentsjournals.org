<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);


unset($_SESSION['uniqid']);
$queryBuilder = $conn->createQueryBuilder();
$queryBuilder->delete('gen_authors')->execute();;
$queryBuilder->delete('ref_gen_author')->execute();;
$queryBuilder->delete('ref_gen')->execute();;


?>