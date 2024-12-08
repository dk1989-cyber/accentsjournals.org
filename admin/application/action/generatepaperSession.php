<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$j_=explode("#",$jid);
$i_=explode("#",$issuid);


$_SESSION["PAPER_JID"]=$j_[0];
$_SESSION["PAPER_J"]=$j_[1];
$_SESSION["PAPER_DOI"]=$j_[2];
$_SESSION["PAPER_ISSUID"]=$i_[0];
$_SESSION["PAPER_I"]=$i_[1];

$sql = "select i.*,j.* from issue i LEFT JOIN journals j ON i.journals_id=j.journals_id WHERE i.issue_id='".$i_[0]."'";
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
extract($row);

$_SESSION["PAPER_M"]=$month;
$_SESSION["PAPER_MONTH"]=get_month($month);
$_SESSION["PAPER_JNAME"]=$name;
$_SESSION["PAPER_YEAR"]=$year;
$_SESSION["PAPER_VOLUME"]=$volume;
$_SESSION["PAPER_ISSUE"]=$issue;
$_SESSION["PAPER_MODE"]=$mode;


?>