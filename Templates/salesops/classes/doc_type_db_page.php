<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class doc_type_op
{
 public static function add_doctype()
 {
	$uid=$_SESSION["uid"];
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
			 $sql = "INSERT INTO sun_stores_docs_types (doc_type,
				created_by_uid ,
				active
				)VALUES 
				(:doc_type, 
				:created_by_uid, 
				:active
				)";
				
				$query = $conn->prepare($sql);
				
				$insert=$query->execute(array(
				":doc_type"=>$_POST['doc_type'],
				":created_by_uid"=>$uid,
				":active"=>1,
				));
			
			if($insert){
				$retresult['success'] = true;
				$retresult['msg'] = 'Data has been added successfully.';
			}
				
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("doc_type_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("doc_type_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
public static function update_doctype()
 {
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
		
		$sql = "update sun_stores_docs_types
			set active = :active,
			doc_type = :doc_type
			where doc_type_id = :doc_type_id";
		$query = $conn->prepare($sql);

		$insert=$query->execute(array(
		":doc_type_id"=>$_POST['doc_type_id'],
		":doc_type"=>$_POST['doc_type'],
		":active"=>$_POST['status'],
		));
		
		if($insert){
			$retresult['success'] = true;
			$retresult['msg'] = 'Data has been deleted successfully.';
		}
				
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("doc_type_db_page - Delete:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("doc_type_db_page - Delete:" . 'Non-PDO-Exception' . $e->getMessage());
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
