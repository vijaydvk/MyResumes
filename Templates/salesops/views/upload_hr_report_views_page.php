<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>

	<script src="js/upload_hr_report.js"></script>
	<link href="css/suncom.css" rel="stylesheet">
	<script src="libs/js/cpexcel.js"></script>
	<!--<script src="libs/js/shim.js"></script>-->
	<script src="libs/js/jszip.js"></script>
	<script src="libs/js/xlsx.js"></script>
    <!-- Custom styles for this template -->
	<style>
	tr
	{
		width:100%;
	}
		.loader {
		  border: 16px solid #f3f3f3;
		  border-radius: 50%;
		  border-top: 16px solid #3498db;
		  width: 60;
		  height: 60;
		  -webkit-animation: spin 2s linear infinite;
		  animation: spin 2s linear infinite;
		}

		@-webkit-keyframes spin {
		  0% { -webkit-transform: rotate(0deg); }
		  100% { -webkit-transform: rotate(360deg); }
		}

		@keyframes spin {
		  0% { transform: rotate(0deg); }
		  100% { transform: rotate(360deg); }
		}
	</style>
  </head>

  <body>

  <?php
  include_once("menu.php");
  ?>

    <div class="container">

      <!--<div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div>-->
	  <div class="row">
		<h5 class="text-left" style="padding-left:15px;"><u>Upload HR Report</u></h5>		
		<div class="col-md-12">
		<form id="upload_hr_report_form" name="upload_hr_report_form">
		  <!--<div class="form-group">
			<label for="exampleInputFile">Select File to Upload</label>
			<input type="file" class="form-control-file" id="upload_hr_report_file" name="upload_hr_report_file" aria-describedby="fileHelp">
			<small id="fileHelp" class="form-text text-muted">Upload xlsx file</small>
			<br><button type="button" id="upload_hr_report_button" class="btn btn-secondary btn-sm btn-outline-secondary">Upload</button>			
		  </div> -->
		<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Header Option</label>
				<div>										
					<label class="custom-control custom-radio">
					  <input id="header_info_flag" name="header_info_flag" type="radio" class="custom-control-input" value="1" checked="checked">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">Yes</span>
					</label>
					<label class="custom-control custom-radio">
					  <input id="header_info_flag" name="header_info_flag" type="radio" class="custom-control-input" value="0">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">No</span>
					</label>
				</div>
			 </div>
			  <div class="form-group">
				<label for="exampleInputFile">Select File to Upload</label><br>
				<i class="fa fa-upload" aria-hidden="true" onclick="document.getElementById('upload_hr_report_file').click();"></i><label id="file_name" style="margin-left:5px;"></label>
				<input type="file" class="form-control-file" id="upload_hr_report_file" name="upload_hr_report_file" onchange="ExportToTable()" aria-describedby="fileHelp" style="display:none;">
			 </div>
			 <div class="modal-footer">
			 <div id="load" style="display:none;">Please wait...</div>
			 <div class="loader" id="loader" style="display:none;"></div>
					<button type="button" id="upload_hr_report_button" class="btn btn-primary">Upload</button>
					<button type="button" class="btn btn-secondary" id="upload_hr_report_clear_button">Clear</button>
			 </div>	
			
		  </div>
		 </div>
		</form>	
			<table id="view_tickets_open" class="display" width="100%" style="display:none">
				<thead>
					<tr>
					<th>Employee Name</th>
					<th>Employee Status</th>
					<th>Sub_Department Desc</th>
					<th>Location Code</th>
					<th>Clock Seq</th>
					<th>Hire Date</th>
					</tr>
				</thead>          
			</table> 
		</div>

		</div>
	</div>
    </div><!-- /.container -->
    <script type="text/javascript">
        function ExportToTable() {
			var reader = new FileReader();

                        reader.onload = function (evt) {
                            
                                var filePath = $('#upload_hr_report_file').val();
								$('#file_name').html(document.getElementById("upload_hr_report_file").files[0].name);
                                if (filePath.indexOf("csv") >= 0 || filePath.indexOf("xls") >= 0 || filePath.indexOf("xlsx") >= 0) {
                                    var data = evt.target.result;
                                    var workbook = XLSX.read(data, { type: 'binary' });
                                    var dataJson = XLSX.utils.sheet_to_json(workbook.Sheets[workbook.SheetNames[0]]);
									if(!dataJson[0].hasOwnProperty('Employee_Name'))
									{
										$.notify({
											// options
											message: 'Excel file has no header'
										},{
											// settings
											type: 'warning'
										}); 
										var newdata = new Array();
										$.each(dataJson, function(k, v) {
											var lp = 0;
											 $.each(v, function(k1, v1) {
												var temp = v1;
												var val = k1;												
												delete dataJson[k][k1];												
												if(lp == 0)
												{
													dataJson[k].Employee_Name=temp;
													if(newdata.length<6)
													newdata.push(val);
												}
												else if(lp == 1)
												{
													dataJson[k].Employee_Status=temp;
													if(newdata.length<6)
													newdata.push(val);
												}
												else if(lp == 2)
												{
													dataJson[k].Sub_Department_Desc=temp;
													if(newdata.length<6)
													newdata.push(val);
												}
												else if(lp == 3)
												{
													dataJson[k].Location_Code=temp;
													if(newdata.length<6)
													newdata.push(val);
												}
												else if(lp == 4)
												{
													dataJson[k]['ClockSeq_#']=temp;
													if(newdata.length<6)
													newdata.push(val);
												}
												else if(lp == 5)
												{
													dataJson[k].Hire_Date=temp;
													if(newdata.length<6)
													newdata.push(val);
												}
												lp++;
											});
										});
										console.log(newdata);
										dataJson.push({"Employee_Name":newdata[0],"Employee_Status":newdata[1],"Sub_Department_Desc":newdata[2],"Location_Code":newdata[3],"ClockSeq_#":newdata[4],"Hire_Date":newdata[5]});
										console.log(dataJson);
									}
									for(i=0;i<dataJson.length;i++)
									{
										//console.log(dataJson[i].ClockSeq);
										if(!dataJson[i].hasOwnProperty('Employee_Name'))
										{
											dataJson[i].Employee_Name='';
										}
										if(!dataJson[i].hasOwnProperty('Employee_Status'))
										{
											dataJson[i].Employee_Status='';
										}
										if(!dataJson[i].hasOwnProperty('Sub_Department_Desc'))
										{
											dataJson[i].Sub_Department_Desc='';
										}
										if(!dataJson[i].hasOwnProperty('Location_Code'))
										{
											dataJson[i].Location_Code='';
										}
										if(!dataJson[i].hasOwnProperty('ClockSeq_#'))
										{
											dataJson[i]['ClockSeq_#']='';
										}
										if(!dataJson[i].hasOwnProperty('Hire_Date'))
										{
											dataJson[i].Hire_Date='';
										}										
									}
									bindTable(dataJson);
                                   
                                }
                           
                        };

                        var isVersionIe = false || !!document.documentMode;
                        if (isVersionIe) {
                            reader.readAsArrayBuffer($("#upload_hr_report_file")[0].files[0]);
                        } else 
						{
                            reader.readAsBinaryString($("#upload_hr_report_file")[0].files[0]);
                        }
						
		}
		
		function bindTable(JSON)
		{
		//	console.log(JSON);
		$('#view_tickets_open').css("display","block");
		if ( $.fn.DataTable.isDataTable('#view_tickets_open') ) {
			  $('#view_tickets_open').DataTable().destroy();
			}

		  $('#view_tickets_open').DataTable({
					 aaData: JSON,
					  "aoColumns": [
							{ "data": "Employee_Name",'sWidth':'25%' },
							{ "data": "Employee_Status",'sWidth':'20%' },
							{ "data": "Sub_Department_Desc",'sWidth':'20%' },
							{ "data": "Location_Code",'sWidth':'10%' },
							{ "data": "ClockSeq_#",'sWidth':'10%' },
							{ "data": "Hire_Date",'sWidth':'15%' },
							
						],
			   });
		}
  
    </script>
  </body>
  <?php
  include_once("footer.php");
  ?>
</html>
