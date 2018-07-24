<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class saveResume
{
public static function add()
 {
	 
	try
	{
				$applicant_id = $_POST["applicant_id"];
				$uid = $_SESSION["uid"];
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$file_name = $_FILES['mFile']['name'];
				$file = $_FILES['mFile']['tmp_name'];
				$ext = explode('.', $file_name );
				$ext_name = strtolower($ext[1]);
				$insert_name = "$applicant_id"."_".time().".".$ext_name;
				move_uploaded_file($file,'../career/uploads/' .$insert_name);
				
				$sql = "INSERT INTO sun_career_applicant_resumes 
						(a_resume_id, applicant_id, file_name,timestamp)
						VALUES 
						('null', '$applicant_id','$insert_name',UNIX_TIMESTAMP())";				

					
				$query = $conn->prepare($sql);
					
				$insert=$query->execute();
					
				$sql = "INSERT INTO sun_career_process_steps_record 
						(record_id,a_step_id,applicant_id,step_status,updated_by_uid,timestamp)
						VALUES 
						('null', 1,$applicant_id,1,$uid,UNIX_TIMESTAMP())";	

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
