<?php

//session_start();

// require configuration file
//require 'config/database.php';
include_once '../config/database.php';
if(session_id() == '') {session_start();}
$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : "";
$action(); 
function getStoreForDropdown()
{	
	try
	{
		$store_id = $_REQUEST['store_id'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"SELECT *from sun_stores where store_id=$store_id";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		echo(json_encode($data));
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

function getDistrictDetailsForDropDown()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select
				sd.district_id as id,
				sd.district_name as name,
				sm.market_name as market_name,
				sm.market_id as market_id
				from 
				sun_district sd,
				sun_market sm
				where 
				sd.market_id = sm.market_id
				and sd.active='1'";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getDistrictDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getOpeningChecklistView()
{	
	try
	{
		$record_id = $_REQUEST['record_id'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select scoq.question, (CASE WHEN scoq.type = 'textfield' THEN socrd.answer
				ELSE 
					CASE WHEN socrd.answer = 0 THEN 'NO'
					WHEN socrd.answer = 1 THEN 'YES'
					ELSE  'N/A'
					END
				END) as answer
				from sun_checklist_opening_q scoq,
				sun_opening_checklist_record_details socrd
				where scoq.active=1
				and socrd.record_id=$record_id
				and scoq.opening_id = socrd.question";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getOpeningChecklistView: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getClosingChecklistView()
{	
	try
	{
		$record_id = $_REQUEST['record_id'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select sccq.question,(CASE WHEN sccq.type = 'textfield' THEN sccrd.answer
				ELSE 
					CASE WHEN sccrd.answer = 0 THEN 'NO'
					WHEN sccrd.answer = 1 THEN 'YES'
					ELSE  'N/A'
					END
				END) as answer
				from sun_checklist_closing_q sccq,
				sun_closing_checklist_record_details sccrd
				where sccq.active=1
				and sccrd.record_id=$record_id
				and sccq.closing_id = sccrd.question";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getClosingChecklistView: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getStoreManagerForDropDown()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select u.name,u.uid 
		from users_roles ur, users u 
		where ur.rid='6' and 
		u.uid=ur.uid and 
		u.status=1 
		order by u.name";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = array_map('utf8_encode', $value);	
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getDistrictDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getSMDMForDropDown()
{
	try
	{
		$store_id = $_REQUEST['store_id'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select u.name as RSM,u.uid as RSM_ID,u1.name as DM,u1.uid as DM_ID
					from users u,
					users u1,
					field_data_field_store_id fs,
					sun_stores ss,
					users_roles ur,
					role r
					where u.uid=fs.entity_id
					and fs.field_store_id_value=$store_id
					and ss.store_id=$store_id
					and ur.uid=fs.entity_id
					and r.rid=ur.rid
					and r.rid=6
					and u.status=1
					and u1.uid=ss.store_district_id limit 0,1";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		echo(json_encode($data));
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


function getUniqueHandoffForm()
{
	try
	{
		$HANDOFF_ID = $_REQUEST['id'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
		$qry =	"select 
					distinct(ssmhh.hardcount_sheet_no),		
					DATE_FORMAT(ssmh.handoff_date,'%m/%d/%Y') AS handoff_date, 
					ss.store_name,
					u.name as handoff_new_mgr,
					u2.name as district_manager,
					u1.name as handoff_current_mgr,
					ssmh.cashcount_variance,
					ssmh.departing_mgr_comment,
					ssmh.new_mgr_comment,
					ssmh.store_fixtures_condition,
					ssmh.pos_station_condition,
					ssmh.current_mgr_signature_path,
					ssmh.new_mgr_signature_path,
					ssmh.dm_signature_path,
					DATE_FORMAT(ssmh.current_mgr_date,'%m/%d/%Y') AS current_mgr_date,
					DATE_FORMAT(ssmh.new_mgr_date,'%m/%d/%Y') AS new_mgr_date,					
					DATE_FORMAT(ssmh.dm_date,'%m/%d/%Y') AS dm_date,
					GROUP_CONCAT(ssmhh.hardcount_missing_ph_imei) as hardcount_missing_ph_imei,
					GROUP_CONCAT(ssmhh.hardcount_missing_ph_reason) as hardcount_missing_ph_reason
					from sun_store_manager_handoff ssmh, 
					users u,
					users u1,
					users u2,
					sun_stores ss,
					sun_store_manager_handoff_hardcount ssmhh
					where 
					ssmh.handoff_id=$HANDOFF_ID and
					u.uid =ssmh.handoff_new_mgr and
					u1.uid = ssmh.handoff_current_mgr and
					ss.store_id = '0'+ssmh.handoff_store and
					ss.store_district_id = u2.uid and
					ssmhh.handoff_id=$HANDOFF_ID";

		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;			
		}	
		
		
		 $qry =	"select group_concat(rma_imei) as rma_imei,group_concat(rma_reason) as rma_reason from sun_store_manager_handoff_rma where handoff_id=$HANDOFF_ID";

		$st = $conn->prepare( $qry );	
		$st->execute();
		$data1 = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data1[$key] = $value;			
		}	
		
		$qry =	"select group_concat(cloverdevice_imei) as cloverdevice_imei,group_concat(cloverdevice_reason) as cloverdevice_reason from sun_store_manager_handoff_cloverdevices where handoff_id=$HANDOFF_ID";

		$st = $conn->prepare( $qry );	
		$st->execute();
		$data2 = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data2[$key] = $value;			
		}
		
		$qry =	"select group_concat(cashcount_amt) as cashcount_amt,
		group_concat(cashcount_comments) as cashcount_comments 
		from sun_store_manager_handoff_cashcount 
		where handoff_id=$HANDOFF_ID";

		$st = $conn->prepare( $qry );	
		$st->execute();
		$data3 = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data3[$key] = $value;			
		}
		
		$qry =	"select group_concat(question) as question,
		group_concat(answer) as answer 
		from sun_store_manager_handoff_misc_items 
		where handoff_id=$HANDOFF_ID";

		$st = $conn->prepare( $qry );	
		$st->execute();
		$data4 = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data4[$key] = $value;			
		}

		$qry =	"select group_concat(equipment_name) as equipment_name,
		group_concat(equipment_qty) as equipment_qty,
		group_concat(case when equipment_condition=0 then 'Like New'
							when equipment_condition=1 then 'Good'
							when equipment_condition=2 then 'Damged'
							else 'Needs Replacement' end) as equipment_condition 
		from sun_store_manager_handoff_itequipment 
		where handoff_id=$HANDOFF_ID";

		$st = $conn->prepare( $qry );	
		$st->execute();
		$data5 = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data5[$key] = $value;			
		}	

		$qry =	"select group_concat(marketingmaterial_name) as marketingmaterial_name,
		group_concat(marketingmaterial_qty) as marketingmaterial_qty,
		group_concat(case when marketingmaterial_condition=0 then 'Like New'
							when marketingmaterial_condition=1 then 'Good'
							when marketingmaterial_condition=2 then 'Damged'
							else 'Needs Replacement' end) as marketingmaterial_condition 
		from sun_store_manager_handoff_marketingmaterial 
		where handoff_id=$HANDOFF_ID";

		$st = $conn->prepare( $qry );	
		$st->execute();
		$data6 = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data6[$key] = $value;			
		}
		
		$qry =	"select group_concat(storefixtures_name) as storefixtures_name,
		group_concat(storefixtures_qty) as storefixtures_qty,
		group_concat(case when storefixtures_condition=0 then 'Like New'
							when storefixtures_condition=1 then 'Good'
							when storefixtures_condition=2 then 'Damged'
							else 'Needs Replacement' end) as storefixtures_condition 		
		from sun_store_manager_handoff_storefixtures 
		where handoff_id=$HANDOFF_ID";

		$st = $conn->prepare( $qry );	
		$st->execute();
		$data7 = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data7[$key] = $value;			
		}
		
		$op=array_merge($data,$data1,$data2,$data3,$data4,$data5,$data6,$data7);
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		echo(json_encode($op));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getUniqueHandoffForm, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getUniqueHandoffForm, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}	
}

function getDMChecklistView()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select * from sun_dm_checklist_q where active='1'";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		echo(json_encode($data));
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

function getStoreDetialsView()
{
	try
	{
		$store_id = $_REQUEST['s_id'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"SELECT
            R.region_name,
            M.market_name,
            D.district_name,
            S.store_id,
			S.store_name,
			S.rq_store_name,
			S.store_email,
			S.store_address,
			S.store_city,
			S.store_state,
			S.store_zip,
			S.store_phone,
			S.store_uid
			from sun_stores S
            LEFT JOIN sun_district D ON S.store_district_id = D.district_id
            LEFT JOIN sun_market M On M.market_id = D.market_id
            LEFT JOIN sun_region R ON R.region_id = M.region_id
            WHERE S.store_active = 1 and store_id = $store_id
			ORDER BY
			R.region_name,
            M.market_name,
			D.district_name,
			S.store_name";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		echo(json_encode($data));
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

function getHandoffMaterialsList()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"SELECT * from sun_store_handoff_material where active=1";		
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		echo(json_encode($data));
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

function getStoreDistaneView()
{
	try
	{
		$lat = $_GET["lat"];
		$longg = $_GET["longg"];
		$distance = 3;
		$sid = $_GET["sid"];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"SELECT S.store_id,S.store_name,S.store_city,S.latitude,S.longitude,S.store_active, 
				((ACOS(SIN(latitude * PI() / 180) * SIN($lat * PI() / 180) + COS(latitude * PI() / 180) * COS($lat * PI() / 180) * COS((longitude - ($longg)) * PI() / 180)) * 180 / PI()) * 60 * 1.1515)                  
				AS distance
				FROM
				sun_stores S
				HAVING distance <=$distance  and S.store_active = '1' and S.store_id = '$sid' ORDER BY distance ASC LIMIT 0, 1";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;	
		ob_start("ob_gzhandler");
		//echo(json_encode($data));
		echo(json_encode($data));
	}
	catch (Exception $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getStoreDistaneView, Non PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}
	catch (PDOException $e) {
		$retresult['success'] = false;
		$retresult['errors']  = 'In getStoreDistaneView, PDO Exception - '.$e->getMessage();
		echo json_encode($retresult);
		$conn = null;
		return;
		
	}	
}

?>