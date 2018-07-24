<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class district_op
{
 public static function  add_district()
 {	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
				
				 $sql = "INSERT INTO sun_district (district_id,
					district_name ,
					market_id 
					)VALUES 
					(:district_id, 
					:district_name, 
					:market_id)";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(
					":district_id"=>$_POST['district_id'],
					":district_name"=>$_POST['district_name'],
					":market_id"=>$_POST['market_id'],
					));
					
				$store_id=$_POST['store_id'];
				foreach ($store_id as $rslt) {
					$sql = "update sun_stores
					set store_district_id = :district_id
					where store_id = '$rslt'";
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(
					":district_id"=>$_POST['district_id'],
					));
				}
				
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been added successfully.';
				} 
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("district_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("settings_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function  update_district()
 {
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
				
				//echo $_POST['mode'];
				$sql = "update sun_district
				set market_id = :market_id
				where district_id = :district_id";
				$query = $conn->prepare($sql);

				$insert=$query->execute(array(
				":market_id"=>$_POST['market_id'],
				":district_id"=>$_POST['district_id'],
				));
				
				$sql = "update sun_stores
					set store_district_id = 0
					where store_district_id = :district_id";
				$query = $conn->prepare($sql);

				$insert=$query->execute(array(
				":district_id"=>$_POST['district_id'],
				));
				
				$store_id=$_POST['store_id'];
				if($store_id != 'empty')
				{
					foreach ($store_id as $rslt) {
						$sql = "update sun_stores
						set store_district_id = :district_id
						where store_id = '$rslt'";
						$query = $conn->prepare($sql);
						
						$insert=$query->execute(array(
						":district_id"=>$_POST['district_id'],
						));
					}
				}
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been added successfully.';
				} 
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("district_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("settings_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function  delete_district()
 {
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
				
				//echo $_POST['mode'];
				$sql = "update sun_district
				set active = 0
				where district_id = :district_id";
				$query = $conn->prepare($sql);

				$insert=$query->execute(array(
				":district_id"=>$_POST['district_id'],
				));
				
				/* $sql = "update sun_stores
					set store_district_id = 0
					where store_district_id = :district_id";
				$query = $conn->prepare($sql);

				$insert=$query->execute(array(
				":district_id"=>$_POST['district_id'],
				)); */
				
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been added successfully.';
				} 
				
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("district_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("settings_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
