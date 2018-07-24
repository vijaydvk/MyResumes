<?php

require_once('class.phpmailer.php');

$email = new PHPMailer();
$email->From      = $_POST['mail'];
$email->FromName  = "vijay";
$email->Subject   = $_POST['subject'];
$email->Body      = $_POST['description'];
$email->AddAddress( 'maintenancefreshdesk@yahoo.com' );

$file_to_attach = $_FILES["attach"]["tmp_name"];
$name = $_FILES["attach"]["name"];
$email->AddAttachment( $file_to_attach , $name );

return $email->Send();
?>