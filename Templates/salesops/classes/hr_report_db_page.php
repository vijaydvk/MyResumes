<?php
//require '../config/database.php';
/* $mode = isset( $_REQUEST['mode'] ) ? $_REQUEST['mode'] : "";
$mode(); */
	use Box\Spout\Reader\ReaderFactory;
	use Box\Spout\Common\Type;
	require_once 'php_libs/Spout/Autoloader/autoload.php';
class hrreport_op
{
public static function update_hrreport()
 {
	// Include Spout library 
	
	try
	{	
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		$retresult['success'] = false;
		$retresult['errors']  = "Submission is not successful";
		
		// check file name is not empty
		if (!empty($_FILES['upload_hr_report_file']['name'])) {
			  
			// Get File extension eg. 'xlsx' to check file is excel sheet
			$pathinfo = pathinfo($_FILES["upload_hr_report_file"]["name"]);
			 
			// check file has extension xlsx, xls and also check 
			// file is not empty
		   if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls') 
				   && $_FILES['upload_hr_report_file']['size'] > 0 ) {
				 
				// Temporary file name
				$inputFileName = $_FILES['upload_hr_report_file']['tmp_name']; 
			
				// Read excel file by using ReadFactory object.
				$reader = ReaderFactory::create(Type::XLSX);
			
				// Open file
				$disp_count = 0;
				$reader->open($inputFileName);
				$count = 1;
				$chk_header = $_POST['header_info_flag'];
				$sql_t = "INSERT INTO sun_hrportal_report VALUES";
				$sql_v = "";
				$uid = $_SESSION['uid'];
				// Number of sheet in excel file
				$sql = "insert into sun_hrportal_report values"; 
				foreach ($reader->getSheetIterator() as $sheet) {
					 
					// Number of Rows in Excel sheet
					foreach ($sheet->getRowIterator() as $rowNumber => $row) {
						// It reads data after header. In the my excel sheet, 
						// header is in the first row. 
						if ($count > $chk_header) { 
							
							$array = json_decode(json_encode($row[5]), True); 
							$date = explode(" ",$array['date']);;
							//$date = date_format($array['date'], 'Y-m-d');
							//echo $value[0];  
							   
						/* 	if ($sql_v == "")
								$sql_v = "('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$date[0]','')";
							else
								$sql_v = "," . "('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$date[0]','')";
							echo $sql_t.$sql_v; */
							
							$sql = $sql . "('". $row[0] . "','" . $row[1] . "','" . $row[2] . "','" . $row[3] . "','" . $row[4]. "','" . $date[0] . "'," . $uid . "),"; 

							
							$disp_count++;
							

									
							/* $query = $conn->prepare($sql);

							$insert = $query->execute();  */
						}
						$count++;
					}
				}
				$sql = substr(trim($sql), 0, -1);
				$sql1 = "truncate table sun_hrportal_report";
				$query = $conn->prepare($sql1);
				$insert = $query->execute();
				$query = $conn->prepare($sql);
				$insert = $query->execute();
				// Close excel file
				$reader->close();
				
			  if($insert){
					$retresult['success'] = true;
					$retresult['msg'] = 'Row(s) have been uploaded successfully.';
					$retresult['count'] = $disp_count;
				}	 
		 
			} else {
		 
				echo "Please Select Valid Excel File";
			}
		 
		}
		else
		{
			$retresult['success'] = false;
			$retresult['errors']  = "Check Excel File";
		}
	}
	catch (PDOException $e)
    {

		$retresult['success'] = false;
		K18_utility::saveError("hr_report_db_page - update:" . 'PDO-Exception' . $e->getMessage());
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
		K18_utility::saveError("hr_report_db_page - update:" . 'Non-PDO-Exception' . $e->getMessage());
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
