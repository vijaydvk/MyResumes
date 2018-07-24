<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class settings_op
{
 public static function  add_settings()
 {
	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				if($_POST['op_flag'] =="categories")
				{
					$sql = "INSERT INTO sun_it_ticket_categories (tk_category,
					tk_active ) 
					VALUES (:tk_category, :tk_active)";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(":tk_category"=>$_POST['tk_category'],					
					":tk_active"=>'1'				
					));
				}
				if($_POST['op_flag'] =="status")
				{
					$sql = "INSERT INTO k18_lookup (codegroup,
					codeid ,
					codevalue ,
					shortdesc,
					longdesc,
					sortorder,
					status,
					createdby,					
					createdon) 
					VALUES (:codegroup, 
					:codeid, 
					:codevalue,
					:shortdesc,
					:longdesc,
					:sortorder,
					:status,
					:createdby,
					now()
					)";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(":codegroup"=>'suncom',
					":codeid"=>'it_ticket_status',
					":codevalue"=>$_POST['codevalue'],
					":shortdesc"=>$_POST['codevalue'],
					":longdesc"=>$_POST['codevalue'],
					":sortorder"=>$_POST['sortorder'],
					":status"=>'Active',
					":createdby"=>$_SESSION['name'],					
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
		K18_utility::saveError("settings_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
  public static function  update_settings()
 {
	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				if($_POST['op_flag'] =="categories")
				{								
					$sql = "update sun_it_ticket_categories set tk_category = :tk_category
					where tk_id = :tk_id ";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(":tk_category"=>$_POST['tk_category'],
					":tk_id"=>$_POST['tk_id'],
					));	
				}
				if($_POST['op_flag'] =="status")
				{
					$sql = "update k18_lookup set codevalue = :codevalue,
					shortdesc = :shortdesc,
					longdesc = :longdesc,
					sortorder = :sortorder
					where id = :id ";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(":codevalue"=>$_POST['codevalue'],
					":shortdesc"=>$_POST['codevalue'],
					":longdesc"=>$_POST['codevalue'],
					":sortorder"=>$_POST['sortorder'],
					":id"=>$_POST['id'],
					));
				}
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been updated successfully.';
				}
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("settings_db_page - Update:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("settings_db_page - Update:" . 'Non-PDO-Exception' . $e->getMessage());
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
 public static function  delete_settings()
 {
	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				if($_POST['op_flag'] =="categories")
				{								
					$sql = "update sun_it_ticket_categories set tk_active = :tk_active
					where tk_id = :tk_id ";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(":tk_active"=>'0',
					":tk_id"=>$_POST['tk_id'],
					));	
				}
				if($_POST['op_flag'] =="status")
				{
					$sql = "update k18_lookup set status = :status
					where id = :id ";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(":status"=>'I',
					":id"=>$_POST['id'],
					));
				}
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been updated successfully.';
				}
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("settings_db_page - Deletee:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("settings_db_page - Delete:" . 'Non-PDO-Exception' . $e->getMessage());
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
