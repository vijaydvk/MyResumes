<?php

class store_op
{
 public static function  add_store()
 {	 
	try
	{	
		$store_id = $_POST['store_id'];
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		if ($_FILES['store_image']['error'] !== UPLOAD_ERR_OK){
			$data = 'Error: ' . $_FILES['store_image']['error'];
			K18_utility::saveError("Store - Add - Line 14: - error value - " . $data . ' File Size Should not exceed 2 MB - ' );
			throw new ErrorException('File Size should not exceed 2 MB', 0, 100, 'store_db_page.php', 76);
		}
		else if ($_FILES['store_image']['error'] == UPLOAD_ERR_OK)
		{
			
			 $sql = "INSERT INTO sun_stores (store_id
				,store_name
				,rq_store_name
				,store_active
				,store_email
				,store_address
				,store_city
				,store_state
				,store_zip
				,store_phone
				,store_uid
				,store_district_id
				)values
				(:store_id,
				:store_name,
				:rq_store_name,
				:store_active,
				:store_email,
				:store_address,
				:store_city,
				:store_state,
				:store_zip,
				:store_phone,
				:store_uid,
				:store_district_id)";
				
				$query = $conn->prepare($sql);
				
				$insert=$query->execute(array(
				":store_id"=>$_POST['store_id'],
				":store_name"=>$_POST['store_name'],
				":rq_store_name"=>$_POST['rq_store_name'],
				":store_active"=>1,
				":store_email"=>$_POST['store_email'],
				":store_address"=>$_POST['store_address'],
				":store_city"=>$_POST['store_city'],
				":store_state"=>$_POST['store_state'],
				":store_zip"=>$_POST['store_zip'],
				":store_phone"=>$_POST['store_phone'],
				":store_uid"=>$_POST['store_uid'],
				":store_district_id"=>$_POST['store_district_id'],
				));
			
			$filename = $_FILES['store_image']['name'];
			$filesize = $_FILES['store_image']['size'];
			$filemime = $_FILES['store_image']['type'];
			
			if($insert)
			{
				if ($filemime == 'image/jpeg' || $filemime == 'image/gif'
							|| $filemime == 'image/png')
				{  
					if ($filesize > 0)
						$filesize =  $filesize/1024;
			   
					if ($filesize > 1000)
					{
					   $percent = 0.50;
					   $quality = 60;
					}
					else if ($filesize > 500 && $filesize < 1000)
					{
					   $percent = 0.60;
					   $quality = 65;
					}
					else if ($filesize > 300 && $filesize < 500)
					{
					   $percent = 0.75;
					   $quality = 75;
					}
					else
					{
					   $percent = 1;
					   $quality = 100;
					}
			   
					$filename = $_FILES['store_image']['tmp_name'];
					$filename_upload = $filename;
					// Get new dimensions
					list($width, $height) = getimagesize($filename);
					$new_width = $width * $percent;
					$new_height = $height * $percent;

					// Resample
					$image_p = imagecreatetruecolor($new_width, $new_height);
				   
					//$image = imagecreatefromjpeg($filename);
				   
					if ($filemime == 'image/jpeg')
					{
						$ext_name = 'jpg';
						$image = imagecreatefromjpeg($filename);
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						imagejpeg($image_p, $filename_upload, $quality);
					}
					elseif ($filemime == 'image/gif')
					{
						$ext_name = 'gif';
						$image = imagecreatefromgif($filename);
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						imagegif($image_p, $filename_upload, $quality);
					}
					elseif ($filemime == 'image/png')
					{
						$ext_name = 'png';
						$image = imagecreatefrompng($filename);
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						imagepng($image_p, $filename_upload, 7);
					}			   
				
				}
				else
				{			
					$ext = explode('.', $filename );
					$ext_name = strtolower($ext[1]);
					$filename = $_FILES['store_image']['tmp_name'];
					$filename_upload = $filename;
				}
				
				move_uploaded_file($filename_upload,
				'sites/default/files/pictures_store/' . $store_id.".".$ext_name);
				
				$store_image_path = 'sites/default/files/pictures_store/' . $store_id.".".$ext_name;
				
				$sql = "update sun_stores
				set store_image = '$store_image_path'
				where store_id = :store_id";
				$query = $conn->prepare($sql);

				$insert=$query->execute(array(
				":store_id"=>$_POST['store_id'],
				));
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been added successfully.';
				}
				
				
			}
		}	
				
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("store_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("store_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function  update_store()
 {
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
		$store_id = $_POST['store_id'];
		if(!$_FILES['store_image']['name']=="")
		{
			if ($_FILES['store_image']['error'] !== UPLOAD_ERR_OK){
				$updateok = false;
				$file_upload_needed = false;
				$data = 'Error: ' . $_FILES['store_image']['error'];
				K18_utility::saveError("Regular Expense - Add - Line 76: - error value - " . $data . ' File Size Should not exceed 2 MB - ' );
				throw new ErrorException('File Size should not exceed 2 MB', 0, 100, 'regular_expense.php', 76);
			}
			else if ($_FILES['store_image']['error'] == UPLOAD_ERR_OK){
				$updateok = true;
				$file_upload_needed = true;
			}	
		}
		else
		{
			$updateok = true;
			$file_upload_needed = false;
		}
		
		if ($file_upload_needed)
		{
			$filename = $_FILES['store_image']['name'];
			$filesize = $_FILES['store_image']['size'];
			$filemime = $_FILES['store_image']['type'];
			
			if ($filemime == 'image/jpeg' || $filemime == 'image/gif'
							|| $filemime == 'image/png')
			{  
				if ($filesize > 0)
							   $filesize =  $filesize/1024;
			   
				if ($filesize > 1000)
				{
							   $percent = 0.50;
							   $quality = 60;
				}
				else if ($filesize > 500 && $filesize < 1000)
				{
							   $percent = 0.60;
							   $quality = 65;
				}
				else if ($filesize > 300 && $filesize < 500)
				{
							   $percent = 0.75;
							   $quality = 75;
				}
				else
				{
							   $percent = 1;
							   $quality = 100;
				}
			   
				$filename = $_FILES['store_image']['tmp_name'];
				$filename_upload = $filename;
				// Get new dimensions
				list($width, $height) = getimagesize($filename);
				$new_width = $width * $percent;
				$new_height = $height * $percent;

				// Resample
				$image_p = imagecreatetruecolor($new_width, $new_height);
			   
				//$image = imagecreatefromjpeg($filename);
			   
				if ($filemime == 'image/jpeg')
				{
					$ext_name = 'jpg';
					$image = imagecreatefromjpeg($filename);
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					imagejpeg($image_p, $filename_upload, $quality);
				}
				elseif ($filemime == 'image/gif')
				{
					$ext_name = 'gif';
					$image = imagecreatefromgif($filename);
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					imagegif($image_p, $filename_upload, $quality);
				}
				elseif ($filemime == 'image/png')
				{
					//$ext_name = 'png';
					$ext_name = 'jpg';
					$image = imagecreatefrompng($filename);
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					//imagepng($image_p, $filename_upload, 7);
					// As imagepng creates image of larger size, 
					// we use imagejpeg to convert png to jpg 
					// thus reduces output image size
					imagejpeg($image_p, $filename_upload, $quality);
				}			   
				

				// Output
				//imagejpeg($image_p, $filename_upload, 100);
				
			}
			else
			{			
				$ext = explode('.', $filename );
				$ext_name = strtolower($ext[1]);
				$filename = $_FILES['store_image']['tmp_name'];
				$filename_upload = $filename;
			}
			
			move_uploaded_file($filename_upload,
				'sites/default/files/pictures_store/' . $store_id.".".$ext_name);
				
				$store_image_path = 'sites/default/files/pictures_store/' . $store_id.".".$ext_name;
				
				$sql = "update sun_stores
				set store_image = '$store_image_path'
				where store_id = :store_id";
				
				$query = $conn->prepare($sql);
			  
				$insert=$query->execute(array(
				":store_id"=>$_POST['store_id'],
				));
			
		}
		if ($updateok)
		{
		 
			$sql = "update sun_stores
					set store_name = :store_name,
					rq_store_name = :rq_store_name,
					store_email = :store_email,
					store_address = :store_address,
					store_city = :store_city,
					store_state = :store_state,
					store_zip = :store_zip,
					store_phone = :store_phone,
					store_uid = :store_uid,
					store_district_id = :store_district_id
					where store_id = :store_id";
					
				$query = $conn->prepare($sql);

				$insert=$query->execute(array(
				":store_id"=>$_POST['store_id'],
				":store_name"=>$_POST['store_name'],
				":rq_store_name"=>$_POST['rq_store_name'],
				":store_email"=>$_POST['store_email'],
				":store_address"=>$_POST['store_address'],
				":store_city"=>$_POST['store_city'],
				":store_state"=>$_POST['store_state'],
				":store_zip"=>$_POST['store_zip'],
				":store_phone"=>$_POST['store_phone'],
				":store_uid"=>$_POST['store_uid'],
				":store_district_id"=>$_POST['store_district_id'],
				));
			
			if($insert){
				$retresult['success'] = true;
				$retresult['msg'] = 'Data has been updated successfully.';
			}
		}
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("store_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("store_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function  delete_store()
 {
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
		
		$sql = "update sun_stores
			set store_active = 0
			where store_id = :store_id";
			
		$query = $conn->prepare($sql);

		$insert=$query->execute(array(
		":store_id"=>$_POST['store_id'],
		));
		
		if($insert){
			$retresult['success'] = true;
			$retresult['msg'] = 'Data has been deleted successfully.';
		}
				
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("store_db_page - Delete:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("store_db_page - Delete:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
 public static function  active_store()
 {
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
		
		$sql = "update sun_stores
			set store_active = 1
			where store_id = :store_id";
			
		$query = $conn->prepare($sql);

		$insert=$query->execute(array(
		":store_id"=>$_POST['store_id'],
		));
		
		if($insert){
			$retresult['success'] = true;
			$retresult['msg'] = 'Data has been deleted successfully.';
		}
				
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("store_db_page - Delete:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("store_db_page - Delete:" . 'Non-PDO-Exception' . $e->getMessage());
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
