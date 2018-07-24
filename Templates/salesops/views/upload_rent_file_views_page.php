<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>

	<script src="js/upload_rent_file.js"></script>
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
		<h5 class="text-left" style="padding-left:15px;"><u>Upload Rent File</u></h5>		
		<div class="col-md-12">
		<form id="upload_rent_file_form" name="upload_rent_file_form">
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
				<i class="fa fa-upload" aria-hidden="true" onclick="document.getElementById('upload_rent_file').click();"></i><label id="file_name" style="margin-left:5px;"></label>
				<input type="file" class="form-control-file" id="upload_rent_file" name="upload_rent_file" onchange="ExportToTable()" aria-describedby="fileHelp" style="display:none;">
			 </div>
			 <div class="modal-footer">
			 <div id="load" style="display:none;">Please wait...</div>
			 <div class="loader" id="loader" style="display:none;"></div>
					<button type="button" id="upload_rent_file_button" class="btn btn-primary">Upload</button>
					<button type="button" class="btn btn-secondary" id="upload_rent_file_clear_button">Clear</button>
			 </div>	
			
		  </div>
		 </div>
		</form>	
			<table id="view_rent_file" class="display responsive" width="100%" style="display:none">
				<thead>
					<tr>
					<th>Store ID</th>
					<th>Account</th>
					<th>Rent ID</th>
					<th>Vendor</th>
					<th>Address</th>
					<th>Vendor IN GP</th>
					<th>Status</th>
					<th>Service</th>
					<th>For Month</th>
					<th>For Year</th>
					<th>Amount</th>
					<th>Lease Expiration</th>
					<th>Square Feet</th>
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
                            
                                var filePath = $('#upload_rent_file').val();
								$('#file_name').html(document.getElementById("upload_rent_file").files[0].name);
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
										var newdata = new Array();
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
													dataJson[k].account=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 2)
												{
													dataJson[k].rent_id=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 3)
												{
													dataJson[k].vendor=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 4)
												{
													dataJson[k]['address']=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 5)
												{
													dataJson[k].vendor_in_gp=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 6)
												{
													dataJson[k].Status=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 7)
												{
													dataJson[k].Service=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 8)
												{
													dataJson[k].for_month=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 9)
												{
													dataJson[k].for_year=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 10)
												{
													dataJson[k].amount=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 11)
												{
													dataJson[k].lease_expiration=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												else if(lp == 12)
												{
													dataJson[k].sq_ft=temp;
													if(newdata.length<13)
													newdata.push(val);
												}
												lp++;
											});
										});
										//console.log(newdata);
										dataJson.push({"store_id":newdata[0],"account":newdata[1],"rent_id":newdata[2],
														"vendor":newdata[3],"address":newdata[4],"vendor_in_gp":newdata[5],
														"Status":newdata[6],"Service":newdata[7],"for_month":newdata[8],
														"for_year":newdata[9],"amount":newdata[10],"lease_expiration":newdata[11],
														"sq_ft":newdata[12]
														});
										//console.log(dataJson);
									}
									for(i=0;i<dataJson.length;i++)
									{
										//console.log(dataJson[i].ClockSeq);
										if(!dataJson[i].hasOwnProperty('store_id'))
										{
											dataJson[i].store_id='';
										}
										if(!dataJson[i].hasOwnProperty('account'))
										{
											dataJson[i].account='';
										}
										if(!dataJson[i].hasOwnProperty('rent_id'))
										{
											dataJson[i].rent_id='';
										}
										if(!dataJson[i].hasOwnProperty('vendor'))
										{
											dataJson[i].vendor='';
										}
										if(!dataJson[i].hasOwnProperty('address'))
										{
											dataJson[i]['address']='';
										}
										if(!dataJson[i].hasOwnProperty('vendor_in_gp'))
										{
											dataJson[i].vendor_in_gp='';
										}
										if(!dataJson[i].hasOwnProperty('Status'))
										{
											dataJson[i].Status='';
										}
										if(!dataJson[i].hasOwnProperty('Service'))
										{
											dataJson[i].Service='';
										}
										if(!dataJson[i].hasOwnProperty('for_month'))
										{
											dataJson[i].for_month='';
										}
										if(!dataJson[i].hasOwnProperty('for_year'))
										{
											dataJson[i].for_year='';
										}
										if(!dataJson[i].hasOwnProperty('amount'))
										{
											dataJson[i].amount='';
										}
										if(!dataJson[i].hasOwnProperty('lease_expiration'))
										{
											dataJson[i].lease_expiration='';
										}
										if(!dataJson[i].hasOwnProperty('sq_ft'))
										{
											dataJson[i].sq_ft='';
										}
									}
									bindTable(dataJson);
                                   
                                }
                           
                        };

                        var isVersionIe = false || !!document.documentMode;
                        if (isVersionIe) {
                            reader.readAsArrayBuffer($("#upload_rent_file")[0].files[0]);
                        } else 
						{
                            reader.readAsBinaryString($("#upload_rent_file")[0].files[0]);
                        }
						
		}
		
		function bindTable(JSON)
		{
		//	console.log(JSON);
		$('#view_rent_file').css("display","block");
		if ( $.fn.DataTable.isDataTable('#view_rent_file') ) {
			  $('#view_rent_file').DataTable().destroy();
			}

		  $('#view_rent_file').DataTable({
					 aaData: JSON,
					  "aoColumns": [
							{ "data": "store_id" },
							{ "data": "account" },
							{ "data": "rent_id" },
							{ "data": "vendor" },
							{ "data": "address" },
							{ "data": "vendor_in_gp" },
							{ "data": "Status" },
							{ "data": "Service" },
							{ "data": "for_month" },
							{ "data": "for_year" },
							{ "data": "amount" },
							{ "data": "lease_expiration" },
							{ "data": "sq_ft" },
						],
			   });
		}
  
    </script>
  </body>
  <?php
  include_once("footer.php");
  ?>
</html>
