<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class market_op
{
 public static function  add_market()
 {	 
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

		 $sql = "select count(market_id) as count
				from sun_market
				where
				market_id = :market_id";
			
			$query = $conn->prepare($sql);
			
			$insert=$query->execute(array(
			":market_id"=>$_POST['market_id'],
			));
			
		$row = $query->fetch();
		
		if($row[0] == 0)
		{
						
			 $sql = "select rvp_uid as rd_uid
					from sun_region
					where
					region_id = :region_id";
				
				$query = $conn->prepare($sql);
				
				$insert=$query->execute(array(
				":region_id"=>$_POST['region_id'],
				));
			$row = $query->fetch();
			
			$rd_uid = $row[0];
			
			
			
			 $sql = "INSERT INTO sun_market (market_id,
				market_name ,
				long_market_name,
				rd_uid,
				region_id,
				active
				)VALUES 
				(:market_id, 
				:market_name, 
				:long_market_name,
				:rd_uid,
				:region_id,
				:active
				)";
				
				$query = $conn->prepare($sql);
				
				$insert=$query->execute(array(
				":market_id"=>$_POST['market_id'],
				":market_name"=>$_POST['market_name'],
				":long_market_name"=>$_POST['market_name'],
				":rd_uid"=>$rd_uid,
				":region_id"=>$_POST['region_id'],
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
			$retresult['msg'] = 'Market name already exists.';
		}			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("market_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("market_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function  update_market()
 {
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
		if($_POST['region_id'] == '')
		{
			$region_id = 0;
		}
		else
		{
			$region_id = $_POST['region_id'];
		}
		 $sql = "select rvp_uid as rd_uid
				from sun_region
				where
				region_id = :region_id";
			
			$query = $conn->prepare($sql);
			
			$insert=$query->execute(array(
			":region_id"=>$_POST['region_id'],
			));
		$row = $query->fetch();
		
		$rd_uid = $row[0];			
		
		$sql = "update sun_market
				set region_id = :region_id,
				rd_uid = :rd_uid
				where market_id = :market_id";
			$query = $conn->prepare($sql);

			$insert=$query->execute(array(
			":market_id"=>$_POST['market_id'],
			":region_id"=>$region_id,
			":rd_uid"=>$rd_uid,
			));
		
		if($insert){
			$retresult['success'] = true;
			$retresult['msg'] = 'Data has been updated successfully.';
		}
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("market_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("market_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function  delete_market()
 {
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
		
		$sql = "update sun_market
			set active = 0
			where market_id = :market_id";
		$query = $conn->prepare($sql);

		$insert=$query->execute(array(
		":market_id"=>$_POST['market_id'],
		));
		
		if($insert){
			$retresult['success'] = true;
			$retresult['msg'] = 'Data has been deleted successfully.';
		}
				
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("market_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("market_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
