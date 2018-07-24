<?php 
/* require_once '/var/www/html/salesops/php_libs/php-excel-reader/excel_reader2.php'; */ //(able class from https://code.google.com/archive/p/php-excel-reader/)
/* $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	 */
echo "hi";
/* $dsr_filedate = date("Y-m-d h:i:s", filemtime('/var/www/html/suncomportal/sites/default/files/reports/dailyreports/DSR_Portal.xlsx'));
$edsr_filedate = date("Y-m-d h:i:s", filemtime('/var/www/html/suncomportal/sites/default/files/reports/dailyreports/EDSR_Portal.xlsx'));
echo $dsr_filedate;
echo '<br>';
echo $edsr_filedate;   */


/* $updatedb_1 = ""; 
$updatedb_2 = "";

		$updatedb_1 = "UPDATE sun_reports_detail SET file_link_update_1 = '$dsr_filedate' WHERE r_detail_id = '1';";
		//NOW UPDATE THE DATABASE TABLE
		$updatedb_2 = "UPDATE sun_reports_detail SET file_link_update_1 = '$edsr_filedate' WHERE r_detail_id = '2';";
		//NOW UPDATE THE DATABASE TABLE
		$query = $conn->prepare($updatedb_1);					
		$update=$query->execute());
		$query = $conn->prepare($updatedb_2);					
		$update=$query->execute());	  */
}		
		
/* $mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'vijayakumard01@@gmail.com';
$mail->Password = '01pallpandi1988';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->From = 'vijayakumard01@gmail.com';
$mail->FromName = 'vijay';
$mail->addAddress('vkumar@suncommobile.com');

$mail->WordWrap = 50;
$mail->isHTML(true);

$mail->Subject = 'Using PHPMailer';
$mail->Body    = 'Hi Iam using PHPMailer library to sent SMTP mail from localhost';

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent'; */

?>
