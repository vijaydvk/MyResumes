<?php
//============================================================+
// File name   : K18_Lookup.php
//
// Description : Class for Lookup
//				 This sets all the properties for Lookup Class
//				 This has all necessary functions to access Lookup Class properties
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
 * Class to handle Lookup
 */

class K18_Lookup

{
  
/**
 * @var int(11) 
 */
public $id = null;

/**
 * @var varchar(20) 
 */
public $codegroup = null;
public $company_id = null;
public $company_seq = null;
public $group_id = null;
/**
 * @var varchar(40) 
 */
public $codeid = null;

/**
 * @var varchar(40) 
 */
public $codevalue = null;

/**
 * @var varchar(40) 
 */
public $shortdesc = null;

/**
 * @var varchar(60) 
 */
public $longdesc = null;

/**
 * @var int(11) 
 */
public $sortorder = null;

/**
 * @var varchar(2) 
 */
public $status = null;

/**
 * @var varchar(50) 
 */
public $createdby = null;

/**
 * @var datetime 
 */
public $createdon = null;

/**
 * @var varchar(50) 
 */
public $modifiedby = null;

/**
 * @var datetime 
 */
public $modifiedon = null;




public function __construct( $data=array() ) 
{ 
	if ( isset( $data['id'] ) ) $this->id  =  $data['id'];
	if ( isset( $data['codegroup'] ) ) $this->codegroup  =  $data['codegroup'];
	if ( isset( $data['company_id'] ) ) $this->company_id  =  $data['company_id'];
	if ( isset( $data['company_seq'] ) ) $this->company_seq  =  $data['company_seq'];
	if ( isset( $data['group_id'] ) ) $this->group_id  =  $data['group_id'];
	if ( isset( $data['codeid'] ) ) $this->codeid  =  $data['codeid'];
	if ( isset( $data['codevalue'] ) ) $this->codevalue  =  $data['codevalue'];
	if ( isset( $data['shortdesc'] ) ) $this->shortdesc  =  $data['shortdesc'];
	if ( isset( $data['longdesc'] ) ) $this->longdesc  =  $data['longdesc'];
	if ( isset( $data['sortorder'] ) ) $this->sortorder  =  $data['sortorder'];
	if ( isset( $data['status'] ) ) $this->status  =  $data['status'];
	if ( isset( $data['createdby'] ) ) $this->createdby  =  $data['createdby'];
	if ( isset( $data['createdon'] ) ) $this->createdon  =  $data['createdon'];
	if ( isset( $data['modifiedby'] ) ) $this->modifiedby  =  $data['modifiedby'];
	if ( isset( $data['modifiedon'] ) ) $this->modifiedon  =  $data['modifiedon'];

}

	public static function getListofLookup() {
	
	try
	{
	
		$list = array();
		$arr = array();
			
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$st = $conn->prepare( "select a.*
									from k18_lookup a
									where a.status not in ('I') 
									Order By a.codeid, a.sortorder");
									
		
		//$st->bindValue( ":company_id", $_SESSION['company_id'], PDO::PARAM_STR ); 
	    	
	
		$st->execute();
		$arr = $st->errorInfo();
		

		while ( $row = $st->fetch() ) {
			$list[] = new K18_Lookup( $row );
		}
	}
	catch (PDOException $e) {
		trigger_error( "Get Lookup List: Couldn't execute query" . $e->getMessage());
		$conn = null;
	}
    $conn = null;
	echo json_encode($list);
}

public static function getLookup4Popup($codeid)
{
	try
	{
		$list = array();
		$arr = array();
			
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$st = $conn->prepare( "select * from k18_lookup 
								where codeid = :codeid
								and status = 'Active'
								order by sortorder");		
	
		$st->bindValue( ":codeid", $codeid, PDO::PARAM_STR );
		
		$st->execute();
		$arr = $st->errorInfo();
		

		while ( $row = $st->fetch() ) {
			$list[] = new K18_Lookup( $row );
			//array_push($list,array($row['area'])); this is not working properly at it returns array instead of json object
		}	
		
	}
	catch (PDOException $e) {
		//trigger_error( "Get Area List: Couldn't execute query" . $e->getMessage());
		$retresult['success'] = false;
		//K18_utility::saveError($e->getMessage());
		K18_utility::saveError("Get Area List from Lookup: Couldn't execute query" . ' - ' . $e->getMessage());
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
  
	
public function crud_k18_lookup($imode)
	{
	$arr=array();
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$st = '';
	$status = 'Active';
	$retresult = array();
	$errors = array();
	try
	{
		$conn->beginTransaction();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$st = $conn->prepare('CALL sp_crud_k18_lookup(?,?,?,?,?,
													  ?,?,?,?,?,
													  ?)');


			$st->bindValue(1,$imode, PDO::PARAM_STR );
			$st->bindValue(2,$this->id, PDO::PARAM_INT );
			$st->bindValue(3,$_SESSION['company_id'], PDO::PARAM_STR );
			$st->bindValue(4,$_SESSION['company_seq'], PDO::PARAM_STR );
			$st->bindValue(5,$_SESSION['user_id'], PDO::PARAM_STR );
			$st->bindValue(6,$this->codeid, PDO::PARAM_STR );
			$st->bindValue(7,$this->codevalue, PDO::PARAM_STR );
			$st->bindValue(8,$this->shortdesc, PDO::PARAM_STR );
			$st->bindValue(9,$this->longdesc, PDO::PARAM_STR );
			$st->bindValue(10,$this->sortorder, PDO::PARAM_INT );
			$st->bindValue(11,$this->status, PDO::PARAM_STR );
			$st->execute();
		}
		catch (PDOException $e) {
			$retresult['success'] = false;
			//K18_utility::saveError($e->getMessage());
			
			K18_utility::saveError('Error from crud_k18_lookup in imode - '. $imode . ' - ' . $e->getMessage());
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
		$conn->commit();
		$conn = null;
		$retresult['success'] = true;
		$retresult['posted']  = 'Data successfully updated';
		echo json_encode($retresult);
	}
	
}

?>
