<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class region_op
{
 public static function add_region()
 {	 
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		 $sql = "select count(rvp_uid) as count
				from sun_region
				where
				rvp_uid = :rvp_uid";
			
			$query = $conn->prepare($sql);
			
			$insert=$query->execute(array(
			":rvp_uid"=>$_POST['rvp_uid'],
			));
			
		$row = $query->fetch();
		
		if($row[0] == 0)
		{
			 $short_desc = substr($_POST['region_name'], 0, 5);			
			 $sql = "INSERT INTO sun_region (
				region_name ,
				region_name_short ,
				rvp_uid,
				active
				)VALUES 
				(:region_name, 
				:region_name_short ,
				:rvp_uid, 
				:active
				)";
				
				$query = $conn->prepare($sql);
				
				$insert=$query->execute(array(
				":region_name"=>$_POST['region_name'],
				":region_name_short"=>$short_desc,
				":rvp_uid"=>$_POST['rvp_uid'],
				":active"=>1,
				));
			
			if($insert){
				$retresult['success'] = true;
				$retresult['msg'] = 'Data has been added successfully.';
			}
		}
		else
		{
			$retresult['success'] = false;
			$retresult['msg'] = 'Region name already exists.';
		}			
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("region_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("region_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
public static function delete_region()
 {
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				

				$sql = "update sun_region
				set active = 0
				where region_id = :region_id";
				
				$query = $conn->prepare($sql);

				$insert=$query->execute(array(
				":region_id"=>$_POST['region_id'],
				));
				
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been deleted successfully.';
				} 
				
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("region_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("region_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
