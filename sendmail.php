<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.ionos.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@fittingspro.com';                     //SMTP username
    $mail->Password   = '9428101102@dD';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('info@fittingspro.com', 'Info');
    $mail->addAddress('info@fittingspro.com', 'Info');     //Add a recipient

    $mail->addReplyTo('info@fittingspro.com', 'Info');

    //form data

    $question = $_POST['question'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $cname = $_POST['cname'];
    $phone = $_POST['phone'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $message = $_POST['message'];
    



    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Inquiry form: " . $cname;
    // $mail->Body = 'Test Bod';
    $mail->Body    = "Email: " . $email . "</br>Question: " . $question . "</br>Fullname: " . $fullname . "</br>" . $phone . "</br>" . $address1 . "</br>" . $address2 . "</br>" . $city . "</br>". $state . "</br>" . $zip . "</br>" . $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    alert("Your response hass been submitted. We will contact you ASAP.");
    // echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}