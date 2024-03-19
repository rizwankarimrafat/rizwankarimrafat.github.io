<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//get data from form

$name = $_POST['name'];
$number = $_POST['number'];
$complaintype = $_POST['complaintype'];
$date = $_POST['date'];
$message = $_POST['message'];

// preparing mail content
$messagecontent ="Name: ". $name . "<br><br>Contact: " . $number . "<br><br>Complain type: ". $complaintype . "<br><br>Date of incidence: ". $date . "<br><br>Complain: " . $message;


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'chowdhuryshaheb66@gmail.com';                     //SMTP username
    $mail->Password   = 'echykhkymouivceo';                               //SMTP password
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom('complain@karimmotors.com.bd', 'Customer Complain');
    $mail->addAddress('head@karimmotors.com.bd');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('head@karimmotors.com.bd');
    // $mail->addCC('sales@karimmotors.com.bd');
    // $mail->addCC('service@karimmotors.com.bd');
    // $mail->addCC('head@karimmotors.com.bd');
    //$mail->addBCC('bcc@example.com');
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('photo.jpeg', 'photo.jpeg');    //Optional name
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New '.$complaintype.' Complain by '.$name;
    $mail->Body    = $messagecontent;
    

    $mail->send();
    header('Location: thankyou.html');
} catch (Exception $e) {
   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}