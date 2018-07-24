<?php
require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class Global_Admin
{
public static function get_global_admin()
 {
	 
	try
	{
				$database = new Database();
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
				return;
			
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
