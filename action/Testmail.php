<?php
error_reporting(E_USER_WARNING);
session_start();
require_once '../vendor/autoload.php';
include '../config/phpmailer/PHPMailerAutoload.php';
require_once "../config/config.php";

// send_email("danishkhan989@gmail.com", "danish","subject","body",[],[],"","",$mail);


$mail = new PHPMailer;
$mail->SMTPDebug = 2;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP when (LOCAL and SERVER) 
$fromEmail="danishkhan989@gmail.com";
$mail->Host     = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "danishkhan989@gmail.com";
$mail->Password = "mmzbppigohdzvjws";
$mail->SMTPSecure = "ssl";
$mail->Port     = "465";
$mail->setFrom($fromEmail, 'Sombody Forget Password');
$mail->addAddress("danishkhan989@gmail.com", 'User');     // Add a recipient
//$mail->addAttachment($download);         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
$body = "test";
$mail->Subject = 'Forgot Password';
$mail->Body    = $body ;
if(!$mail->send()) {
  return false;
}
else{
    return true;
}


?>