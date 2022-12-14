<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


function email ($destinataire,$objet,$message)
{

    $mail = new PHPMailer;

    $mail->isSMTP();                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;               // Enable SMTP authentication
    $mail->Username = 'noreply.epsiparis@gmail.com';   // SMTP username
    $mail->Password = 'Axel2003//';   // SMTP password
    $mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                    // TCP port to connect to

    // Sender info
    $mail->setFrom('sendingEmail@gmail.com', 'noreplay_technique@epsi.fr');
    $mail->addReplyTo('addReplyToEmail@gmail.com', 'ReplyName');

    // Add a recipient
    $mail->addAddress($destinataire);

    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Set email format to HTML
    $mail->isHTML(true);

    // Mail subject
    $mail->Subject =$objet;

    // Mail body content
    $mail->Body    = $message;

    $mail->send();
    // Send email 
    // if(!$mail->send()) { 
    //     echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
    // } else { 
    //     echo 'Message has been sent.'; 
    // } 
}

?>