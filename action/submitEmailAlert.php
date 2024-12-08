<?php
session_start();
require_once '../vendor/autoload.php';
include '../config/phpmailer/PHPMailerAutoload.php';
require_once "../config/config.php";
extract($_POST);
$captcha_response = trim($_POST['g-recaptcha-response']);

//if($captcha_response != ''){
  if(1){
  $keySecret = '6LdFrwkqAAAAAEBldb60iYxyIe41xw0XfLWIgeY_';
  $check = array('secret'		=>	$keySecret,'response'		=>	$_POST['g-recaptcha-response']);
  $startProcess = curl_init();
  curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
  curl_setopt($startProcess, CURLOPT_POST, true);
  curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));
  curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);
  $receiveData = curl_exec($startProcess);
  $finalResponse = json_decode($receiveData, true);
    if($finalResponse['success']){
   
        $data=array(
        'name'=>$name,
        'email'=>$email,
        'purpose'=>$purpose
        );
        
        if($conn->insert('email_alert',$data)){    
          $mail = new PHPMailer;
          $body="<table>
                 <tr>
                   <th>Name</th>
                   <td>$name</td>
                 </tr>
                 <tr>
                   <th>Email</th>
                   <td>$email</td>
                 </tr>
                 <tr>
                   <th>Purpose</th>
                   <td>$purpose</td>
                 </tr>    
           </table>";
           
            include "../config/maillib.php";   
           sendmail_Action("Email Alert",$body,$mail);
           header("refresh:0;url='../accent-email-alert.php?success=1&msg=Email Alert  Successfully Sent to Admin'");      
        }
        else{
          header("refresh:0;url='../accent-email-alert.php?success=0&msg=Validation Failed'");    
        }
     }
    }
     else{
      header("refresh:0;url='../accent-email-alert.php?success=0&msg=Please Try Again. Validation Failed'");    
     }


   
?>