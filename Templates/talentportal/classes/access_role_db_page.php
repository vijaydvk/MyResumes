<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class updateAccessRole
{
	
public static function insert()
 {
	 
	try
	{
				$a_button_id = $_POST["a_button_id"];				
				$site_setting_friendly_name = $_POST["site_setting_friendly_name"];
				$site_setting_name = str_replace(' ','',$_POST["site_setting_friendly_name"]);
				$rid = $_POST["rid"];
				$uid=$_SESSION["uid"];
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
				$sql = "insert into sun_career_access_by_rid values(null,$a_button_id,'$site_setting_name','$site_setting_friendly_name','$rid',1,now(),'$uid')";	

				$query = $conn->prepare($sql);
					
				$insert=$query->execute();						
					
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been added successfully.';
				}
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("update_process_steps_db_page - Insert:" . 'PDO-Exception' . $e->getMessage());
		if (contains($e->getMessage(), '18KSoftec Error:'))
		{
			$retresult['errors']  = strstr($e->getMessage(), '18KSoftec Error:');
		}
		else
		{
			//$retresult['errors']  = $e->getMessage();
			$retresult['errors']  = "Submission is not successful";
		}
		echo json_encode($retresult);
		$conn = null;
		return;
	}
	catch (Exception $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("update_process_steps_db_page - Insert:" . 'Non-PDO-Exception' . $e->getMessage());
		if (contains($e->getMessage(), '18KSoftec Error:'))
		{
			$retresult['errors']  = strstr($e->getMessage(), '18KSoftec Error:');
		}
		else
		{
			//$retresult['errors']  = $e->getMessage();
			$retresult['errors']  = "Submission is not successful";
		}
		echo json_encode($retresult);
		$conn = null;
		return;
	}
    $conn = null;
	
	echo json_encode($retresult);
	return;
	//echo $data;

 }
 
public static function deleteP()
 {
	 
	try
	{
				$rid_setting_id = $_POST["rid_setting_id"];
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
				$sql = "update sun_career_access_by_rid set active=0 where rid_setting_id=$rid_setting_id";	

				$query = $conn->prepare($sql);
					
				$insert=$query->execute();						
					
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been added successfully.';
				}
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("update_process_steps_db_page - Delete:" . 'PDO-Exception' . $e->getMessage());
		if (contains($e->getMessage(), '18KSoftec Error:'))
		{
			$retresult['errors']  = strstr($e->getMessage(), '18KSoftec Error:');
		}
		else
		{
			//$retresult['errors']  = $e->getMessage();
			$retresult['errors']  = "Submission is not successful";
		}
		echo json_encode($retresult);
		$conn = null;
		return;
	}
	catch (Exception $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("update_process_steps_db_page - Delete:" . 'Non-PDO-Exception' . $e->getMessage());
		if (contains($e->getMessage(), '18KSoftec Error:'))
		{
			$retresult['errors']  = strstr($e->getMessage(), '18KSoftec Error:');
		}
		else
		{
			//$retresult['errors']  = $e->getMessage();
			$retresult['errors']  = "Submission is not successful";
		}
		echo json_encode($retresult);
		$conn = null;
		return;
	}
    $conn = null;
	
	echo json_encode($retresult);
	return;
	//echo $data;

 }
 
public static function active()
 {
	 
	try
	{
				$rid_setting_id = $_POST["rid_setting_id"];
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
				$sql = "update sun_career_access_by_rid set active=1 where rid_setting_id=$rid_setting_id";	

				$query = $conn->prepare($sql);
					
				$insert=$query->execute();						
					
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been added successfully.';
				}
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("update_process_steps_db_page - Active:" . 'PDO-Exception' . $e->getMessage());
		if (contains($e->getMessage(), '18KSoftec Error:'))
		{
			$retresult['errors']  = strstr($e->getMessage(), '18KSoftec Error:');
		}
		else
		{
			//$retresult['errors']  = $e->getMessage();
			$retresult['errors']  = "Submission is not successful";
		}
		echo json_encode($retresult);
		$conn = null;
		return;
	}
	catch (Exception $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("update_process_steps_db_page - Active:" . 'Non-PDO-Exception' . $e->getMessage());
		if (contains($e->getMessage(), '18KSoftec Error:'))
		{
			$retresult['errors']  = strstr($e->getMessage(), '18KSoftec Error:');
		}
		else
		{
			//$retresult['errors']  = $e->getMessage();
			$retresult['errors']  = "Submission is not successful";
		}
		echo json_encode($retresult);
		$conn = null;
		return;
	}
    $conn = null;
	
	echo json_encode($retresult);
	return;
	//echo $data;

 }

}
?>
