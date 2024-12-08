<?php

 function sendmail_Action($subject, $body,$mail){
    $mail->SMTPDebug = 0;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP when (LOCAL and SERVER) 
    $fromEmail="danishkhan989@gmail.com";
    $mail->Host     = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "danishkhan989@gmail.com";
    $mail->Password = "mmzbppigohdzvjws";
    $mail->SMTPSecure = "ssl";
    $mail->Port     = "465";
    $mail->setFrom($fromEmail,$subject);
    $mail->addAddress("danishkhan989@gmail.com", 'User');     // Add a recipient
    //$mail->addAttachment($download);         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body ;
    if(!$mail->send()) {
    return false;
    }
    else{
        return true;
    }
 }

?>