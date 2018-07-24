<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */

class settings_op
{
public static function add_oreder_prod()
 {
	try
	{	
				
			 	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				if(isset($_POST['op_flag']))
				{

				/* $sql = "insert into sun_general_order_prod_emails(email_id,
						general_product_id,
						email,
						subject,
						excluded_components,
						extra,
						status
						)values
						(:email_id,
						:general_product_id,
						:email,
						:subject,
						:excluded_components,
						:extra,
						:status)";	
						
					$query = $conn->prepare($sql);

					$insert=$query->execute(array(
					":email_id"=>NULL,
					":general_product_id"=>$_POST['general_product_id'],
					":email"=>$_POST['email'],
					":subject"=>$_POST['subject'],
					":excluded_components"=>'',
					":extra"=>'',
					":active"=>1,
					)); */
					
					$general_product_id= $_POST['general_product_id'];
					$email=$_POST['email'];
					$subject=$_POST['subject'];
					
					 $sql = "insert into sun_general_order_prod_emails
					 (email_id,
					 general_product_id,
					 email,
					 subject,
					 excluded_components,
					 extra,
					 status)
					 values(null,
					 $general_product_id,
					 '$email',
					 '$subject',
					 '',
					 '',
					 1)";
					 
					 $query = $conn->prepare($sql);
					 
					 $insert=$query->execute();
					
					if($insert){
						$retresult['success'] = true;
						$retresult['msg'] = 'Data has been added successfully.';
					} 
				}
				else
				{
					$sql = "INSERT INTO sun_general_order_prod (general_product_id,
						product_name ,
						created_by_uid,
						active					
						)VALUES 
						(:general_product_id, 
						:product_name, 
						:created_by_uid,
						:active)";
					
					$query = $conn->prepare($sql);

					$insert=$query->execute(array(
					":general_product_id"=>NULL,
					":product_name"=>$_POST['product_name'],
					":created_by_uid"=>$_SESSION['uid'],
					":active"=>1,
					));
					
					if($insert){
						$retresult['success'] = true;
						$retresult['msg'] = 'Data has been added successfully.';
					} 
				} 				
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("settings_db_page - insert:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("settings_db_page - insert:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
public static function update_oreder_prod()
 {
	try
	{	
			 	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

				if(isset($_POST['op_flag']))
				{
					$sql = "UPDATE sun_general_order_prod_emails 
						set email = :email ,
						subject = :subject
						where email_id = :email_id";
					
					$query = $conn->prepare($sql);

					$insert=$query->execute(array(
					":email"=>$_POST['email'],
					":subject"=>$_POST['subject'],
					":email_id"=>$_POST['email_id'],
					)); 
					
					//echo $_POST['general_produt_id'];
					
					if($insert){
						$retresult['success'] = true;
						$retresult['msg'] = 'Data has been updated successfully.';
					}  					
				}
				else
				{
					$sql = "UPDATE sun_general_order_prod 
						set product_name = :product_name ,
						created_by_uid = :created_by_uid
						where general_product_id = :general_product_id";
					
					$query = $conn->prepare($sql);

					$insert=$query->execute(array(
					":general_product_id"=>$_POST['general_product_id'],
					":product_name"=>$_POST['product_name'],
					":created_by_uid"=>$_SESSION['uid'],
					)); 
					
					//echo $_POST['general_produt_id'];
					
					if($insert){
						$retresult['success'] = true;
						$retresult['msg'] = 'Data has been updated successfully.';
					}  						
				}
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("settings_db_page - update:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("settings_db_page - update:" . 'Non-PDO-Exception' . $e->getMessage());
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

 public static function delete_oreder_prod()
 {
	try
	{	
			 	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

				if(isset($_POST['op_flag']))
				{
					 $sql = "UPDATE sun_general_order_prod_emails 
						set status = :active
						where email_id = :email_id";
					
					$query = $conn->prepare($sql);

					$insert=$query->execute(array(
					":email_id"=>$_POST['email_id'],
					":active"=>0,
					)); 					
				}
				else
				{
					 $sql = "UPDATE sun_general_order_prod 
						set active = :active
						where general_product_id = :general_product_id";
					
					$query = $conn->prepare($sql);

					$insert=$query->execute(array(
					":general_product_id"=>$_POST['general_product_id'],
					":active"=>0,
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
		K18_utility::saveError("settings_db_page - delete:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("settings_db_page - delete:" . 'Non-PDO-Exception' . $e->getMessage());
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
 
public static function activate_oreder_prod()
 {
	try
	{	
			 	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				

			 	 $sql = "UPDATE sun_general_order_prod 
					set active = :active
					where general_product_id = :general_product_id";
				
				$query = $conn->prepare($sql);

				$insert=$query->execute(array(
				":general_product_id"=>$_POST['general_product_id'],
				":active"=>1,
				)); 
				 				
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Data has been updated successfully.';
				}  				
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("settings_db_page - activate:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("settings_db_page - activate:" . 'Non-PDO-Exception' . $e->getMessage());
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
