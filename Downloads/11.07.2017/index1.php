<?php

// https://aws.amazon.com/getting-started/tutorials/send-an-email/

//session_start();

// require configuration file
//require 'config/database.php';
include_once 'config/core.php';
if(session_id() == '') {session_start();}
$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : "";
$action(); 

function getStores()
{		
		/* $database = new Database();
	    $conn = $database->getConnection(); */
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select store_id from cric_stores_master order by store_id";
		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$list = array();

    while ( $row = $st->fetch() ) {
        array_push($list,array($row['store_id']));
    }

    $conn = null;
		
    echo(json_encode($list));
}
function getUnapprovalcount()
{		
		$level = 0;
		$user_id=$_SESSION['user_id'];
		$user_name=$_SESSION['user_name'];
		foreach ($_SESSION['uar'] as $menurights) {
		//foreach (all_menu_rights as $menurights) {
			
			if ($menurights->menu_user_id == $_SESSION['user_id'] && $menurights->menu_id == '02')
			{
				//echo '....................................................................................................menurights is ' . $menurights->menu_user_id . ' - ' . $menurights->menu_id . ' - ' . $menurights->approval_level . "\n";
				$level = $menurights->approval_level;
			}	
		}
		/* $database = new Database();
	    $conn = $database->getConnection(); */
		
	if ($level>0)
	{
		$level=$level-1;
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$qry =	"select ( select count(*) from cric_regular_expense where createdby <> '$user_id' and approved_level = $level )  as regunappcount
		, ( select count(*) from cric_mileage_expense where createdby <> '$user_id' and approved_level = $level ) as mileunappcount ";
		$st = $conn->prepare( $qry );
	
	    $st->execute();
	
	//$list = array();

    //while ( $row = $st->fetch() ) {
       // array_push($list,array($row['count']));
    //}
	$row = $st->fetch();
    $conn = null;
		
    echo("1,".$row['mileunappcount'].",".$row['mileunappcount']);
	}
	else
	{
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$qry =	"select ( select count(*) from cric_regular_expense where createdby = '$user_id' and status <> 'Active' ) + 
		( select count(*) from cric_mileage_expense where createdby = '$user_id' and status <> 'Active' ) as appcount,
		( select count(*) from cric_regular_expense where createdby = '$user_id' and status = 'Active' ) + 
		( select count(*) from cric_mileage_expense where createdby = '$user_id' and status = 'Active' ) as notappcount  ";
		$st = $conn->prepare( $qry );
	
	    $st->execute();
	
	//$list = array();

    //while ( $row = $st->fetch() ) {
       // array_push($list,array($row['count']));
    //}
	$row = $st->fetch();
    $conn = null;
		
    echo("0,".$row['notappcount'].",".$row['appcount']);
		
	}
}

function getStoreDetails()
{		
		/* $database = new Database();
	    $conn = $database->getConnection(); */
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select ifnull(store_id_number,'') as store_id_number, 
					ifnull(store_id,'') as store_id, 
					ifnull(market_id,'') as market_id, 
					ifnull(dm_name,'') as dm_name, 
					ifnull(store_address,'') as store_address, 
					ifnull(store_phone,'') as store_phone, 
					ifnull(store_manager,'') as store_manager, 
					ifnull(alarm_permit_pdf_link,'') as alarm_permit_pdf_link  
					from cric_stores_master order by store_id";
		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$list = array();

    while ( $row = $st->fetch() ) {
        //array_push($list,array($row['store_id']));
		//$store_type = $row['store_type']; 
		$store_id_number = $row['store_id_number']; 
		$store_id = $row['store_id']; 
		$market_id = $row['market_id']; 
		$dm_name = $row['dm_name']; 
		$store_address = $row['store_address']; 
		$store_phone = $row['store_phone']; 
		$store_manager = $row['store_manager']; 
		$alarm_permit_pdf_link = $row['alarm_permit_pdf_link']; 
		
		$list[] = array('store_id_number'=> $store_id_number, 
					'store_id'=> $store_id,
					'market_id'=> $market_id,'dm_name'=> $dm_name,
					'store_address'=> $store_address,
					'store_phone'=> $store_phone,
					'store_manager'=> $store_manager,
					'alarm_permit_pdf_link'=> $alarm_permit_pdf_link);
		
    }
	
	
    $conn = null;
		
    echo(json_encode($list));
}

function getAlarmDetails()
{		
		/* $database = new Database();
	    $conn = $database->getConnection(); */
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$qry =	"SELECT store_id_number,store_manager,dm_name,store_address,store_phone,alarm_permit_pdf_link FROM cric_stores_master";
		$qry =	"SELECT
store_id_number,
ifnull(store_manager,'') as store_manager,
ifnull(store_manager_phone,'') as store_manager_phone,
ifnull(dm_name,'') as dm_name,
concat(store_address, '</br>', store_state, '-', store_zip) as store_address,
replace(substring(store_phone,2),')','-') as store_phone,
ifnull(alarm_company_name,'') as alarm_company_name,
1st_Person,
1st_Person_Contact_No,
2nd_Person,
2nd_Person_Contact_No,
3rd_Person,
3rd_Person_Contact_No,
alarm_code,
alarm_password,
alarm_permit_pdf_link
FROM cric_stores_master";
		$st = $conn->prepare( $qry );
	
	$st->execute();
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;
		
    echo(json_encode($data));
}

function getAlarmContacts()
{		
		/* $database = new Database();
	    $conn = $database->getConnection(); */
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		/* $qry =	"SELECT
concat('Level 1 - ', 1st_Person, ' - ' , 1st_Person_Contact_No,
'<br/>','Level 2 - ', 2nd_Person, ' - ' , 2nd_Person_Contact_No,
'<br/>','Level 3 - ', 3rd_Person, ' - ' , 3rd_Person_Contact_No) as alarm_contacts
FROM cric_stores_master where ifnull(1st_Person,'') != '' limit 1"; */
		$qry =	"SELECT
concat('Level 1 - ', 1st_Person, ' - ' , 1st_Person_Contact_No,
' - Level 2 - ', 2nd_Person, ' - ' , 2nd_Person_Contact_No,
' - Level 3 - ', 3rd_Person, ' - ' , 3rd_Person_Contact_No) as alarm_contacts
FROM cric_stores_master where ifnull(1st_Person,'') != '' limit 1";
		$st = $conn->prepare( $qry );
	
	$st->execute();
	$data = array();
	$row = $st->fetch(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;
		
    echo(json_encode($data));
	
}

function getNewStores()
{		
		/* $database = new Database();
	    $conn = $database->getConnection(); */
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select ifnull(location,'') as location, 
					ifnull(store_id,'') as store_id, 
					ifnull(DATE_FORMAT(store_open_date,'%m/%d/%Y'),'') as store_open_date, 
					ifnull(market_id,'') as market_id, 
					ifnull(store_image_link,'') as store_image_link  
					from cric_stores_master 
					where upper(ifnull(new_store_flag,'')) = 'Y'
					order by store_id";
		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$list = array();

    while ( $row = $st->fetch() ) {
        //array_push($list,array($row['store_id']));
		//$store_type = $row['store_type']; 
		$location = $row['location']; 
		$store_id = $row['store_id']; 
		$store_open_date = $row['store_open_date']; 
		$market_id = $row['market_id']; 
		$store_image_link = $row['store_image_link']; 
		
		
		$list[] = array('location'=> $location, 
					'store_id'=> $store_id,
					'store_open_date'=> $store_open_date,
					'market_id'=> $market_id,
					'store_image_link'=> $store_image_link
					);
		
    }
	
	
    $conn = null;
		
    echo(json_encode($list));
}

// 17-May-2017
// =PROPER(TRIM(CONCAT(MID(A2,FIND(",",A2)+1,100)," ", MID(A2,1,FIND(",",A2)-1))))
function getDirectoryFieldLeadershipDetails()
{		
		/* $database = new Database();
	    $conn = $database->getConnection(); */
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"SELECT id, ifnull(staff_name,'') as staff_name,
                              -- ifnull(employee_name,'not available') as employee_name,
                              ifnull(staff_title,'') as staff_title,
                              ifnull(staff_email,'') as staff_email,
                              staff_phone,
                              ifnull(image_url,'') as image_url,
                              case substring(staff_title,1,2)
                              when 'DM'
                                             then ifnull((select group_concat(store_id_number, '-', location)
                                             from cric_stores_master
                                             where login_user_id = dm_id
                                             group by dm_id),'')
                              
                              when 'Cl'
                                             then ifnull((select group_concat(store_id_number, '-', location)
                                             from cric_stores_master
                                             where login_user_id = dm_id
                                             group by dm_id),'')
                              when 'RD'
                                             then ifnull((select group_concat(store_id_number, '-', location)
                                             from cric_stores_master
                                             where login_user_id = rd_id
                                             group by rd_id),'')
                              when 'VP'
                                             then ifnull((select group_concat(distinct dm_name)
                                             from cric_stores_master
                                             where login_user_id = region_vp_id
                                             group by region_vp_id),'')
                              else
                                             ''
                              end
                  as team
                              FROM cric_field_leadership
                              -- left join cric_employee_master
               -- on staff_name = employee_name
			   order by staff_name";
		$st = $conn->prepare( $qry );
	
	$st->execute();
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;
	
	echo(json_encode($data));
	
}

// 17-May-2017
function getHomeOfficeDetails()
{
	/* $database = new Database();
	$conn = $database->getConnection(); */
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$qry =	"SELECT ifnull(staff_name,'') as staff_name,
		ifnull(staff_title,'') as staff_title,
		ifnull(staff_email,'') as staff_email,
		ifnull(staff_phone,'') as staff_phone,
		ifnull(image_url,'') as image_url FROM cric_home_office
		order by staff_name";
	$st = $conn->prepare( $qry );
	
	$st->execute();
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;
	
	
	echo(json_encode($data));	
}

// 17-May-2017
function getStoreDetailsStoreCreation()
{
	/* $database = new Database();
	$conn = $database->getConnection(); */
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$qry =	"SELECT ifnull(region_id,'') as region_id, 
				ifnull(region_vp_id, '') as region_vp_id,
				ifnull(market_id, '') as market_id,
				ifnull(dm_id, '') as dm_id,
				ifnull(dm_name, '') as dm_name,
				ifnull(rd_id, '') as rd_id,
				ifnull(store_manager, '') as store_manager,
				ifnull(location,  '') as location,
				ifnull(store_id,  '') as store_id,
				ifnull(store_address, '') as store_address,
				ifnull(store_city,  '') as store_city,
				ifnull(store_state, '') as store_state,
				ifnull(store_zip,  '') as store_zip,
				ifnull(store_phone,  '') as store_phone,
				ifnull(store_uid,  '') as store_uid,
				ifnull(store_id_number, '') as store_id_number,
				ifnull(store_email,  '') as store_email,
				ifnull(store_tier,  '') as store_tier,
				ifnull(weekday_store_open_time, '') as weekday_store_open_time,
				ifnull(weekday_store_close_time, '') as weekday_store_close_time,
				ifnull(sunday_store_open_time,  '') as sunday_store_open_time,
				ifnull(sunday_store_close_time, '') as sunday_store_close_time,
				ifnull(new_store_flag,  '') as new_store_flag,
				ifnull(store_open_date, '') as store_open_date,
				ifnull(alarm_company_name,  '') as alarm_company_name,
				ifnull(alarm_company_contact,  '') as alarm_company_contact,
				ifnull(alarm_company_phone, '') as alarm_company_phone,
				ifnull(1st_Person,  '') as Person1,
				ifnull(1st_Person_Contact_No,  '') as Person_Contact_No1,
				ifnull(2nd_Person,  '') as Person2,
				ifnull(2nd_Person_Contact_No,  '') as Person_Contact_No2,
				ifnull(3rd_Person,  '') as Person3,
				ifnull(3rd_Person_Contact_No, '') as Person_Contact_No3,
				ifnull(alarm_code, '') as alarm_code,
				ifnull(alarm_password, '') as alarm_password
				from cric_stores_master where location <> 'Back Office' order by store_id_number";
	$st = $conn->prepare( $qry );
	
	$st->execute();
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;
	
	
	echo(json_encode($data));		
}

function getDirectoryStoresDetails()
{
	/* $database = new Database();
	$conn = $database->getConnection(); */
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$qry =	"SELECT region_id, store_uid, store_id_number, 
				ifnull(location,'') as location,
				ifnull(store_phone,'') as store_phone,
				ifnull(store_id,'') as store_id,
               concat(ifnull(store_address,''), '<br>', ifnull(store_city,''), '<br>',
               ifnull(store_state,''), ' - ', ifnull(store_zip,'')) as store_address,
               ifnull(store_email,'') as store_email ,
               ifnull(store_image_link,'') as store_image_link,
               market_id,ifnull(fn_hierarchy_get_store_personnel(store_id_number),'') as personnel
			   FROM cric_stores_master 
			   where store_id <> 'Back Office' order by location";
	$st = $conn->prepare( $qry );
	
	$st->execute();
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;
	
	
	echo(json_encode($data));		
}


function getDirectoryStoresLocations()
{
	/* $database = new Database();
	$conn = $database->getConnection(); */
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$qry =	"select location,store_id_number from 
			(SELECT location,store_id_number FROM cric_stores_master where location = 'Back Office'
			union
			SELECT location,store_id_number FROM cric_stores_master where location <> 'Back Office') a
			ORDER BY location = 'Back Office' desc, location asc";
	$st = $conn->prepare( $qry );
	
	$st->execute();
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;
	
	
	echo(json_encode($data));		
}

function get50_OppsRR()
{	
	set_time_limit(0);
	$store_id = $_REQUEST['store_id'];
		/* $database = new Database();
	    $conn = $database->getConnection(); */
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$st =	$conn->prepare("select count(*) as count50 from 
				(
				select Invoiced_By, Tendered_By, ((sum(cnt)/16)*30) as cnt from
				(
				select Invoiced_By, Tendered_By, count(*) as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%Upgrade%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				union
				select Invoiced_By,Tendered_By, count(*)  as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%Unlimited%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				union
				select Invoiced_By, Tendered_By, count(*)  as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%Pro%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				union
				select Invoiced_By, Tendered_By, count(*)  as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%Smart%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				union
				select Invoiced_By, Tendered_By, count(*)  as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%Basic%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				union
				select Invoiced_By, Tendered_By, count(*)  as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%Talk & Text%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				union
				select Invoiced_By, Tendered_By, count(*)  as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%GB%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				) c
				 where Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				having cnt < 50
				) d");
		
		$st->bindValue( ":store_id", $store_id, PDO::PARAM_STR ); 
		//$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$list = array();

    while ( $row = $st->fetch() ) {
        array_push($list,array($row['count50']));
    }

    $conn = null;
	set_time_limit(30);	
    echo(json_encode($list));
}

function get50more_OppsRR()
{	
	set_time_limit(0);
	$store_id = $_REQUEST['store_id'];
		/* $database = new Database();
	    $conn = $database->getConnection(); */
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$st =	$conn->prepare("select count(*) as count50more from 
				(
				select Invoiced_By, Tendered_By, ((sum(cnt)/16)*30) as cnt from
				(
				select Invoiced_By, Tendered_By, count(*) as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%Upgrade%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				union
				select Invoiced_By,Tendered_By, count(*)  as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%Unlimited%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				union
				select Invoiced_By, Tendered_By, count(*)  as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%Pro%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				union
				select Invoiced_By, Tendered_By, count(*)  as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%Smart%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				union
				select Invoiced_By, Tendered_By, count(*)  as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%Basic%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				union
				select Invoiced_By, Tendered_By, count(*)  as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%Talk & Text%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				union
				select Invoiced_By, Tendered_By, count(*)  as cnt from prod_det_rep_mtd_csv
				where Product_Name like '%GB%'
				and Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				) c
				 where Invoiced_By = :store_id
				group by Invoiced_By, Tendered_By
				having cnt >= 50
				) d");
		
		$st->bindValue( ":store_id", $store_id, PDO::PARAM_STR ); 
		//$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$list = array();

    while ( $row = $st->fetch() ) {
        array_push($list,array($row['count50more']));
    }

    $conn = null;
	set_time_limit(30);	
    echo(json_encode($list));
}

/* DM Cortez Andrew - 1
RD Martinez Sunny - 2
VP Salem Isa - 3
Kathy - 4
Youlia - 5
Mark - 6 */

function getRegExpenseApproval()
{
		$level = 0;
		$user_name=$_SESSION['user_name'];
		$user_id=$_SESSION['user_id'];
		foreach ($_SESSION['uar'] as $menurights) {
			if ($menurights->menu_user_id == $_SESSION['user_id'] && $menurights->menu_id == '02')
			{
				//echo '....................................................................................................menurights is ' . $menurights->menu_user_id . ' - ' . $menurights->menu_id . ' - ' . $menurights->approval_level . "\n";
				$level = $menurights->approval_level;
			}	
		}
		$level_1 = $level - 1;
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if ($level > 0 && $level < 4)
		{
			
			$qry =	"select c.*  from 
				(select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type,
					'V' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, b.user_name as createdby_name
					from cric_regular_expense a, k18_user b
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id') and a.approved_level = $level
					and a.createdby = b.login_user_id
					union
					select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type,
					'V' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, b.user_name as createdby_name	
					from cric_regular_expense a, k18_user b
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id') and a.status = 'Rejected'
					and a.approved_level > 0 
					and a.createdby = b.login_user_id
					union
					select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type,
					'A' as edit_view_app_option, '' as internal_remarks1,
					fn_hierarchy_missed_approving_head('$user_id', 
						a.createdby) as missed_approving_head, 
						d.user_name as createdby_name
					from cric_regular_expense a, k18_menu_user_rights b, 
					k18_user d
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id')  and a.status <> 'Rejected'
					and approved_level = 0 
					and a.createdon > DATE_SUB(NOW(), INTERVAL 48 HOUR) 
					and a.status ='Active'
					and a.createdby = b.menu_user_id
					and b.menu_id = '02'
					and $level = b.approval_level + 1
					and a.reg_exp_category <> 'Marketing Promo Event'
					and a.createdby = d.login_user_id
					union
					select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type,
					'A' as edit_view_app_option, 
					'48 Hours' as internal_remarks1,
					fn_hierarchy_missed_approving_head('$user_id', 
						a.createdby) as missed_approving_head, 
						d.user_name as createdby_name	
					from cric_regular_expense a, k18_menu_user_rights b, 
					k18_user d
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id')  and a.status <> 'Rejected'
					and approved_level = 0 
					and a.createdon < DATE_SUB(NOW(), INTERVAL 48 HOUR) 
					and a.status ='Active'
					and a.createdby = b.menu_user_id
					and b.menu_id = '02'
					and $level = b.approval_level + 2
					and a.reg_exp_category <> 'Marketing Promo Event'
					and a.createdby = d.login_user_id
					union
					select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type,
					'V' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, b.user_name as createdby_name
					from cric_regular_expense a, k18_user b
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id') 
					and a.status <> 'Rejected'
					and a.approved_level = 1
					and a.approved_level >= $level
					and a.createdby = b.login_user_id
					union
					select 
					a.*, 'Y' as approve_rights, '$user_name' as user_name, 
					$level as user_level, 'REGEXP' as exp_type,
					'V' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, d.user_name as createdby_name	
					from cric_regular_expense a, cric_reg_expense_approve b, 
					k18_user d
					where b.approvelevel = $level
					and a.reg_exp_seq_no = b.reg_exp_seq_no
					and a.status <> 'Rejected'
					and a.approved_level >= $level
					and a.createdby = d.login_user_id
					) c
					order by c.edit_view_app_option asc, c.reg_exp_seq_no desc"; 
			
			}
			else if ($level == 4)
			{
				$qry =	"select c.* from 
					(select a.*, 'Y' as approve_rights, '$user_name' as user_name, 
					$level as user_level, 'REGEXP' as exp_type,
					'V' as edit_view_app_option,  '' as internal_remarks1,
					'' as missed_approving_head, d.user_name as createdby_name
					from cric_regular_expense a, cric_reg_expense_approve b, 
					k18_user d
					where b.approvelevel = $level
					and a.reg_exp_seq_no = b.reg_exp_seq_no
					and a.status in ('Rejected','Approved', 'Partially Approved')
					and a.approved_level >= $level
					and a.reg_exp_category = 'Marketing Promo Event'
					and a.createdby = d.login_user_id
				union
				select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type,
					'A' as edit_view_app_option,  '' as internal_remarks1,
					fn_hierarchy_missed_approving_head('$user_id', 
						a.createdby) as missed_approving_head, 
						b.user_name as createdby_name
					from cric_regular_expense a, k18_user b
					where a.status = 'Active'
					and a.createdon > DATE_SUB(NOW(), INTERVAL 48 HOUR)
					and a.reg_exp_category = 'Marketing Promo Event'
				   and $level > (select approval_level from k18_menu_user_rights
				   where menu_user_id = a.createdby and menu_id = '02' )
				   and a.createdby = b.login_user_id
				
					) c
					order by c.edit_view_app_option asc, c.reg_exp_seq_no desc"; 
			}
			else if ($level == 5)
			{
				$qry =	"select c.* from 
					(select a.*, 'Y' as approve_rights, '$user_name' as user_name, 
					$level as user_level, 'REGEXP' as exp_type,
					'V' as edit_view_app_option,  '' as internal_remarks1,
					'' as missed_approving_head, d.user_name as createdby_name
					from cric_regular_expense a, cric_reg_expense_approve b,
					k18_user d
					where b.approvelevel = $level
					and a.reg_exp_seq_no = b.reg_exp_seq_no
					and a.status <> 'Rejected'
					and a.approved_level >= $level
					and a.createdby = d.login_user_id
				union
				select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type,
					'A' as edit_view_app_option,  '' as internal_remarks1,
					fn_hierarchy_missed_approving_head('$user_id', 
						a.createdby) as missed_approving_head, 
						b.user_name as createdby_name
					from cric_regular_expense a, k18_user b
					where a.status = 'Active'
					and a.reg_exp_category <> 'Marketing Promo Event'
				   and $level - 2 = (select approval_level from k18_menu_user_rights
				   where menu_user_id = a.createdby and menu_id = '02' )
				   and a.createdby = b.login_user_id
				union 
				select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type,
					'A' as edit_view_app_option, '' as internal_remarks1,
					fn_hierarchy_missed_approving_head('$user_id', 
						a.createdby) as missed_approving_head, b.user_name as createdby_name
					from cric_regular_expense a, k18_user b
					 where ( a.status = 'Approved' or a.status = 'Partially Approved')
					 and a.approved_level > 0
                     and a.approved_level <= 4
					 and a.createdby = b.login_user_id
				union 
					select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type,
					'A' as edit_view_app_option,  
					'48 Hours' as internal_remarks1,
					fn_hierarchy_missed_approving_head('$user_id', 
						a.createdby) as missed_approving_head, 
						d.user_name as createdby_name					
					from cric_regular_expense a, k18_menu_user_rights b, k18_user d
					where a.approved_level = 0
					and a.createdon < DATE_SUB(NOW(), INTERVAL 48 HOUR) 
					and a.status ='Active'
					and a.createdby = b.menu_user_id
					and b.menu_id = '02'
					-- and $level = b.approval_level + 2
					and (b.approval_level = 0 or
						b.approval_level = 1 or
						b.approval_level = 2 )
					and a.createdby = d.login_user_id
					) c
					order by c.edit_view_app_option asc, c.reg_exp_seq_no desc"; 
			}
			else if ($level > 5)
			{
				$qry =	"select c.* from 
					(select a.*, 'Y' as approve_rights, '$user_name' as user_name, 
					$level as user_level, 'REGEXP' as exp_type,
					'V' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, 
					d.user_name as createdby_name
					from cric_regular_expense a, cric_reg_expense_approve b, 
					k18_user d
					where b.approvelevel = $level
					and a.reg_exp_seq_no = b.reg_exp_seq_no
					and a.status <> 'Rejected'
					and a.approved_level >= $level
					and a.createdby = d.login_user_id
				union
				select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type,
					'A' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, 
					b.user_name as createdby_name	
					from cric_regular_expense a, k18_user b 
					where a.status = 'Active'
				   and $level - 1 = 
				   (select approval_level from k18_menu_user_rights
				   where menu_user_id = a.createdby 
				   and menu_id = '09' )
				   and a.createdby = b.login_user_id
				union 
				select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type,
					'A' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, 
					b.user_name as createdby_name
					from cric_regular_expense a, k18_user b 
					where ( a.status = 'Approved' or a.status = 'Partially Approved')
                     and a.approved_level = $level - 1
					 and a.createdby = b.login_user_id
					) c
					order by c.edit_view_app_option asc, c.reg_exp_seq_no desc"; 
			}

		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;

	echo(json_encode($data));
}

function getRegExpense()
//function getRegExpenseApproval()
{
		$level = 0;
		$user_id=$_SESSION['user_id'];
		$user_name=$_SESSION['user_name'];
		foreach ($_SESSION['uar'] as $menurights) {
			if ($menurights->menu_user_id == $_SESSION['user_id'] && $menurights->menu_id == '02')
			{
				//echo '....................................................................................................menurights is ' . $menurights->menu_user_id . ' - ' . $menurights->menu_id . ' - ' . $menurights->approval_level . "\n";
				$level = $menurights->approval_level;
			}	
		}
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select c.* from 
			(select a.*, 'N' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type ,
					'E' as edit_view_app_option, 
					b.user_name as createdby_name  
					from cric_regular_expense a, 
					k18_user b
					where a.createdby = '$user_id' and a.approved_level = 0
					and a.createdby = b.login_user_id
					union
					select a.*, 'N' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type ,
					'V' as edit_view_app_option,
					b.user_name as createdby_name   
					from cric_regular_expense a, k18_user b 
					where a.createdby = '$user_id' and a.approved_level > 0
					and a.createdby = b.login_user_id) c
					order by c.edit_view_app_option asc, c.reg_exp_seq_no desc"; 
			
		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;

	echo(json_encode($data));
}

function getMileageExpense()
{
		$level = 0;
		$user_id=$_SESSION['user_id'];
		$user_name=$_SESSION['user_name'];
		foreach ($_SESSION['uar'] as $menurights) {
			if ($menurights->menu_user_id == $_SESSION['user_id'] && $menurights->menu_id == '02')
			{
				//echo '....................................................................................................menurights is ' . $menurights->menu_user_id . ' - ' . $menurights->menu_id . ' - ' . $menurights->approval_level . "\n";
				$level = $menurights->approval_level;
			}	
		}
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select c.* from 
			(select a.*, 'N' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type ,
					'E' as edit_view_app_option, 
					b.user_name as createdby_name 
					from cric_mileage_expense a, k18_user b 
					where a.createdby = '$user_id' and a.approved_level = 0
					and a.createdby = b.login_user_id
					union
					select a.*, 'N' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'REGEXP' as exp_type ,
					'V' as edit_view_app_option, b.user_name as createdby_name 
					from cric_mileage_expense a,
					k18_user b
					where a.createdby = '$user_id' and a.approved_level > 0
					and a.createdby = b.login_user_id
					) c
					order by c.edit_view_app_option asc, c.mileage_exp_seq_no desc";
			
		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;

	echo(json_encode($data));
}

function getExpDetails()
{
		$level = 0;
		$user_id=$_SESSION['user_id'];
		$user_name=$_SESSION['user_name'];
		foreach ($_SESSION['uar'] as $menurights) {
			
			if ($menurights->menu_user_id == $_SESSION['user_id'] && $menurights->menu_id == '02')
			{
				//echo '....................................................................................................menurights is ' . $menurights->menu_user_id . ' - ' . $menurights->menu_id . ' - ' . $menurights->approval_level . "\n";
				$level = $menurights->approval_level;
			}	
		}
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if ($level == 0)
		{
			$qry =	"select 'REGEXP' as exp_type, a.createdby,
					a.reg_exp_date, a.createdon, a.reg_exp_merchant,
					a.reg_exp_description, a.reg_exp_category, a.reg_exp_amount,
					a.status, a.approvedby, a.approvedon, a.invoice_image_url,
					'E' as edit_view_app_option, b.user_name as createdby_name 
					from cric_regular_expense a, k18_user b
					where a.createdby = '$user_id' and a.approved_level = 0 
					and a.createdby = b.login_user_id
					union
					select 'REGEXP' as exp_type, a.createdby,
					a.reg_exp_date, a.createdon, a.reg_exp_merchant,
					a.reg_exp_description, a.reg_exp_category, a.reg_exp_amount,
					a.status, a.approvedby, a.approvedon, a.invoice_image_url,
					'V' as edit_view_app_option, b.user_name as createdby_name
					from cric_regular_expense a, k18_user b
					where a.createdby = '$user_id' and a.approved_level > 0
					and a.createdby = b.login_user_id
					";
		}
		else if ($level > 0)
		{
			$level_1 = $level - 1;
			$qry =	"select 'REGEXP' as exp_type, createdby,
					reg_exp_date, createdon, reg_exp_merchant,
					reg_exp_description, reg_exp_category, reg_exp_amount,
					status, approvedby, approvedon, invoice_image_url,
					'E' as edit_view_app_option
					from cric_regular_expense 
					where createdby = '$user_id' 
					union
					select 'REGEXP' as exp_type, createdby,
					reg_exp_date, createdon, reg_exp_merchant,
					reg_exp_description, reg_exp_category, reg_exp_amount,
					status, approvedby, approvedon, invoice_image_url,
					'V' as edit_view_app_option
					from cric_regular_expense 
					where createdby in 
		(select employee_id from cric_employee_hierarchy
		where approving_head_id = '$user_id') and approved_level = $level
					union
					select 'REGEXP' as exp_type, createdby,
					reg_exp_date, createdon, reg_exp_merchant,
					reg_exp_description, reg_exp_category, reg_exp_amount,
					status, approvedby, approvedon, invoice_image_url,
					'V' as edit_view_app_option 
					from cric_regular_expense 
					where createdby in 
		(select employee_id from cric_employee_hierarchy
		where approving_head_id = '$user_id')  and status = 'Rejected'
					and approved_level > 0 and approved_level <= $level_1
					union
					select 'REGEXP' as exp_type, createdby,
					reg_exp_date, createdon, reg_exp_merchant,
					reg_exp_description, reg_exp_category, reg_exp_amount,
					status, approvedby, approvedon, invoice_image_url,
					'A' as edit_view_app_option 
					from cric_regular_expense 
					where createdby in 
		(select employee_id from cric_employee_hierarchy
		where approving_head_id = '$user_id')  and status <> 'Rejected'
					and approved_level >= 0 and approved_level = $level_1
			";
		}
		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;

	echo(json_encode($data));
}

/* function getExpenselookup()
{
		$database = new Database();
	    $conn = $database->getConnection();
		$qry =	"select * from k18_lookup where codeid in 
		('Expense Account','Category')";
		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;

	echo(json_encode($data));
}
 */
function getExpenselookup()
{
		/*$database = new Database();
	    $conn = $database->getConnection(); */
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select * from k18_lookup where codeid = 'Category' 
				order by sortorder";
		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	} 
	
	
    $conn = null;

	echo(json_encode($data));
}

function getMileageExpenseApproval()
{
		$level = 0;
		$user_id=$_SESSION['user_id'];
		$user_name=$_SESSION['user_name'];
		foreach ($_SESSION['uar'] as $menurights) {
			if ($menurights->menu_user_id == $_SESSION['user_id'] && $menurights->menu_id == '02')
			{
				//echo '....................................................................................................menurights is ' . $menurights->menu_user_id . ' - ' . $menurights->menu_id . ' - ' . $menurights->approval_level . "\n";
				$level = $menurights->approval_level;
			}	
		}
		$level_1 = $level - 1;
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if ($level > 0 && $level < 5)
		{
			
			$qry =	"select d.*  from 
				(select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'MILEXP' as exp_type,
					'V' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, b.user_name as createdby_name
					from cric_mileage_expense a, k18_user b
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id') and a.approved_level = $level
					and a.createdby = b.login_user_id
					union
					select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'MILEXP' as exp_type,
					'V' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, b.user_name as createdby_name					
					from cric_mileage_expense a, k18_user b
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id') and a.status = 'Rejected'
					and a.approved_level > 0 
					and a.createdby = b.login_user_id
					union
					select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'MILEXP' as exp_type,
					'A' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, c.user_name as createdby_name
					from cric_mileage_expense a, k18_menu_user_rights b, 
					k18_user c
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id')  and a.status <> 'Rejected'
					and approved_level = 0 
					and a.createdon > DATE_SUB(NOW(), INTERVAL 48 HOUR) 
					and a.status ='Active'
					and a.createdby = b.menu_user_id
					and b.menu_id = '02'
					and $level = b.approval_level + 1
					and a.createdby = c.login_user_id
					union
					select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'MILEXP' as exp_type,
					'A' as edit_view_app_option, 
					'48 Hours' as internal_remarks1,
					fn_hierarchy_missed_approving_head('$user_id', 
						a.createdby) as missed_approving_head,
						c.user_name as createdby_name
					from cric_mileage_expense a, k18_menu_user_rights b,
					k18_user c
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id')  and a.status <> 'Rejected'
					and approved_level = 0 
					and a.createdon < DATE_SUB(NOW(), INTERVAL 48 HOUR) 
					and a.status ='Active'
					and a.createdby = b.menu_user_id
					and b.menu_id = '02'
					and $level = b.approval_level + 2
					and a.createdby = c.login_user_id
					union
					select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'MILEXP' as exp_type,
					'V' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, b.user_name as createdby_name
					from cric_mileage_expense a, k18_user b
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id') 
					and a.status <> 'Rejected'
					and a.approved_level = 1
					and a.approved_level >= $level
					and a.createdby = b.login_user_id
					union
					select 
					a.*, 'Y' as approve_rights, '$user_name' as user_name, 
					$level as user_level, 'MILEXP' as exp_type,
					'V' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, 
					c.user_name as createdby_name
					from cric_mileage_expense a, 
					cric_mileage_expense_approve b,
					k18_user c
					where b.approvelevel = $level
					and a.mileage_exp_seq_no = b.mileage_exp_seq_no
					and a.status <> 'Rejected'
					and a.approved_level >= $level
					and a.createdby = c.login_user_id
					) d
					order by d.edit_view_app_option asc, d.mileage_exp_seq_no desc"; 
			
			}
			else if ($level == 5)
			{
				$qry =	"select d.* from 
					(select a.*, 'Y' as approve_rights, '$user_name' as user_name, 
					$level as user_level, 'MILEXP' as exp_type,
					'V' as edit_view_app_option,  '' as internal_remarks1,
					'' as missed_approving_head, c.user_name as createdby_name
					from cric_mileage_expense a, 
					cric_mileage_expense_approve b,
					k18_user c
					where b.approvelevel = $level
					and a.mileage_exp_seq_no = b.mileage_exp_seq_no
					and a.status <> 'Rejected'
					and a.approved_level >= $level
					and a.createdby = c.login_user_id
				union
				select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'MILEXP' as exp_type,
					'A' as edit_view_app_option,  '' as internal_remarks1,
					'' as missed_approving_head, b.user_name as createdby_name
					from cric_mileage_expense a, k18_user b
					where a.status = 'Active'
					and a.createdby = b.login_user_id
				   and $level - 1 = (select approval_level from k18_menu_user_rights
				   where menu_user_id = a.createdby and menu_id = '02' )
				union 
				select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'MILEXP' as exp_type,
					'A' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, b.user_name as createdby_name
					from cric_mileage_expense a, k18_user b
					 where ( a.status = 'Approved' or a.status = 'Partially Approved')
					 and a.approved_level > 0
                     and a.approved_level <= 3
					 and a.createdby = b.login_user_id
				union 
					select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'MILEXP' as exp_type,
					'A' as edit_view_app_option,  
					'48 Hours' as internal_remarks1,
					fn_hierarchy_missed_approving_head('$user_id', 
						a.createdby) as missed_approving_head,
					 c.user_name as createdby_name
					from cric_mileage_expense a, k18_menu_user_rights b,
					 k18_user c
					where a.approved_level = 0
					and a.createdon < DATE_SUB(NOW(), INTERVAL 48 HOUR) 
					and a.status ='Active'
					and a.createdby = b.menu_user_id
					and b.menu_id = '02'
					and $level = b.approval_level + 2
					and a.createdby = c.login_user_id
					) d
					order by d.edit_view_app_option asc, d.mileage_exp_seq_no desc"; 
			}
			else if ($level > 5)
			{
				$qry =	"select d.* from 
					(select a.*, 'Y' as approve_rights, '$user_name' as user_name, 
					$level as user_level, 'MILEXP' as exp_type,
					'V' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, c.user_name as createdby_name
					from cric_mileage_expense a, 
					cric_mileage_expense_approve b, k18_user c
					where b.approvelevel = $level
					and a.mileage_exp_seq_no = b.mileage_exp_seq_no
					and a.status <> 'Rejected'
					and a.approved_level >= $level
					and a.createdby = c.login_user_id
				union
				select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'MILEXP' as exp_type,
					'A' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, c.user_name as createdby_name
					from cric_mileage_expense a, k18_user c 
					where a.status = 'Active'
					and a.createdby = c.login_user_id
				   and $level - 1 = (select approval_level from k18_menu_user_rights
				   where menu_user_id = a.createdby and menu_id = '09' )
				union 
				select a.*,  'Y' as approve_rights, '$user_name' as user_name, 
					'$level' as user_level, 'MILEXP' as exp_type,
					'A' as edit_view_app_option, '' as internal_remarks1,
					'' as missed_approving_head, c.user_name as createdby_name
					from cric_mileage_expense a, k18_user c 
					where ( 
					a.status = 'Approved' or a.status = 'Partially Approved')
                    and a.approved_level = $level - 1
					and a.createdby = c.login_user_id 
					) d
					order by d.edit_view_app_option asc, d.mileage_exp_seq_no desc"; 
			}
		
		
		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}	
    $conn = null;

	echo(json_encode($data));
}
function getToApproveCount()
{
               $level = 0;
               $qry = "";
               $user_id=$_SESSION['user_id'];
			   $user_name=$_SESSION['user_name'];
               foreach ($_SESSION['uar'] as $menurights) {
                              if ($menurights->menu_user_id == $_SESSION['user_id'] && $menurights->menu_id == '09')
                              {
                                             //echo '....................................................................................................menurights is ' . $menurights->menu_user_id . ' - ' . $menurights->menu_id . ' - ' . $menurights->approval_level . "\n";
                                             $level = $menurights->approval_level;
                              }             
               }
               $level_1 = $level - 1;
               $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               if ($level > 0 && $level < 4)
               {
					$qry =   "select sum(c.app_count) as app_count
								from (select count(a.reg_exp_seq_no) as app_count
					from cric_regular_expense a, k18_menu_user_rights b
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id')  and status <> 'Rejected'
					and approved_level = 0 
					and a.createdon > DATE_SUB(NOW(), INTERVAL 48 HOUR) 
					and a.status ='Active'
					and a.createdby = b.menu_user_id
					and b.menu_id = '02'
					and $level = b.approval_level + 1
					and a.reg_exp_category <> 'Marketing Promo Event'
					union all
					select count(a.reg_exp_seq_no) as app_count
					from cric_regular_expense a, k18_menu_user_rights b
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id')  and status <> 'Rejected'
					and approved_level = 0 
					and a.createdon < DATE_SUB(NOW(), INTERVAL 48 HOUR) 
					and a.status ='Active'
					and a.createdby = b.menu_user_id
					and b.menu_id = '02'
					and $level = b.approval_level + 2
					and a.reg_exp_category <> 'Marketing Promo Event'
					union all
					select count(a.mileage_exp_seq_no) as app_count
					from cric_mileage_expense a, k18_menu_user_rights b
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id')  and status <> 'Rejected'
					and approved_level = 0 
					and a.createdon > DATE_SUB(NOW(), INTERVAL 48 HOUR) 
					and a.status ='Active'
					and a.createdby = b.menu_user_id
					and b.menu_id = '02'
					and $level = b.approval_level + 1
					union all
					select count(a.mileage_exp_seq_no) as app_count
					from cric_mileage_expense a, k18_menu_user_rights b
					where (select 
					fn_hierarchy_recursive('$user_id', a.createdby)
					= '$user_id')  and status <> 'Rejected'
					and approved_level = 0 
					and a.createdon < DATE_SUB(NOW(), INTERVAL 48 HOUR) 
					and a.status ='Active'
					and a.createdby = b.menu_user_id
					and b.menu_id = '02'
					and $level = b.approval_level + 2
					) c";
                                                                          
               }
			   else if ($level == 4)
				{
					$qry =	"select count(a.reg_exp_seq_no) as app_count
						from cric_regular_expense a
						where a.status = 'Active'
						and a.createdon > DATE_SUB(NOW(), INTERVAL 48 HOUR)
						and a.reg_exp_category = 'Marketing Promo Event'
					   and $level > (select approval_level from k18_menu_user_rights
					   where menu_user_id = a.createdby and menu_id = '02' )";
					
				}
			    else if ($level == 5)
               {
                    $qry =   "select sum(c.app_count) as app_count
					from (select count(a.reg_exp_seq_no) as app_count
					from cric_regular_expense a
					where a.status = 'Active'
					and $level - 2 = (select approval_level from k18_menu_user_rights
					where menu_user_id = a.createdby and menu_id = '02' )
					union all
					select count(a.reg_exp_seq_no) as app_count   
					from cric_regular_expense a
					where ( a.status = 'Approved' or a.status = 'Partially Approved')
					and a.approved_level > 0
					and a.approved_level <= 4
					union all
					select count(a.reg_exp_seq_no) as app_count    
					from cric_regular_expense a, k18_menu_user_rights b
					where a.approved_level = 0
					and a.createdon < DATE_SUB(NOW(), INTERVAL 48 HOUR) 
					and a.status ='Active'
					and a.createdby = b.menu_user_id
					and b.menu_id = '02'
					and (b.approval_level = 0 or
						b.approval_level = 1 or
						b.approval_level = 2 )
					union all
					select count(a.mileage_exp_seq_no) as app_count
					from cric_mileage_expense a
					where a.status = 'Active'
					and $level - 1 = (select approval_level from k18_menu_user_rights
					where menu_user_id = a.createdby and menu_id = '02' )
					union all
					select count(a.mileage_exp_seq_no) as app_count   
					from cric_mileage_expense a
					where ( a.status = 'Approved' or a.status = 'Partially Approved')
					and a.approved_level > 0
                    and a.approved_level <= 3
					union all
					select count(a.mileage_exp_seq_no) as app_count    
					from cric_mileage_expense a, k18_menu_user_rights b
					where a.approved_level = 0
					and a.createdon < DATE_SUB(NOW(), INTERVAL 48 HOUR) 
					and a.status ='Active'
					and a.createdby = b.menu_user_id
					and b.menu_id = '02'
					and $level = b.approval_level + 2			 
					) c";
               }
              
			    else if ($level > 5)
               {
                    $qry =   "select sum(app_count) as app_count
					from (select count(*) as app_count
						   from cric_regular_expense
						   where status = 'Active'
						   and $level - 1 = (select approval_level from k18_menu_user_rights
						   where menu_user_id = cric_regular_expense.createdby and menu_id = '09' )
						   union all
						   select count(*) as app_count
						   from cric_regular_expense
						   where ( status = 'Approved' or status = 'Partially Approved')
						   and approved_level = $level - 1
						   union all
						   select count(*) as app_count
						   from cric_mileage_expense
						   where status = 'Active'
						   and $level - 1 = (select approval_level from k18_menu_user_rights
						   where menu_user_id = cric_mileage_expense.createdby and menu_id = '09' )
						   union all
						   select count(*) as app_count
						   from cric_mileage_expense
						   where ( status = 'Approved' or status = 'Partially Approved')
						   and approved_level = $level - 1
						   ) a";
               }
			   
              
               $st = $conn->prepare( $qry );
              
               $st->execute();
              
               $data = array();
               $row = $st->fetchAll(PDO::FETCH_ASSOC);
               foreach ($row as $key => $value) {
                              $data[$key] = $value;
                             
               }
              
    $conn = null;
 
               echo(json_encode($data));
}
function getHistoricExpDetails()
{

	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$qry = "select  reg_exp_seq_no ,'REGEXP' as exp_type, createdby,
					date_format(reg_exp_date,'%m-%d-%Y') as reg_exp_date,date_format(createdon,'%m-%d-%Y') as createdon, reg_exp_merchant,
					reg_exp_location_dept,ifnull(reg_exp_location_uaid,'') as reg_exp_location_uaid,
					ifnull(reg_exp_description,'') as reg_exp_description, ifnull(reg_exp_mailing_address,'') as reg_exp_mailing_address,
					reg_exp_category, reg_exp_amount,
					status, ifnull(approvedby,'') as approvedby,ifnull(approvedon,'') as approvedon, 
					invoice_image_url from cric_regular_expense  
					where status in ('Approved','Partially Approved') and approved_level ='7' and 
					ifnull(reg_exp_pay_merchant,'') <> 'Company Card'
					ORDER BY createdon desc, status asc";
	
	$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;

	echo(json_encode($data));
}
function updateHistoricExpDetails()
{
	$user_id=$_SESSION['user_id'];
	$id_value = implode(",",$_POST['ids']);
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$qry = "update cric_regular_expense set status='Payout',
	payoutby='$user_id',payouton=now() where reg_exp_seq_no in ($id_value) ";
	
	$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = "Payout Updated successfully";
	
	echo $data;
}
function getHistoricMileageExpDetails()
{

	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$qry = "select  mileage_exp_seq_no ,'MILEEXP' as exp_type, createdby,
					date_format(mileage_exp_date,'%m-%d-%Y') as mileage_exp_date, date_format(createdon,'%m-%d-%Y') as  createdon, 
					mileage_exp_location_dept,ifnull(mileage_exp_location_uaid,'') as mileage_exp_location_uaid,
					ifnull(mileage_exp_description,'') as mileage_exp_description, 
					mileage_exp_amount,status, ifnull(mileage_exp_mailing_address,'') as mileage_exp_mailing_address,
					ifnull(approvedby,'') as approvedby,
					ifnull(approvedon,'') as approvedon from cric_mileage_expense 
					where status in ('Approved','Partially Approved') and approved_level ='7' and
					ifnull(mileage_exp_pay_merchant,'') <> 'Company Card' 
					ORDER BY createdon desc, status asc";
	
	$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;

	echo(json_encode($data));
}
function updateHistoricMileageExpDetails()
{
	$user_id=$_SESSION['user_id'];
	$id_value = implode(",",$_POST['ids']);
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$qry = "update cric_mileage_expense set status='Payout',payoutby='$user_id',
	payouton=now() where mileage_exp_seq_no in ($id_value) ";
	
	$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = "Payout Updated successfully";
	
	echo $data;
}
function getHistoricPaidedExpDetails()
{

	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$qry = "select * from ((SELECT  reg_exp_seq_no as seq_no , 'Regular' as exp_type , DATE_FORMAT(reg_exp_date, '%m-%d-%Y') as exp_date , reg_exp_description as description ,
	reg_exp_location_dept as location , ifnull(reg_exp_location_uaid,'') as uaid, reg_exp_category as category,
	reg_exp_amount as amount, ifnull(reg_exp_app_amount,'') as app_amount , ifnull(reg_exp_mailing_address,'') as mailing_address ,
	ifnull(app_rej_remarks,'') as remarks , createdby as createdby , 
	DATE_FORMAT(createdon, '%m-%d-%Y %T') as createdon , ifnull(DATE_FORMAT(payouton, '%m-%d-%Y'),'') as payouton
	FROM cric_regular_expense where status ='Payout' and ifnull(reg_exp_pay_merchant,'') <> 'Company Card' ) 
	union 
	(SELECT mileage_exp_seq_no as seq_no , 'Mileage' as exp_type , DATE_FORMAT(mileage_exp_date, '%m-%d-%Y') as exp_date , mileage_exp_description as description ,
	mileage_exp_location_dept as location , ifnull(mileage_exp_location_uaid,'') as uaid, '' as category,
	mileage_exp_amount as amount, ifnull(mileage_exp_app_amount,'') as app_amount , ifnull(mileage_exp_mailing_address,'') as mailing_address , 
	ifnull(app_rej_remarks,'') as remarks , createdby as createdby ,
	DATE_FORMAT(createdon, '%m-%d-%Y %T') as createdon , ifnull(DATE_FORMAT(payouton, '%m-%d-%Y'),'') as payouton
	FROM cric_mileage_expense where status ='Payout' and ifnull(mileage_exp_pay_merchant,'') <> 'Company Card')) results ORDER BY payouton DESC";
	
	$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;

	echo(json_encode($data));
}

function getHistoricCompanyCardExpDetails()
{

	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$qry = "select * from ((SELECT  reg_exp_seq_no as seq_no , 'Regular' as exp_type , DATE_FORMAT(reg_exp_date, '%m-%d-%Y') as exp_date , reg_exp_description as description ,
	reg_exp_location_dept as location , ifnull(reg_exp_location_uaid,'') as uaid, reg_exp_category as category,
	ifnull(reg_exp_merchant,'') as merchant,
	reg_exp_amount as amount, ifnull(reg_exp_app_amount,'') as app_amount , ifnull(reg_exp_mailing_address,'') as mailing_address ,
	ifnull(app_rej_remarks,'') as remarks , createdby as createdby , 
	DATE_FORMAT(createdon, '%m-%d-%Y %T') as createdon , ifnull(DATE_FORMAT(payouton, '%m-%d-%Y'),'') as payouton,
	invoice_image_url as invoice_image_url
	FROM cric_regular_expense where ifnull(reg_exp_pay_merchant,'') = 'Company Card' and status='Payout' ) 
	union 
	(SELECT mileage_exp_seq_no as seq_no , 'Mileage' as exp_type , DATE_FORMAT(mileage_exp_date, '%m-%d-%Y') as exp_date , mileage_exp_description as description ,
	mileage_exp_location_dept as location , ifnull(mileage_exp_location_uaid,'') as uaid, '' as category,
	'' as merchant,
	mileage_exp_amount as amount, ifnull(mileage_exp_app_amount,'') as app_amount , ifnull(mileage_exp_mailing_address,'') as mailing_address , 
	ifnull(app_rej_remarks,'') as remarks , createdby as createdby ,
	DATE_FORMAT(createdon, '%m-%d-%Y %T') as createdon , ifnull(DATE_FORMAT(payouton, '%m-%d-%Y'),'') as payouton,
	'' as invoice_image_url
	FROM cric_mileage_expense where ifnull(mileage_exp_pay_merchant,'') = 'Company Card' and status='Payout')) results ORDER BY exp_date asc";
	
	$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;

	echo(json_encode($data));
}

function getCompanyCardEmployeeList()
{

	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$qry = "select ifnull(user_name,'') as user_name from k18_user where designation in ('DM','RD','EVP','Finance1','Finance2','Finance3') order by user_name asc";
	
	$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;

	echo(json_encode($data));
}
function getJSONEmployeesDetails()
{

	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	/* $qry = "select a.id, a.employee_name, 
			ifnull(concat( b.store_address, '</br>' , b.store_city, ', ', 
			b.store_state, ' ', b.store_zip),'') as address, 
			ifnull(b.location,'') as location, 
			fn_hierarchy_get_dm_rd_vp(a.employee_name) as heades 
			from cric_employee_hierarchy a, cric_stores_master b 
			where b.store_id_number = a.location_code
			order by a.employee_name asc"; */
	$qry = "select a.id, a.employee_name, 
			ifnull(concat( b.store_address, '</br>' , b.store_city, ', ', 
			b.store_state, ' ', b.store_zip),'') as address, 
			ifnull(b.location,'') as location, 
			fn_hierarchy_get_dm_rd_vp(a.employee_id) as heades 
			from cric_employee_hierarchy a, cric_stores_master b 
			where b.store_id_number = a.location_code
			order by a.employee_name asc";		
	
	$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;

	echo(json_encode($data));
}

function getJSONUserDetails()
{

	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$qry = "select ifnull(staff_id,'') as staff_id,	
			ifnull(user_name,'') as user_name,
			ifnull(user_email,'') as user_email,
			ifnull(work_location,'') as work_location,
			ifnull(user_phone,'') as user_phone,
			ifnull(designation,'') as designation
			from k18_user where status='Active'";
	
	$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	}
	
    $conn = null;

	echo(json_encode($data));
}
function getProfileInfo()
{
		$login_id = $_SESSION['login_user_id'];
		/*$database = new Database();
	    $conn = $database->getConnection(); */
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select company_id, login_user_id, mailing_address,company_card_no, 
		ifnull(image_url,'') as image_url, status, createdby, 
		phone_no,createdon, modifiedby, modifiedon
		from cric_user_profile where login_user_id = '$login_id'";
		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	} 
	
	
    $conn = null;

	echo(json_encode($data));
}

function getUserStoreCreation()
{
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select user_id,user_name,designation from k18_user";
		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	} 
	
	
    $conn = null;

	echo(json_encode($data));
}
function getLookupStoreCreation()
{
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry =	"select codeid,codevalue from k18_lookup where codeid in('location','us_states')";
		$st = $conn->prepare( $qry );
	
	$st->execute();
	
	$data = array();
	$row = $st->fetchAll(PDO::FETCH_ASSOC);
	foreach ($row as $key => $value) {
		$data[$key] = $value;
		
	} 
	
	
    $conn = null;

	echo(json_encode($data));
}
?>
