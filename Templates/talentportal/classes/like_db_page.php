<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class saveLike
{
public static function add()
 {
	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO sun_career_applicant_likes (a_like_id,
					applicant_id,uid,is_like,timestamp) 
					VALUES (:a_like_id,:applicant_id,:uid,:is_like,UNIX_TIMESTAMP())";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(":a_like_id"=>null,					
					":applicant_id"=>$_POST['applicant_id'],
					":uid"=>$_SESSION['uid'],
					":is_like"=>$_POST['is_like'],
					));
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been added successfully.';
				}
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("like_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("like_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
public static function update()
 {	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
						
					$sql = "update sun_career_applicant_likes set is_like = :is_like,
					uid=:uid,
					timestamp = UNIX_TIMESTAMP()
					where a_like_id = :applicant_id ";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(":is_like"=>$_POST['is_like'],
					":applicant_id"=>$_POST['applicant_id'],
					":uid"=>$_SESSION['uid'],
					));	
					
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been updated successfully.';
				}
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("like_db_page - Update:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("like_db_page - Update:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function viewApplicant()
 {	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
						
					$sql = "insert into sun_career_applicant_viewed
							(a_view_id,
							applicant_id,
							uid,
							timestamp) values
							(:a_view_id,
							:applicant_id,
							:uid,
							UNIX_TIMESTAMP())";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(":a_view_id"=>null,
					":applicant_id"=>$_POST['applicant_id'],
					":uid"=>$_SESSION['uid'],
					));	
					
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been updated successfully.';
				}
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("like_db_page - viewApplicant:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("like_db_page - viewApplicant:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function updateApplicantLoc()
 {	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
						
					$sql = "update sun_career_applicant set close_by_store_id = :close_by_store_id
					where applicant_id = :applicant_id ";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(":close_by_store_id"=>$_POST['close_by_store_id'],
					":applicant_id"=>$_POST['applicant_id'],
					));	
					
					
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been updated successfully.';
				}
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("like_db_page - updateApplicantLoc:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("like_db_page - updateApplicantLoc:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function updateApplicantStatus()
 {	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
						
					$sql = "update sun_career_applicant set active = :active
					where applicant_id = :applicant_id ";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(":active"=>$_POST['active'],
					":applicant_id"=>$_POST['applicant_id'],
					));	
					
					
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been updated successfully.';
				}
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("like_db_page - updateApplicantStatus:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("like_db_page - updateApplicantStatus:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function updateApplicantPosition()
 {	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
						
					$sql = "update sun_career_applicant set position_job_id = :position_job_id
					where applicant_id = :applicant_id ";
					
					$query = $conn->prepare($sql);
					
					$insert=$query->execute(array(":position_job_id"=>$_POST['position_job_id'],
					":applicant_id"=>$_POST['applicant_id'],
					));	
					
					
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been updated successfully.';
				}
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("like_db_page - updateApplicantPosition:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("like_db_page - updateApplicantPosition:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function updateApplicantreference()
 {	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$applicant_id = $_POST["applicant_id"];
				$uid = $_SESSION["uid"];
				$reference_fname = $_POST["reference_fname"];
				$reference_lname = $_POST["reference_lname"];
				$reference_phone = $_POST["reference_phone"];
				$op_flag = $_POST["op_flag"];
				
				if($op_flag == "add")
				{
					$sql = "insert into sun_career_references values(null,$applicant_id,$uid,'$reference_fname','$reference_lname','$reference_phone',now())";
				}
				else
				{
					$sql = "update sun_career_references set 
							uid=$uid,
							reference_fname='$reference_fname',
							reference_lname='$reference_lname',
							reference_phone='$reference_phone',
							update_date = now()
							where applicant_id=$applicant_id";
				}
				
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
		K18_utility::saveError("like_db_page - updateApplicantreference:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("like_db_page - updateApplicantreference:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function updateHiringSteps()
 {	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$uid = $_SESSION["uid"];
				$applicant_id = $_POST["applicant_id"];
				$hiring_step_id = $_POST["hiring_step_id"];
				$sql = "select hiring_step_id from sun_career_hiring_steps_status where hiring_step_id=$hiring_step_id and applicant_id=$applicant_id";
				$query = $conn->prepare($sql);
				$query->execute();
				$row=$query->rowCount();
				if($row>0)
				{
					$retresult['success'] = 'Duplicate';
					$retresult['msg'] = 'Data Already Exists.';					
				}
				else
				{
					$sql = "insert into sun_career_hiring_steps_status values($hiring_step_id,$applicant_id,$uid,UNIX_TIMESTAMP())";
					$query = $conn->prepare($sql);
					$insert=$query->execute();	
					if($insert){
						$retresult['success'] = true;
						$retresult['msg'] = 'Data has been updated successfully.';
					}	
				}				
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("like_db_page - updateHiringSteps:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("like_db_page - updateHiringSteps:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function updateApprovalSteps()
 {	 
	try
	{	
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$uid = $_SESSION["uid"];
				$applicant_id = $_POST["applicant_id"];
				$approval_step_id = $_POST["approval_step_id"];
				$decision = $_POST["decision"];
				$sql = "insert into sun_career_approval_steps_status values($approval_step_id,$applicant_id,$uid,$decision,UNIX_TIMESTAMP())";
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
		K18_utility::saveError("like_db_page - updateHiringSteps:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("like_db_page - updateHiringSteps:" . 'Non-PDO-Exception' . $e->getMessage());
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
