<?php

//session_start();

// require configuration file
//require 'config/database.php';
include_once '../classes/Send_Mail.php';
include_once '../classes/global_admin_page.php';
include_once '../config/database.php';
if(session_id() == '') {session_start();}
$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : "";
$action(); 
function getApplicantListDetails()
{	
	try
	{
		$uid = $_SESSION['uid'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"SELECT 
					SCA.applicant_id,
					SCA.first_name,
					SCA.last_name,
					SCA.contact_number,
					SCA.zip,
					date_format(SCA.applied_date,'%m/%d/%y %h:%m %p') as 'applied_date',					
					SCA.uploaded_file,
					ifnull(SCAL.is_like,'-') as is_like,
					ifnull(SCAL.a_like_id,'-') as a_like_id,
					ifnull(SCAV.a_view_id,'-') as a_view_id,
					ifnull(s.store_name,'N/A') as store_name
					from sun_career_applicant SCA
					left join sun_career_applicant_likes SCAL on SCA.applicant_id = SCAL.applicant_id and SCAL.uid = '$uid'
					left join sun_career_applicant_viewed SCAV on SCA.applicant_id = SCAV.applicant_id and SCAV.uid = '$uid'
					left join sun_stores s on SCA.close_by_store_id = s.store_id";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getDataChangeDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getDataChangeDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
}

function getApplicantListPrescreenDetails()
{	
	try
	{
		$applicant_id = $_GET['applicant_id'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"SELECT * from sun_career_applicant_prescreen where applicant_id='$applicant_id'";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getDataChangeDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getDataChangeDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
}

function getApplicantUniqueDetails()
{	
	try
	{
		$applicant_id = $_GET['applicant_id'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"SELECT SCA.*,ifnull(SS.store_name,'N/A') as store_name,group_concat(SCAR.a_resume_id,',') as resume_id,
				group_concat(SCAR.file_name,',') as file_name,
				group_concat(date_format(from_unixtime(SCAR.timestamp ),'%m/%d/%y %h:%m %p'),',') as timestamp,
				ifnull(SCR.reference_fname,'') as reference_fname,
				ifnull(SCR.reference_lname,'') as reference_lname,
				ifnull(SCR.reference_phone,'') as reference_phone
								from  sun_career_applicant_resumes SCAR, 
		sun_career_applicant SCA
		left join sun_stores SS on SS.store_id=SCA.close_by_store_id
		left join sun_career_references SCR on SCR.applicant_id=SCA.applicant_id
		where 
		SCA.applicant_id='$applicant_id'
		and SCAR.applicant_id = SCA.applicant_id";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getApplicantUniqueDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getApplicantUniqueDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
}

function getApplicantLikeDetails()
{	
	try
	{
		$applicant_id = $_GET['applicant_id'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"SELECT SCAL.*,
				u.name
				from 
				sun_career_applicant_likes SCAL,
				users u
				where SCAL.applicant_id='$applicant_id'
				and 
				SCAL.uid = u.uid";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getApplicantLikeDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getApplicantUniqueDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
}

function getStoreDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"SELECT store_id,store_name from sun_stores where store_active='1' order by store_name";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getStoreDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getStoreDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
}

function getMyLikesDetails()
{	
	try
	{
		$uid = $_SESSION["uid"];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"SELECT 
					SCA.applicant_id,
					SCA.first_name,
					SCA.last_name,
					SCA.contact_number,
					SCA.zip,
					date_format(SCA.applied_date,'%m/%d/%y %h:%m %p') as 'applied_date',					
					SCA.uploaded_file,
					ifnull(SCAL.is_like,'-') as is_like,
					ifnull(SCAL.a_like_id,'-') as a_like_id,
					ifnull(SCAV.a_view_id,'-') as a_view_id,
					ifnull(s.store_name,'N/A') as store_name
					from sun_career_applicant SCA
					left join sun_career_applicant_likes SCAL on SCA.applicant_id = SCAL.applicant_id and SCAL.uid = '$uid'
					left join sun_career_applicant_viewed SCAV on SCA.applicant_id = SCAV.applicant_id and SCAV.uid = '$uid'
					left join sun_stores s on SCA.close_by_store_id = s.store_id
					where 
                    SCAL.uid='$uid' and
					SCAL.is_like=1";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getMyLikesDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getMyLikesDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
}

function getProcessStepsDetails()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select step from sun_career_process_steps where active=1";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getMyLikesDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getMyLikesDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}	
}

function getProcessStepsThumbsDetails()
{	
	try
	{
		$applicant_id = $_GET['applicant_id'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select count(scs.applicant_id) as c1,
					count(scs1.applicant_id) as c2,
					count(scs2.applicant_id) as c3,
					count(scs3.applicant_id) as c4,
					count(scs4.applicant_id) as c5
					from
					sun_career_applicant SCA 
					left join sun_career_step_jobfitsurvey scs on scs.applicant_id = $applicant_id
					left join sun_career_step_interviewed scs1 on scs1.applicant_id = $applicant_id
					left join sun_career_step_interviewnotes scs2 on scs2.applicant_id = $applicant_id
					left join sun_career_step_video scs3 on scs3.applicant_id = $applicant_id
					left join sun_career_step_nextstep scs4 on scs4.applicant_id = $applicant_id
					where 
					SCA.applicant_id=$applicant_id";
							
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getProcessStepsThumbsDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getProcessStepsThumbsDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
}

function getStepsSettingsDetails()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select * from sun_career_process_steps";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] =array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getStepsSettingsDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getStepsSettingsDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}	
}

function getCarerAccessRidDetails()
{
	try
	{
		$rid = $_SESSION['rid'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"SELECT B.*,A.rid FROM sun_career_access_by_rid A
					LEFT JOIN (
					SELECT * from sun_career_action_button where active = 1 and action_button_locations = 'applicationdataupdate'
					) B On A.a_button_id = B.a_button_id
					where A.rid = $rid and A.active = 1 ORDER BY B.action_button_weight";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getCarerAccessRidDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getCarerAccessRidDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}	
}

function getAccessRoleSettingsDetails()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select scabr.*,u.name as added_name,r.name as role_name from sun_career_access_by_rid scabr,users u,role r
					where u.uid=scabr.added_by_uid and r.rid=scabr.rid order by r.name";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getAccessRoleSettingsDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getAccessRoleSettingsDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}	
}

function getRoleDetails()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select * from role";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getRoleDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getRoleDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}	
}

function getSettingNameDetails()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select *from sun_career_action_button where active=1";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);				
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getSettingNameDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getSettingNameDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}	
}

function getDMUID()
{
	try
	{
		$falg=0;
		$sid=$_GET["sid"];
		if($sid!='0000')
		{
			$database = new Database();
			$conn = $database->getConnection(); 
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$qry =	"select * from sun_career_approval_steps_approval where approval_step_id = 1";		
			$st = $conn->prepare( $qry );	
			$st->execute();
			$data = array();
			$row = $st->fetchAll();
			//print_r($row);
			for($i=0;$i<sizeof($row);$i++)
			{
				$table_name = $row[$i]['lookup_table'];
				$field_name = $row[$i]['lookup_field'];
				$qry1 =	"select U.`name`,U.mail,U.uid from $table_name D
							LEFT JOIN sun_stores S ON S.store_district_id = D.$field_name
							LEFT JOIN users U ON D.$field_name = U.uid
							where S.store_id = $sid";
				$st1 = $conn->prepare( $qry1 );	
				$st1->execute();
				$data1 = $st1->fetchAll();
				if(sizeof($data1) > 0)
				{
					$flag=1;
					foreach ($data1 as $rows) {
						$data[] = array("name"=> $rows['name'],
										"mail"=> $rows['mail'], 
										"uid"=>$rows['uid'],
										"email_flag"=>$row[$i]['send_mail'],
										"subject"=>$row[$i]['mail_subject'],
										"body"=>$row[$i]['mail_body']);
					}
/* 					$email = $row[$i]['send_mail'];
					$subject = $row[$i]['mail_subject'];
					$body = $row[$i]['mail_body'];					
					$data["email_flag"] = $email;
					$data["subject"] = $subject;
					$data["body"] = $body; */	
				}					
			}

			if($flag==0)
			{
				$data = Global_Admin::get_global_admin();
				echo $data;
			} 
	/* 		foreach ($row as $key => $value) {
				$data[$key] = array_map('utf8_encode', $value);				
			}*/	
			else
			{
				$conn = null;	
				ob_start("ob_gzhandler");
				//echo(json_encode($data));
				$retresult['success'] = true;
				$retresult['details'] = $data;
				echo(json_encode($retresult));
			}			
		}
		else
		{
			$data = Global_Admin::get_global_admin();
			echo $data;
		}
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getDMUID, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getDMUID, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}	
}

function getApprovalStepsDetails()
{
	try
	{
		$rid=$_GET["rid"];
		$applicant_id=$_GET["applicant_id"];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"(select 'Active' as status_flag,'' as name,'' as decision,S.approval_step_id,S.step_name,S.title,S.tooltip,B.canapprove from sun_career_approval_steps_reqfor R
					LEFT JOIN sun_career_approval_steps S On R.approval_step_id = S.approval_step_id
					LEFT JOIN sun_career_applicant A ON A.position_job_id = R.rid
					LEFT JOIN (
					SELECT approval_step_id,'yes' as canapprove from sun_career_approval_steps_approval where rid = $rid
					) B ON B.approval_step_id = R.approval_step_id					
					where 
					R.approval_step_id not in(select approval_step_id from sun_career_approval_steps_status where applicant_id=$applicant_id) and 
					A.applicant_id = $applicant_id ORDER BY step_weight)
					union 
					(select 'Inactive' as status_flag,u.name as name,'' as decision,S.approval_step_id,S.step_name,S.title,S.tooltip,B.canapprove from sun_career_approval_steps_reqfor R
					LEFT JOIN sun_career_approval_steps S On R.approval_step_id = S.approval_step_id
					LEFT JOIN sun_career_applicant A ON A.position_job_id = R.rid
					LEFT JOIN (
					SELECT approval_step_id,'yes' as canapprove from sun_career_approval_steps_approval where rid = $rid
					) B ON B.approval_step_id = R.approval_step_id
					inner join users u on u.uid=(select uid from sun_career_approval_steps_status where approval_step_id=S.approval_step_id and applicant_id=$applicant_id)
					where 
					S.approval_step_id in(select approval_step_id from sun_career_approval_steps_status where applicant_id=$applicant_id) and 
					A.applicant_id = $applicant_id ORDER BY step_weight)";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getApprovalStepsDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getApprovalStepsDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}	
}

function sendEmail()
{
	try
	{
			$database = new Database();
			$conn = $database->getConnection(); 
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$to = $_GET["to"];
			$subject = $_GET["subject"];
			$body = $_GET["body"];
			$applicant_id = $_GET["applicant_id"];
			$result = Send_Mail::Sun_Send_Mail($to,$body,$subject);
			if($result ==0)
			{
			$qry =	"insert into prime_carrier_maillog(idmaillog,applicant_id,header_from,header_to,subject,body,sent_date)
					values(null,$applicant_id,'portal@mysuncomportal.com','$to','$subject','$body',now())";		
			$st = $conn->prepare( $qry );	
			$st->execute();				
			}
			echo $result;
			//Global_Admin::get_global_admin();
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getDMUID, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getDMUID, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}	
}

function getHiringStepsDetails()
{
	try
	{
		$applicant_id = $_GET["applicant_id"];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"(SELECT *,'' as name,'' as time,'active' as flag from sun_career_hiring_steps schs
					where 
					schs.hiring_step_id not in (select hiring_step_id from sun_career_hiring_steps_status where applicant_id=$applicant_id) and
					schs.active = 1 ORDER BY schs.step_weight)
					union
					(SELECT schs.*,u.name as name,date_format(from_unixtime(schss.timestamp ),'%m/%d/%y %h:%m %p') as time,'inactive' as flag from sun_career_hiring_steps schs,
					sun_career_hiring_steps_status schss,users u
					where 
					schss.applicant_id=$applicant_id and
					schs.hiring_step_id in (schss.hiring_step_id) and
					u.uid=schss.uid and
					schs.active = 1 ORDER BY schs.step_weight)";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);				
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		$retresult['success'] = true;
		$retresult['details'] = $data;
		echo(json_encode($retresult));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getHiringStepsDetails, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getHiringStepsDetails, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}	
}



?>