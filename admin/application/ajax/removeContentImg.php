<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
  

unlink("../../../upload/journal_content/$img");
$q="update journal_content set image='' where journals_id='$id' and type='$type'";
$conn->executeStatement($q);
 
?>