<?php
//require '/var/www/html/salesops/php_libs/PHPMailer/class.phpmailer.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class Send_Mail
{
public static function Sun_Send_Mail($to,$body,$subject)
 {
	 
	try
	{
		 	$mail = new PHPMailer();
			$mail->IsHTML(true);
			$mail->From = "portal@mysuncomportal.com";
			$mail->FromName = "Admin Portal";

			$mail->addAddress($to);

			$bodyDisplay = '';											
			$bodyDisplay .= '<p><strong>'.$body.'</strong></p>';

			$mail->Subject = $subject;
			$mail->Body = $bodyDisplay;

			if(!$mail->Send()) {
				echo "1";
				return;
			} else {
				echo "0";
				return;
			} 	
/* 				$database = new Database();
				$conn = $database->getConnection(); 
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
				$qry =	"select * from sun_career_setting where setting_name = 'Admin'";	
				$st = $conn->prepare( $qry );	
				$st->execute();
				$data = array();
				$row = $st->fetchAll(PDO::FETCH_ASSOC);
				foreach ($row as $key => $value) {
					$data[$key] = array_map('utf8_encode', $value);				
				}	
				$conn = null;	
				ob_start("ob_gzhandler");
				$retresult['success'] = "check";
				$retresult['details'] = $data;				
				echo(json_encode($retresult));
				return; */
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		$retresult['errors']  = "Submission is not successful";
		echo json_encode($retresult);
		$conn = null;
		return;
	}
	catch (Exception $e)
    {
		$retresult['success'] = false;
		$retresult['errors']  = "Submission is not successful";
		echo json_encode($retresult);
		$conn = null;
		return;
	}
 }
 
}
?>
