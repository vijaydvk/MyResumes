<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */
	use Box\Spout\Reader\ReaderFactory;
	use Box\Spout\Common\Type;
	require_once 'php_libs/Spout/Autoloader/autoload.php';
class monthlyebit_op
{
 public static function update_monthlyebit()
 {	 
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		// check file name is not empty
		if (!empty($_FILES['monthly_ebit_upload']['name'])) {
			  
			// Get File extension eg. 'xlsx' to check file is excel sheet
			$pathinfo = pathinfo($_FILES["monthly_ebit_upload"]["name"]);
			 
			// check file has extension xlsx, xls and also check 
			// file is not empty
		   if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls') 
				   && $_FILES['monthly_ebit_upload']['size'] > 0 ) {
				 
				// Temporary file name
				$inputFileName = $_FILES['monthly_ebit_upload']['tmp_name']; 
			
				// Read excel file by using ReadFactory object.
				$reader = ReaderFactory::create(Type::XLSX);
				$chk_msg = '';
				// Open file
				$disp_count = 0;
				$sql_falg = 0;
				$i=0;
				$reader->open($inputFileName);
				$count = 1;
				$chk_header = 1;
				$sql_t = "INSERT INTO sun_ebit_monthly VALUES";
				$sql_v = "";
				$uid = $_SESSION['uid'];
				$data = array();
				// Number of sheet in excel file
				$sql = "insert into sun_ebit_monthly values"; 
				foreach ($reader->getSheetIterator() as $sheet) {
					 
					// Number of Rows in Excel sheet
					foreach ($sheet->getRowIterator() as $rowNumber => $row) {
						// It reads data after header. In the my excel sheet, 
						// header is in the first row. 
						if ($count > $chk_header) { 
							$empty ="";
							$store_id = $row[0];
							if ($store_id[0]!="0")
							{
								$store_id = '0'.$row[0];
							}
															
								/* $data[$i]['store_id'] = $store_id;
								$data[$i]['OPPS'] = $row[1];
								$data[$i]['GPO'] = $row[2];
								$data[$i]['GM'] = $row[3];
								$data[$i]['EBITDA'] = $row[4];
								$data[$i]['PAYROLL'] = $row[5];
								$data[$i]['RENT'] = $row[6];
								$data[$i]['CSP'] = $row[7];
								$data[$i]['HANDSET MARGIN'] = $row[8];
								$data[$i]['for_month'] = $row[9];
								$data[$i]['for_year'] = $row[10];
								$i++; */
								
							
							$year=$row[10];
							$month=$row[9];

							if($row[1]=='')
							{
								$row[1] = 0;
							}
							if($row[2]=='')
							{
								$row[2] = 0;
							}
							if($row[3]=='')
							{
								$row[3] = 0;
							}
							if($row[4]=='')
							{
								$row[4] = 0;
							}
							if($row[5]=='')
							{
								$row[5] = 0;
							}
							if($row[6]=='')
							{
								$row[6] = 0;
							}
							if($row[7]=='')
							{
								$row[7] = 0;
							}
							if($row[8]=='')
							{
								$row[8] = 0;
							}
							
							if($row[0]!='0'&&$row[0]!='Grand Total')
							{
							
							$sql = $sql . "(NULL,'". $store_id . "'," . $row[1] . "," . $row[2] . "," . $row[3] . "," . $row[4]. "," . $row[5] . "," . $row[6] . "," . $row[7] . "," . $row[8] . "," . $row[9] . "," . $row[10] . ",'" . $empty . "'),"; 
							$disp_count++;	
							}
							
							

						}
						$count++;
					}
				}
				$sql = substr(trim($sql), 0, -1);
				$chk_sql = "SELECT * FROM sun_ebit_monthly where for_month = " . $month . " and for_year = " .$year ;
				$chk_query = $conn->prepare($chk_sql);
				$chk_query->execute();
				$row_count = $chk_query->rowCount();
				if($row_count > 0)
				{	
				$del_sql = "delete from sun_ebit_monthly where for_month=" . $month  . " and for_year=" . $year ;
				$del_query = $conn->prepare($del_sql);
				$del_query->execute();
					if ($chk_msg == '')
					{
						$chk_msg = 'Duplicate Month and Year Found and updated';
					}
				}
				$query = $conn->prepare($sql);
				$insert = $query->execute();
				// Close excel file
				$reader->close();
				
			  if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Row(s) have been uploaded successfully.';
					$retresult['count'] = $disp_count;
					$retresult['dup_chk'] = $chk_msg;
					//$data = json_encode($data);
					//print_r($data);
					//$retresult['data_JSON']=$data;
				}	 
		 
			} else {
		 
				echo "Please Select Valid Excel File";
			}
		 
		}	
			
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("monthly_ebit_db_page - Add:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("monthly_ebit_db_page - Add:" . 'Non-PDO-Exception' . $e->getMessage());
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
