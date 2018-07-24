<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */
	use Box\Spout\Reader\ReaderFactory;
	use Box\Spout\Common\Type;
	require_once 'php_libs/Spout/Autoloader/autoload.php';
class rentfile_op
{
public static function update_rentfile()
 {
	// Include Spout library 
	
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		// check file name is not empty
		if (!empty($_FILES['upload_rent_file']['name'])) {
			  
			// Get File extension eg. 'xlsx' to check file is excel sheet
			$pathinfo = pathinfo($_FILES["upload_rent_file"]["name"]);
			 
			// check file has extension xlsx, xls and also check 
			// file is not empty
		   if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls') 
				   && $_FILES['upload_rent_file']['size'] > 0 ) {
				 
				// Temporary file name
				$inputFileName = $_FILES['upload_rent_file']['tmp_name']; 
			
				// Read excel file by using ReadFactory object.
				$reader = ReaderFactory::create(Type::XLSX);
			
				// Open file
				$chk_msg = '';
				$disp_count = 0;
				$reader->open($inputFileName);
				$count = 1;
				$chk_header = $_POST['header_info_flag'];
				$sql_t = "INSERT INTO sun_store_rent VALUES";
				$sql_v = "";
				$uid = $_SESSION['uid'];
				$sql_falg = 0;
				$i=0;
				$data = array();
				// Number of sheet in excel file
				$sql = "insert into sun_store_rent (store_id,account,rent_id,vendor,address,vendor_in_gp,Status,Service,for_month,for_year,amount,lease_expiration,sq_ft) values"; 
				foreach ($reader->getSheetIterator() as $sheet) {
					 
					// Number of Rows in Excel sheet
					foreach ($sheet->getRowIterator() as $rowNumber => $row) {
						// It reads data after header. In the my excel sheet, 
						// header is in the first row.
						
						if ($count > $chk_header) { 
							$chk_sql = "SELECT * FROM sun_store_rent where store_id = '" . $row[0] . "'" . 
										" and for_month = " . $row[8] . " and for_year = " . $row[9];
							$chk_query = $conn->prepare($chk_sql);
							$chk_query->execute();
							$row_count = $chk_query->rowCount();
							if($row_count > 0)
							{
								//echo $count;
								if ($chk_msg == '')
								{
									$chk_msg = 'Duplicate Row(s) are not added and listed below';
								}
								
								$data[$i]['store_id'] = $row[0];
								$data[$i]['account'] = $row[1];
								$data[$i]['rent_id'] = $row[2];
								$data[$i]['vendor'] = $row[3];
								$data[$i]['address'] = $row[4];
								$data[$i]['vendor_in_gp'] = $row[5];
								$data[$i]['Status'] = $row[6];
								$data[$i]['Service'] = $row[7];
								$data[$i]['for_month'] = $row[8];
								$data[$i]['for_year'] = $row[9];
								$data[$i]['amount'] = $row[10];
								$data[$i]['lease_expiration'] = $row[11];
								$data[$i]['sq_ft'] = $row[12];
								$i++;
							}
							else
							{
								//echo $count;
								$sql_falg=1;
								if ($row[10] =='')
								{
									$amount = 'null';
								}
								else
								{
									$amount = $row[10];
								}
								//echo '$row'.$row[11].'-';
								if ($row[11] == '')
								{
									$date = 'null';
									//echo $date;
								}
								else
								{
									/*date_default_timezone_set('GMT'); 
									$date = date("Y-m-d", $temp_date ); */
									$temp_date = intval($row[11]);
									// echo $temp_date;
									//echo $temp_date;
									$temp=($temp_date-25569)*86400;;
									//echo $temp;
									$date = date('Y-m-d', $temp);
									$date = "'".$date."'";
								}
								if ($row[12] =='')
								{
									$sq_ft = 'null';
								}
								else
								{
									$sq_ft = $row[12];
								}
								$sql = $sql . "('". $row[0] . "','" . $row[1] . "','" . $row[2] . "','" . $row[3] . "','" . $row[4]. "','" . $row[5] . "',
												'". $row[6] . "','" . $row[7] . "'," . $row[8] . "," . $row[9] . "," . $amount. ", $date ,
												". $sq_ft . "),"; 

								
								$disp_count++;
							}
						}
						$count++;
					}
				}
				
				// Close excel file
				$reader->close();
				if($sql_falg == 1)
				{
					$sql = substr(trim($sql), 0, -1);
					$query = $conn->prepare($sql);
					$insert = $query->execute();
				}
				else
				{
					$insert = false;
				}
				if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Row(s) have been uploaded successfully.';
					$retresult['count'] = $disp_count;
					$retresult['dup_chk'] = $chk_msg;
					//$data = json_encode($data);
					//print_r($data);
					$retresult['data_JSON']=$data;
				}
				else
				{
					$retresult['success'] = false;
					$retresult['errors'] = 'All Row(s) in Excel are duplicate';
				}
			} 
			else 
			{		 
				echo "Please Select Valid Excel File";
			}
		
		}
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("rent_file_db_page - update:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("rent_file_db_page - update:" . 'Non-PDO-Exception' . $e->getMessage());
		if (contains($e->getMessage(), '18KSoftec Error:'))
		{
			$retresult['errors']  = strstr($e->getMessage(), '18KSoftec Error:');
		}
		else
		{
			//$retresult['errors']  = $e->getMessage();
			$retresult['errors']  = "Submission is not successful - " . $e->getMessage() . ' - may be header is there in excel';
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
