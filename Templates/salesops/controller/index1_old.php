<?php

//session_start();

// require configuration file
//require 'config/database.php';
include_once '../config/database.php';
if(session_id() == '') {session_start();}
$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : "";
$action(); 

function getexpense_list()
{    
    try
    {
        $database = new Database();
        $conn = $database->getConnection(); 
        $qry =  "SELECT                            
                T.expense_id,                        
                U. NAME AS SubmittedBy,                        
                T.merchant AS Merchant,                        
                T.description AS Description,                        
                T.amount,                        
                date_format(                        
                    from_unixtime(T.expense_submit_date),                    
                    '%m/%d/%y %h:%m %p'                    
                ) AS SubmitTime,                        
                date_format(                        
                    from_unixtime(T.expense_date),                    
                    '%m/%d/%y %h:%m %p'                    
                ) AS ExpenseTime,                        
                IF(F.filename IS NOT NULL, CONCAT('sites/default/files/expenses/',F.filename), 'N/A') as ExpenseImage,                        
                UA.NAME AS Approval,                        
                T.approved AS ExpenseStatus                        
                FROM                            
                sun_expense T                        
                LEFT JOIN users U ON T.expense_uid = U.uid                            
                LEFT JOIN sun_stores S ON T.store_id = S.store_id                            
                LEFT JOIN users UA ON T.approver_uid = UA.uid                            
                LEFT JOIN file_managed F ON T.fid = F.fid                            
                where T.approved IN ('No','Pending')                        
                ORDER BY                        
                T.expense_submit_date DESC                        
                ";        
        $st = $conn->prepare( $qry );    
        $st->execute();
        $data = array();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $key => $value) {
            $data[$key] = $value;            
        }    
        $conn = null;    
        ob_start("ob_gzhandler");
        echo(json_encode($data));
    }
    catch (PDOException $e) {
        trigger_error( "getexpense_list: Couldn't execute query" . $e->getMessage());
        $conn = null;
    }
}

function getDistrictDetails()
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
			$data[$key] = $value;
			
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

function getDMDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT uid,name from users where status = 1 order by name ";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getDMDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getMarketDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT market_id,market_name from sun_market ORDER BY market_name";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getMarketDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getStoreDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT store_id,store_name from sun_stores where store_active = 1 order by store_name";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getStoreDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getDMStoreList()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$district_id = $_REQUEST['id'];
		$qry =	"SELECT 
		ifnull(GROUP_CONCAT(store_id ORDER BY store_name SEPARATOR ','),'') AS store_id 
		FROM 
		sun_stores 
		where 
		store_district_id = $district_id";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getDMStoreList: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getMarketViewsDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT 
				sm.market_id as market_id,
				ifnull(sm.market_name ,'') as market_name,
				ifnull(sr.region_name,'') as region_name,
				sr.region_id as rd_id
				from 
				sun_market sm
				-- users u,
				left join sun_region sr
				on sm.region_id = sr.region_id
				where sm.active = 1
				ORDER BY sm.market_name";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getMarketViewsDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getMarketNameDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT uid,name from users where status = 1 order by name ";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getMarketNameDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getRDNameDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT 
				ifnull(region_id,'') as region_id,
				ifnull(region_name,'') as region_name,
				ifnull(rvp_uid,'') as rvp_uid
				from 
				sun_region 
				where 
				active = 1 order by region_name ";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getRDNameDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getRegionNameDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT 
		uid,name 
		from 
		users 
		where 
		status = 1 
		order by name ";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getRegionNameDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getRegionViewsDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT 
		region_id,
		region_name,
		rvp_uid
		from 
		sun_region 
		where 
		active = 1 
		order by region_name ";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getRegionViewsDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getStoresViewsDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select 
				ss.store_id
				,ifnull(ss.store_name,'') as store_name
				,ifnull(ss.rq_store_name,'') as rq_store_name
				,ss.store_active
				,ss.store_email
				,ss.store_address
				,ss.store_city
				,ss.store_state
				,ss.store_zip
				,ss.store_phone
				,ss.store_uid
				,ifnull(ss.store_district_id,'') as store_district_id	
				,ss.store_image
				,sd.district_name
				from 
				sun_stores ss
				LEFT JOIN sun_district sd on sd.district_id = ss.store_district_id
				order by ss.store_name
				";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		//echo $data[0]['store_address'];
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getStoresViewsDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getDMList()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT district_id, district_name FROM sun_district where active = 1 order by district_name ";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getDMList: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getStates()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT codevalue from k18_lookup where codeid='us_states' order by sortorder";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getStates: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getUsersViewsDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT
				u.uid as uid,
				u.NAME AS employee_name,
				u.mail,
				r.NAME AS role,
				if(u.status = 1, 'Active','InActive') as Status,
				u.status as Status_id,
				IF (P.field_phone_number_value IS NULL,'N/A',P.field_phone_number_value) AS phonenumber,
				IF(fs.field_store_id_value = '0000', 'Home Office',S.store_name) as Store,
				fs.field_store_id_value as Store_id
				FROM
				users u
				INNER JOIN (
				SELECT
				*
				FROM
				users_roles
				WHERE
				rid NOT IN (1, 2, 3)
				) ur ON u.uid = ur.uid
				INNER JOIN role r ON ur.rid = r.rid
				INNER JOIN field_data_field_store_id fS ON fS.entity_id = u.uid
				LEFT JOIN sun_stores S ON S.store_id = fs.field_store_id_value
				LEFT JOIN field_data_field_phone_number P ON u.uid = P.entity_id
				ORDER BY
				u.NAME ASC";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getUsersViewsDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getEditUsersStore()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT store_id,store_name from sun_stores where store_active = 1 order by store_name";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getEditUsersStore: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getDailyDashboardDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select 
					SOR.store_id as store_id,
					ifnull(SS.store_name,'-') as store_name,
					SOR.month_year as month_year,
					SOR.location as address
					from 
					sun_one_report_mtd SOR 
					left join 
					sun_stores SS on SS.store_id=SOR.store_id
					where SOR.month_year like CONCAT('%', MONTHNAME(CURRENT_DATE()), '%')";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getDailyDashboardDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getDailyDashboard4StoreDetails()
{	
	$s_id = $_REQUEST['sid'];
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select SS.store_name as store_name,
				SORD.totalactivations as Adds,
				SORD.deviceupgrades as UPS,
				'N/A' as DTV,
				SSD.opps_goal as goal,
				SSD.opps_per_goal as OP_goal,
				(SORD.smart50+SORD.pro60+SORD.unl55+SORD.unl60+SORD.unl70)/
				(SORD.talkandtext25+SORD.basic30+SORD.basic40+SORD.smart50+SORD.pro60+SORD.unl55+SORD.unl60+SORD.unl70) as RPM,
				SSD.acc_sales as Acc_Rev,
				'N/A' as Acc_Opp,
				SORD.autopayenroll/SORD.autopayoppurtunities as ABP,
				SORD.cricket_protect/SORD.protecteligiblebase as Protect,
				SORD.retailrecommended as WTR
				from sun_one_report_mtd SORD
				left join sun_stores SS on SS.store_id = SORD.store_id
				left join sun_store_dsr SSD on SSD.store_id = SORD.store_id
				where
				SORD.store_id = '$s_id' and
				SSD.dsr_date = (SELECT MAX(dsr_date) FROM sun_store_dsr WHERE store_id ='$s_id') and
				SORD.month_year like CONCAT('%', MONTHNAME(CURRENT_DATE()), '%') and 
				SORD.month_year like CONCAT('%', YEAR(CURRENT_DATE()), '%')";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getDailyDashboard4StoreDetailsDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}
function getDocsTypeViewsDetails()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select * from sun_stores_docs_types";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getDocsTypeViewsDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}	
}
function getStoresDocsViewsDetails()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select SSD.doc_id,
					SSD.store_id,
					SS.store_name,
					SSDT.doc_type,
					SSD.doc_title,
					SSD.doc_file_name,
					SSD.doc_file_type,
					SSD.renewal_date
					from sun_stores_docs SSD,
					sun_stores SS,
					sun_stores_docs_types SSDT
					where SSD.store_id = SS.store_id
					and SSD.doc_type_id = SSDT.doc_type_id";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getStoresDocsViewsDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}	
}

function getStoresDocsListDetails()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select store_id,store_name
				from sun_stores where store_active=1";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getStoresDocsListDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}	
}

function getDocTypeListDetails()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select doc_type_id,doc_type
				from sun_stores_docs_types where active=1";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getDocTypeListDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}	
}

function getInventoryViewsDetails()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select
					T.general_order_id as OrderID,
                    S.store_name as Store,
                    U.name as SubmittedBy,
                    TK.product_name as TCategory,
                    T.order_item_name as Item,
                    T.order_comment as TComment,
                    CASE
					WHEN T.order_status = 0 THEN 'In Process'
                    WHEN T.order_status = 1 THEN 'Ordered'
                    ELSE 'Canceled' END as OrderStatus,
                    date_format(from_unixtime(T.order_time),'%m/%d/%y %h:%m %p') as OrderTime,
                    UT.name as FulfilledBy,
                    date_format(from_unixtime(T.fulfilled_time),'%m/%d/%y %h:%m %p') as FulfilledTime,
                    T.fulfilled_comment as FulfilledComment,
                    T.fulfilled_tracking_no as TrackingInfo
                    from sun_general_prod_order T
                    LEFT JOIN sun_general_order_prod TK ON TK.general_product_id = T.general_product_id
                    LEFT JOIN users U ON T.ordered_by_uid = U.uid
                    LEFT JOIN sun_stores S ON T.ordered_for_store_id = S.store_id
                    LEFT JOIN users UT ON UT.uid = T.fulfilled_by_uid
                    ORDER BY T.order_time DESC";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getInventoryViewsDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}	
}

function getProductListDetails()
{
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"select general_product_id as product_id,
					product_name as product_name
					from sun_general_order_prod 
					where active='1'";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getProductListDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}	
}

function getExportStores()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
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
            WHERE S.store_active = 1
			ORDER BY
			R.region_name,
            M.market_name,
			D.district_name,
			S.store_name
			";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		//echo $data[0]['store_address'];
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getExportStores: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getOrderProductViewDetails()
{	
	try
	{
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT SGOP.general_product_id as product_id,
				SGOP.product_name as product_name,
				SGOP.active as active,
				U.name
				from 
				sun_general_order_prod SGOP,
				users U
				where SGOP.created_by_uid = U.uid
				order by SGOP.product_name";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		//echo $data[0]['store_address'];
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getOrderProductViewDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

function getOrderProductEmailViewDetails()
{	
	try
	{
		$general_product_id =$_REQUEST['general_product_id'];
		$database = new Database();
	    $conn = $database->getConnection(); 
		$qry =	"SELECT * from sun_general_order_prod_emails
				where general_product_id = $general_product_id
				order by email";
		$st = $conn->prepare( $qry );	
		$st->execute();
		$data = array();
		$row = $st->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $key => $value) {
			$data[$key] = $value;
			
		}	
		$conn = null;
		ob_start("ob_gzhandler");
		//echo $data[0]['store_address'];
		echo(json_encode($data));
	}
	catch (PDOException $e) {
		trigger_error( "getOrderProductEmailViewDetails: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
}

?>