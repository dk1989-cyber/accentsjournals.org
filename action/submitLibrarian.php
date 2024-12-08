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
        'email'=>$email,
        'affilation'=>$affilation,
        'rec_name'=>$rec_name,
        'librarian_name'=>$librarian_name,
        'rec_country'=>$rec_country,
        'rec_email'=>$rec_email,
        'rec_city'=>$rec_city,
        'reason'  =>$reason
        );
        if($conn->insert('librarian',$data)){      
            $mail = new PHPMailer;
            $body="<table>
                     
                  </table>";
            include "../config/maillib.php";          
         //   sendmail_Action("Email Alert",$body,$mail);
          
          header("refresh:0;url='../librarian.php?success=1&msg= Successfully Sent to Admin'");      
        }
        else{
          header("refresh:0;url='../librarian.php?success=0&msg=Validation Failed'");    
        }
     }
    }
     else{
      header("refresh:0;url='../librarian.php?success=0&msg=Please Try Again. Validation Failed'");    
     }
    
?>