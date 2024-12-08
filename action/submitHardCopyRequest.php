<?php
session_start();
require_once '../vendor/autoload.php';
include '../config/phpmailer/PHPMailerAutoload.php';
require_once "../config/config.php";
extract($_POST);

$captcha_response = trim($_POST['g-recaptcha-response']);
if($captcha_response != ''){
  $keySecret = '6LdFrwkqAAAAAEBldb60iYxyIe41xw0XfLWIgeY_';
  $check = array(
    'secret'		=>	$keySecret,
    'response'		=>	$_POST['g-recaptcha-response']
  );
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
        'mobile'=>$mobile,
        'email'=>$email,  
        'address'=>$address,
        'journals_id'=>$journals_id,
        'issue_id'=>$issue_id,
        'journalpaper_id'=>$paper_id,
        'comment'=>$comment
        );
        if($conn->insert('hard_copy',$data)){      
            $mail = new PHPMailer;
            $body="<table>
                      <tr><td>Name</td>$name</td></tr>
                      <tr><td>Mobile</td>$mobile</td></tr>
                      <tr><td>Email</td>$email</td></tr>
                     
                      <tr><td>Address</td>$address</td></tr>
                  
                      <tr><td>Comment</td>$comment</td></tr>
                  </table>";
                  
            include "../config/maillib.php";          
         // sendmail_Action("Email Alert For Hard Copy",$body,$mail);
          
       //   header("refresh:0;url='../journal-hard-copy-request.php?success=1&msg=Feedback Successfully Sent to Admin'");      
        }
        else{
          header("refresh:0;url='../journal-hard-copy-request.php?success=0&msg=Validation Failed'");    
        }
     }
    }
     else{
      header("refresh:0;url='../journal-hard-copy-request.php?success=0&msg=Please Try Again. Validation Failed'");    
     }
    
?>