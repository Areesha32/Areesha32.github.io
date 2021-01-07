<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail = new PHPMailer(true);

$alert = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

try {
$mail->isSMTP();
$mail->Host = $_ENV['SMTP_HOST'];
$mail->Port = (int)$_ENV['SMTP_PORT'];
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';

$mail->Username=$_ENV['SMTP_USERNAME'];
$mail->Password= $_ENV['SMTP_PASSWORD'];

$mail->setFrom($email, $name);
$mail->addAddress($_ENV['SMTP_EMAIL']);

$mail->isHTML(true);
$mail->Subject = "Parakeet Systems Contact Page";
$mail->Body = "<h3>Name : $name <br> Email: $email <br> Message: $message <h3>";
$mail->send();

$alert = "<title>Parakeet Systems</title>
        
<link rel='icon'
type='img/png' 
href='/staging/img/favicon.png'>
<div style='text-align: center;'>
<img 
src='img/Green.svg' 
style='width:30%;
height:250px; 
display: block;
margin-left: auto;
margin-right: auto;' >
<span> Message Sent! Thank you for contacting us.</span>
<br>
<br>
<a href='index.php' style='color: #03c04a; text-decoration: none;'> Click here to go back! </a>
</div>";
} catch (Exception $e) {
$alert = "<title>Parakeet Systems</title>
<link rel='icon'
type='img/png' 
href='/img/favicon.png'>
<div style='text-align: center;'>
<img 
src='img/Green.svg' 
style='width:30%; 
height:250px;
display: block;
margin-left: auto;
margin-right: auto;' >
<span style='color: #d30c0c;'>Sorry, message not sent</span>
<br>
<br>
<a href='index.php' style='color: #; text-decoration: none; '> Click here to go back!</a>
</div>";
}
echo $alert;
}
