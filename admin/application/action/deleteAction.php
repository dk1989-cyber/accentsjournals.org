<?php
error_reporting(1);
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
if($tab=="feedback"){
    $conn->delete('feedback', ['feedback_id' => $id]);
}
else if($tab=="invitation"){
    $conn->delete('invitation', ['invitation_id' => $id]);
}
else if($tab=="email"){
    $conn->delete('email_alert', ['email_alert_id' => $id]);
}
?>