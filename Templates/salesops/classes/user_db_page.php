<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class users_op
{
public static function update_users()
 {
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				

				$sql = "update field_data_field_store_id
				set field_store_id_value = :field_store_id_value
				where entity_id = :entity_id
				and entity_type = 'user' 
				and bundle = 'user' ";
				
				$query = $conn->prepare($sql);

				$insert=$query->execute(array(
				":field_store_id_value"=>$_POST['store_id'],
				":entity_id"=>$_POST['uid'],
				));
				
				$sql = "update field_revision_field_store_id
				set field_store_id_value = :field_store_id_value
				where entity_id = :entity_id";
				
				$query = $conn->prepare($sql);

				$insert=$query->execute(array(
				":field_store_id_value"=>$_POST['store_id'],
				":entity_id"=>$_POST['uid'],
				));				
				
				$sql = "update users
				set status = :status
				where uid = :uid";
				
				$query = $conn->prepare($sql);

				$insert=$query->execute(array(
				":status"=>$_POST['status'],
				":uid"=>$_POST['uid'],
				));
				
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been updated successfully.';
				} 
				
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("user_db_page - update:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("user_db_page - update:" . 'Non-PDO-Exception' . $e->getMessage());
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
public static function clear_flood()
 {
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
				$uid = $_POST['uid'];
				$sql = "delete from flood
				where identifier like '$uid%'";
				
				$query = $conn->prepare($sql);

				$delete = $query->execute();
				
				$count = $query->rowCount();
				
				if($delete){
					$retresult['success'] = true;					
					if($count>0)
					{
						$retresult['msg'] = 'Data has been cleared successfully.';
						$retresult['flag'] = 0;
					}
					else
					{
						$retresult['msg'] = 'No data to clear.';
						$retresult['flag'] = 1;
					}
				} 
				
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("user_db_page - update:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("user_db_page - update:" . 'Non-PDO-Exception' . $e->getMessage());
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
