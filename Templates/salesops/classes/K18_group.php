<?php
//============================================================+
// File name   : K18_group.php
//
// Description : Class for Group
//				 This sets all the properties for Company Group Class
//				 This has all necessary functions to access Group Class properties
//				 from respective DB tables data
//
//
// Author: Kuppuram
//
// (c) Copyright:
//               Kuppuram
//               18K Softec
//               www.18ksoftec.com
//               kuppuram@18ksoftec.com, kuppuram@gmail.com
//============================================================+


/**
 * Class to handle Customer
 */

class K18_group

{
  
/**
 * @var varchar(10) 
 */
public $company_id = null;

/**
 * @var bigint(20) 
 */
public $company_seq = null;

/**
 * @var varchar(3) 
 */
public $group_id = null;

/**
 * @var varchar(120) 
 */
public $group_name = null;

/**
 * @var varchar(50) 
 */
public $group_address1 = null;

/**
 * @var varchar(50) 
 */
public $group_address2 = null;

/**
 * @var varchar(50) 
 */
public $group_address3 = null;

/**
 * @var varchar(50) 
 */
public $group_city = null;

/**
 * @var varchar(50) 
 */
public $group_state = null;

/**
 * @var varchar(50) 
 */
public $group_country = null;

/**
 * @var varchar(10) 
 */
public $group_zipcode = null;

/**
 * @var varchar(50) 
 */
public $group_phone = null;

/**
 * @var varchar(50) 
 */
public $group_mobile = null;

/**
 * @var varchar(50) 
 */
public $group_email = null;

/**
 * @var varchar(50) 
 */
public $cin_no = null;

/**
 * @var varchar(50) 
 */
public $tin_no = null;

/**
 * @var varchar(50) 
 */
public $cst_no = null;

/**
 * @var date 
 */
public $cst_date = null;

/**
 * @var varchar(50) 
 */
public $service_tax_no = null;

/**
 * @var varchar(50) 
 */
public $pancard_no = null;

/**
 * @var varchar(60) 
 */
public $status = null;

/**
 * @var varchar(10) 
 */
public $createdby = null;

/**
 * @var datetime 
 */
public $createdon = null;

/**
 * @var varchar(10) 
 */
public $modifiedby = null;

/**
 * @var datetime 
 */
public $modifiedon = null;


public function __construct( $data=array() ) 
{ 
	if ( isset( $data['company_id'] ) ) $this->company_id  =  $data['company_id'];
	if ( isset( $data['company_seq'] ) ) $this->company_seq  =  $data['company_seq'];
	if ( isset( $data['group_id'] ) ) $this->group_id  =  $data['group_id'];
	if ( isset( $data['group_name'] ) ) $this->group_name  =  $data['group_name'];
	if ( isset( $data['group_address1'] ) ) $this->group_address1  =  $data['group_address1'];
	if ( isset( $data['group_address2'] ) ) $this->group_address2  =  $data['group_address2'];
	if ( isset( $data['group_address3'] ) ) $this->group_address3  =  $data['group_address3'];
	if ( isset( $data['group_city'] ) ) $this->group_city  =  $data['group_city'];
	if ( isset( $data['group_state'] ) ) $this->group_state  =  $data['group_state'];
	if ( isset( $data['group_country'] ) ) $this->group_country  =  $data['group_country'];
	if ( isset( $data['group_zipcode'] ) ) $this->group_zipcode  =  $data['group_zipcode'];
	if ( isset( $data['group_phone'] ) ) $this->group_phone  =  $data['group_phone'];
	if ( isset( $data['group_mobile'] ) ) $this->group_mobile  =  $data['group_mobile'];
	if ( isset( $data['group_email'] ) ) $this->group_email  =  $data['group_email'];
	if ( isset( $data['cin_no'] ) ) $this->cin_no  =  $data['cin_no'];
	if ( isset( $data['tin_no'] ) ) $this->tin_no  =  $data['tin_no'];
	if ( isset( $data['cst_no'] ) ) $this->cst_no  =  $data['cst_no'];
	if ( isset( $data['cst_date'] ) ) $this->cst_date  =  $data['cst_date'];
	if ( isset( $data['service_tax_no'] ) ) $this->service_tax_no  =  $data['service_tax_no'];
	if ( isset( $data['pancard_no'] ) ) $this->pancard_no  =  $data['pancard_no'];
	if ( isset( $data['status'] ) ) $this->status  =  $data['status'];
	if ( isset( $data['createdby'] ) ) $this->createdby  =  $data['createdby'];
	if ( isset( $data['createdon'] ) ) $this->createdon  =  $data['createdon'];
	if ( isset( $data['modifiedby'] ) ) $this->modifiedby  =  $data['modifiedby'];
	if ( isset( $data['modifiedon'] ) ) $this->modifiedon  =  $data['modifiedon'];


	}

	public static function getListofGroups() {
	
	try
	{
	
		$list = array();
		$arr = array();
			
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$st = $conn->prepare( "Select 
		company_id
,company_seq
,group_id
,group_name
,group_address1
,group_address2
,group_address3
,group_city
,group_state
,group_country
,group_zipcode
,group_phone
,group_mobile
,group_email
,cin_no
,tin_no
,cst_no
,cst_date
,service_tax_no
,pancard_no
,status
,createdby
,createdon
,modifiedby
,modifiedon
		from k18_group
			where status not in ('I') 
			and company_id = :company_id
			Order By group_name");			
		
		$st->bindValue( ":company_id", $_SESSION['company_id'], PDO::PARAM_STR ); 
	    	
	
		$st->execute();
		$arr = $st->errorInfo();
		

		while ( $row = $st->fetch() ) {
			$list[] = new K18_group( $row );
		}
	}
	catch (PDOException $e) {
		//trigger_error( "Get Company Group List: Couldn't execute query" . $e->getMessage());
		$conn = null;
		$retresult['success'] = false;
			//K18_utility::saveError($e->getMessage());
			K18_utility::saveError("Get Company Group List: Couldn't execute query" . ' - ' . $e->getMessage());
			if (contains($e->getMessage(), '18KSoftec Error:'))
			{
					$retresult['errors']  = strstr($e->getMessage(), '18KSoftec Error:');
			}
			else
			{
					$retresult['errors']  = $e->getMessage();
			}
			echo json_encode($retresult);
			$conn = null;
			return;
	}
    $conn = null;
	echo json_encode($list);
	}
	
public static function getGroupById($group_id) {
	
	try
	{
	
		$list = array();
		$arr = array();
			
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$st = $conn->prepare( "Select 
		company_id
,company_seq
,group_id
,group_name
,group_address1
,group_address2
,group_address3
,group_city
,group_state
,group_country
,group_zipcode
,group_phone
,group_mobile
,group_email
,cin_no
,tin_no
,cst_no
,cst_date
,service_tax_no
,pancard_no
,status
,createdby
,createdon
,modifiedby
,modifiedon
		from k18_group 
			where status not in ('I') 
			and company_id = :company_id
			and group_id = :group_id
			Order By group_name");			
		
		$st->bindValue( ":company_id", $_SESSION['company_id'], PDO::PARAM_STR ); 
	    $st->bindValue( ":group_id", $group_id, PDO::PARAM_STR ); 	
	
		$st->execute();
		$arr = $st->errorInfo();
		$row = $st->fetch();

	}
	catch (PDOException $e) {
		trigger_error( "Get Company Group By Id: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
    $conn = null;
	echo json_encode($row);
	return new K18_group( $row );
	}

public static function getGroupFirst() {
	
	try
	{
	
		$list = array();
		$arr = array();
			
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$st = $conn->prepare( "Select 
		company_id
,company_seq
,group_id
,group_name
,group_address1
,group_address2
,group_address3
,group_city
,group_state
,group_country
,group_zipcode
,group_phone
,group_mobile
,group_email
,cin_no
,tin_no
,cst_no
,cst_date
,service_tax_no
,pancard_no
,status
,createdby
,createdon
,modifiedby
,modifiedon
		from k18_group 
			where status not in ('I') 
			and company_id = :company_id
			and group_id = :group_id
			Order By group_name");			
		
		$st->bindValue( ":company_id", $_SESSION['company_id'], PDO::PARAM_STR ); 
	    $st->bindValue( ":group_id", '01', PDO::PARAM_STR ); 	
	
		$st->execute();
		$arr = $st->errorInfo();
		$row = $st->fetch();

	}
	catch (PDOException $e) {
		//trigger_error( "Get Company Group First Item: Couldn't execute query" . $e->getMessage());
		$conn = null;
		$retresult['success'] = false;
			//K18_utility::saveError($e->getMessage());
			K18_utility::saveError("Get Company Group First Item: Couldn't execute query" . ' - ' . $e->getMessage());
			if (contains($e->getMessage(), '18KSoftec Error:'))
			{
					$retresult['errors']  = strstr($e->getMessage(), '18KSoftec Error:');
			}
			else
			{
					$retresult['errors']  = $e->getMessage();
			}
			echo json_encode($retresult);
			$conn = null;
			return;
	}
    $conn = null;
	return new K18_group( $row );
	}
}

?>
