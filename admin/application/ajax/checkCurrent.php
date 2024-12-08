<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
 
if($c=="1"){
  
    $_SESSION["c"]=true;
}
else{
    
    unset($_SESSION["c"]);
}


?>