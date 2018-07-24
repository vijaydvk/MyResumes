<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>

	<script src="js/monthly_ebit_uploader.js"></script>
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
		<h5 class="text-left" style="padding-left:15px;"><u>Upload Monthly EBIT</u></h5>		
		<div class="col-md-12">
		<form id="monthly_ebit_upload_form" name="monthly_ebit_upload_form">
		<div class="row justify-content-center">
		<div class="col-md-6">
			<!--<div class="form-group">
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
			 </div>-->
			  <div class="form-group">
				<label for="exampleInputFile">Select File to Upload</label><br>
				<i class="fa fa-upload" aria-hidden="true" onclick="document.getElementById('monthly_ebit_upload').click();"></i><label id="file_name" style="margin-left:5px;"></label>
				<input type="file" class="form-control-file" id="monthly_ebit_upload" name="monthly_ebit_upload" onchange="ExportToTable()" aria-describedby="fileHelp" style="display:none;">
			 </div>
			 <div class="modal-footer">
			 <div id="load" style="display:none;">Please wait...</div>
			 <div class="loader" id="loader" style="display:none;"></div>
					<button type="button" id="monthly_ebit_upload_button" class="btn btn-primary">Upload</button>
					<button type="button" class="btn btn-secondary" id="monthly_ebit_upload_clear_button">Clear</button>
			 </div>	
			
		  </div>
		 </div>
		</form>	
			<table id="view_monthly_ebit_file" class="display responsive" width="100%" style="display:none">
				<thead>
					<tr>
					<th>Store ID</th>
					<th>OPPS</th>
					<th>GPO</th>
					<th>GM</th>
					<th>EBITDA</th>
					<th>PAYROLL</th>
					<th>RENT</th>
					<th>CSP</th>
					<th>HANDSET MARGIN</th>
					<th>For Month</th>
					<th>For Year</th>
					</tr>
				</thead>          
			</table> 
		</div>

		</div>
	</div>
    </div><!-- /.container -->
    <script type="text/javascript">
        function ExportToTable() {
			var new_dataJSON;
			var header_chk=0;
			var reader = new FileReader();

                        reader.onload = function (evt) {
                            
                                var filePath = $('#monthly_ebit_upload').val();
								$('#file_name').html(document.getElementById("monthly_ebit_upload").files[0].name);
                                if (filePath.indexOf("csv") >= 0 || filePath.indexOf("xls") >= 0 || filePath.indexOf("xlsx") >= 0) {
                                    var data = evt.target.result;
                                    var workbook = XLSX.read(data, { type: 'binary' });
                                    var dataJson = XLSX.utils.sheet_to_json(workbook.Sheets[workbook.SheetNames[0]]);
									if(!dataJson[0].hasOwnProperty('store_id'))
									{
										$.notify({
											// options
											message: 'Excel file has no header'
										},{
											// settings
											type: 'warning'
										});
										header_chk=1;										
										/*var newdata = new Array();
										$.each(dataJson, function(k, v) {
											var lp = 0;
											 $.each(v, function(k1, v1) {
												var temp = v1;
												var val = k1;												
												delete dataJson[k][k1];												
												if(lp == 0)
												{
													dataJson[k].store_id=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 1)
												{
													dataJson[k].OPPS=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 2)
												{
													dataJson[k].GPO=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 3)
												{
													dataJson[k].GM=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 4)
												{
													dataJson[k]['EBITDA']=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 5)
												{
													dataJson[k].PAYROLL=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 6)
												{
													dataJson[k].RENT=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 7)
												{
													dataJson[k].CSP=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 8)
												{
													dataJson[k]['HANDSET MARGIN']=temp; 
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 9)
												{
													dataJson[k].for_month=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 10)
												{
													dataJson[k].for_year=temp;
													if(newdata.length<13)
													newdata.push(val);
												}											
												lp++;
											});
										});
										//console.log(newdata);
										dataJson.push({"store_id":newdata[0],"OPPS":newdata[1],"GPO":newdata[2],
														"GM":newdata[3],"EBITDA":newdata[4],"PAYROLL":newdata[5],
														"RENT":newdata[6],"CSP":newdata[7],"HANDSET MARGIN":newdata[8],
														"for_month":newdata[9],"for_year":newdata[10]
														});
										//console.log(dataJson);*/
									}
									if(header_chk ==0)
									{
									for(i=0;i<dataJson.length;i++)
									{
										//console.log(dataJson[i].ClockSeq);
										if(!dataJson[i].hasOwnProperty('store_id'))
										{
											dataJson[i].store_id='';
										}
										if(!dataJson[i].hasOwnProperty('OPPS'))
										{
											dataJson[i].OPPS='';
										}
										if(!dataJson[i].hasOwnProperty('GPO'))
										{
											dataJson[i].GPO='';
										}
										if(!dataJson[i].hasOwnProperty('GM'))
										{
											dataJson[i].GM='';
										}
										if(!dataJson[i].hasOwnProperty('EBITDA'))
										{
											dataJson[i]['EBITDA']='';
										}
										if(!dataJson[i].hasOwnProperty('PAYROLL'))
										{
											dataJson[i].PAYROLL='';
										}
										if(!dataJson[i].hasOwnProperty('RENT'))
										{
											dataJson[i].RENT='';
										}
										if(!dataJson[i].hasOwnProperty('CSP'))
										{
											dataJson[i].CSP='';
										}
										if(!dataJson[i].hasOwnProperty('HANDSET MARGIN'))
										{
											dataJson[i]['HANDSET MARGIN']='';
										}
										if(!dataJson[i].hasOwnProperty('for_month'))
										{
											dataJson[i].for_month='';
										}
										if(!dataJson[i].hasOwnProperty('for_year'))
										{
											dataJson[i].for_year='';
										}										
									}
									var new_dataJSON = dataJson.filter(function(item) { 
									   return item.store_id !== '0' && item.store_id !== 'Grand Total' ;  
									});
									bindTable(new_dataJSON);
								}
								else
								{
									$('#monthly_ebit_upload_form')[0].reset();
									$('#file_name').html('');
								}
                                   
                                }
                           
                        };

                        var isVersionIe = false || !!document.documentMode;
                        if (isVersionIe) {
                            reader.readAsArrayBuffer($("#monthly_ebit_upload")[0].files[0]);
                        } else 
						{
                            reader.readAsBinaryString($("#monthly_ebit_upload")[0].files[0]);
                        }
						
		}
		
		function bindTable(JSON)
		{
		$('#view_monthly_ebit_file').css("display","block");
		if ( $.fn.DataTable.isDataTable('#view_monthly_ebit_file') ) {
			  $('#view_monthly_ebit_file').DataTable().destroy();
			}
		//console.log(JSON);
		  $('#view_monthly_ebit_file').DataTable({
					 aaData: JSON,
					  "aoColumns": [
							{ "data": "store_id" },
							{ "data": "OPPS" },
							{ "data": "GPO" },
							{ "data": "GM" },
							{ "data": "EBITDA" },
							{ "data": "PAYROLL" },
							{ "data": "RENT" },
							{ "data": "CSP" },
							{ "data": "HANDSET MARGIN" },
							{ "data": "for_month" },
							{ "data": "for_year" },
						],
			   });
		}
  
    </script>
  </body>
  <?php
  include_once("footer.php");
  ?>
</html>
