<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class saveApplicantSteps
{
public static function add()
 {
	 
	try
	{
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
		$array = $_POST["data"];
		$items = array();
		foreach($array as $values) {
		 $items[] = $values;
		}
		if($_POST["type"] == "Job Fit Survey")
		{
			$table = 'sun_career_step_jobfitsurvey';
		}
		else if($_POST["type"] == "Interviewed")
		{
			$table = 'sun_career_step_interviewed';
		}
		else if($_POST["type"] == "Interview Notes")
		{
			$table = 'sun_career_step_interviewnotes';
		}
		else if($_POST["type"] == "Video")
		{
			$table = 'sun_career_step_video';
		}
		else if($_POST["type"] == "Next Step")
		{
			$table = 'sun_career_step_nextstep';
		}		
		$array_string=serialize($items);
		$applicant_id = $_POST["applicant_id"];
		$uid = $_SESSION["uid"];
		//$array_string=serialize($array);
		//print_r($array_string);
		//print_r($_POST["data"]);
		$sql = "INSERT INTO $table 
				(applicant_id, uid, timestamp,formdata)
				VALUES 
				('$applicant_id', '$uid',UNIX_TIMESTAMP(),'$array_string')";				

			
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
		K18_utility::saveError("save_resume_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("save_resume_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
public static function deleteR()
 {
	 
	try
	{
				$a_resume_id = $_POST["a_resume_id"];
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "delete from sun_career_applicant_resumes where a_resume_id=$a_resume_id";				
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
		K18_utility::saveError("save_resume_db_page - Delete:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("save_resume_db_page - Delete:" . 'Non-PDO-Exception' . $e->getMessage());
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
