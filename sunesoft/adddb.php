<?php


$name=$_POST['name'];

$email=$_POST['email'];

$sub=$_POST['subject'];

$msg=$_POST['feedback'];


$nsub=$name.'-'.$sub;

$headers = "From:".''.$email.''."\r\n";
$headers .= "Reply-To: ".''.$email.''."\r\n";
$headers .= "Return-Path: ".''.$email.''."\r\n";
$headers .= "CC: admin@sune-soft.com\r\n";

if ( mail("info@sune-soft.com",$nsub,$msg,$headers) )
   {

       echo "<script>alert('Mail Sent Successfully');window.location.href = 'http://www.sune-soft.com/contact.html';</script>";
                                                                                                         
       
       

   }
  else 
  {
       echo "<script>alert('There is problem in Mail Right Now Sorry For Inconvinience');window.location.href = 'http://www.sune-soft.com/contact.html';</script>";
       
       
   }





?>
