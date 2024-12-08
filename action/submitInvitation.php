<?php
session_start();
require_once '../vendor/autoload.php';
include '../config/phpmailer/PHPMailerAutoload.php';
require_once "../config/config.php";
extract($_POST);


$captcha_response = trim($_POST['g-recaptcha-response']);
if($captcha_response != ''){
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
              'journals_id'=>$journals_id,
              'title'=>$title,
              'first_name'=>$first_name,
              'middle_name'=>$middle_name,
              'last_name'=>$last_name,
              'department'=>$department,
              'position'=>$position,
              'university'=>$university,
              'address'=>$address,
              'higher_education'=>$higher_education,
              'b_bio'=>$b_bio,
              'weblink'=>$weblink,
              'scopus_id'=>$scopus_id,
              'g_scholar'=>$g_scholar,
              'telephone'=>$telephone,
              'mobile'=>$mobile,
              'dom_r'=>$dom_r,
              'orcid'=>$orcid,
              'email'=>$email
              );
              if (!empty($_FILES['photo']["name"])){
                  $file=date('ymdhiu').$_FILES["photo"]["name"];
                  $s_path = $_FILES["photo"]["tmp_name"];
                  $d_path = "../upload/invitation/" .$file;
                  $data["photo"]=$file;
                  move_uploaded_file($s_path,$d_path);
                }
                if (!empty($_FILES['resume']["name"])){
                  $file=date('ymdhiu').$_FILES["resume"]["name"];
                  $s_path = $_FILES["resume"]["tmp_name"];
                  $d_path = "../upload/invitation/" .$file;
                  $data["resume"]=$file;
                  move_uploaded_file($s_path,$d_path);
                }
              if($conn->insert('invitation',$data)){    
                   
              
                $body="<table>
                            <tr><td>Title</td><td>$title</td></tr>
                            <tr><td>First Name</td><td>$first_name</td></tr>
                            <tr><td>Middle Name</td><td>$middle_name</td></tr>
                            <tr><td>Last Name</td><td>$last_name</td></tr>
                            <tr><td>Department</td><td>$department</td></tr>
                            <tr><td>Position</td><td>$position</td></tr>
                            <tr><td>University</td><td>$university</td></tr>
                            <tr><td>Address</td><td>$address</td></tr>
                            <tr><td>Higher Education</td><td>$higher_education</td></tr>
                            <tr><td>Biography</td><td>$b_bio</td></tr>
                            <tr><td>Weblink</td><td>$weblink</td></tr>
                            <tr><td>Scopus ID</td><td>$scopus_id</td></tr>
                            <tr><td>Google Scholar ID</td><td>$g_scholar</td></tr>
                            <tr><td>Telephone</td><td>$telephone</td></tr>
                            <tr><td>Mobile</td><td>$mobile</td></tr>
                            <tr><td>Domain Research</td><td>$dom_r</td></tr>
                            <tr><td>ORCID</td><td>$orcid</td></tr>
                            <tr><td>Email</td><td>$email</td></tr>
                        </table>";
                           $mail = new PHPMailer;
                        include "../config/maillib.php";
                         sendmail_Action("Invitation",$body,$mail);
                         
                header("refresh:0;url='../invitation.php?success=1&msg=Invitation Sent Successfully'");      
              }
     }
}
else{
  header("refresh:0;url='../invitation.php?success=0&msg=Validation Failed.'");  
}
?>