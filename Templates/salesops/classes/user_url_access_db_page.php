<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class user_url_access
{
public static function addURL()
 {
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
		$title = $_POST['title'];
		$icon = '<i class="fa fa-external-link"></i>';
		$desc = 'The following link provides you access to General Order Admin site.';
		$uid = $_POST['uid'];
		$auth_type = $_POST['auth_type'];
		$url = $_POST['url'];
		$allow_access = 1;
		$sql = "insert into sun_settings_user_auth values
				(null,'$title','$icon','$desc','$uid','$auth_type','$url','$allow_access')";
		
		$query = $conn->prepare($sql);

		$insert=$query->execute();
		
		if($insert){
			$retresult['success'] = true;
			$retresult['msg'] = 'Data has been updated successfully.';
		} 			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("user_url_access_db_page - addURL:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("user_url_access_db_page - addURL:" . 'Non-PDO-Exception' . $e->getMessage());
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
public static function deleteURL()
 {
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
		$auth_id = $_POST['auth_id'];
		$sql = "delete from sun_settings_user_auth
		where auth_id='$auth_id'";
		
		$query = $conn->prepare($sql);

		$delete = $query->execute();
		
		if($delete){
			$retresult['success'] = true;					
			$retresult['msg'] = 'Data has been deleted successfully.';
		} 			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("user_url_access_db_page - deleteURL:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("user_url_access_db_page - deleteURL:" . 'Non-PDO-Exception' . $e->getMessage());
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
