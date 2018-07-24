<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>

	<script src="js/manager_handoff.js"></script>
	<link href="css/suncom.css" rel="stylesheet">
    <!-- Custom styles for this template -->
	<style>
	.show > .dropdown-menu {
	  display: block;
	}
	.mfp-content { z-index: 2080 }
	.card{margin-bottom:20px;}
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
		<h5 class="text-left" style="padding-left:20px;"><u>Manager Handoff Details</u></h5>
		<div class="col-md-12" id="manager_view">
			<div class="col-md-12" >
			<table id="manager_handoff_details" class="display responsive" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Handoff Store</th>
						<th>Date</th>
						<th>New Manager</th>
						<th>Current Manager</th>
						<th>District Manager</th>
						<th>New Manager Comment</th>
						<th>Current Manager Comment</th>
						<th>View</th>
					</tr>
				</thead>          
			</table> 
			</div>
		</div>
		  <div  id="handoff_form_view" style="display:none;">
		  <p id="back_click" style="padding-left: 20px;">Back</p>
		  <div class="page-content d-flex align-items-stretch">
			<div class="content-inner full-width">
			  <section class="forms "> 
				<div class="container-fluid">
				  <div class="row">
					<!-- Basic Form-->
					<div class="col-lg-6">
					  <div class="card">
						<div class="card-header d-flex align-items-center">
						  <h5 class="h5">Basic Details</h5>
						</div>
						<div class="card-body">
						   <div class="form-group row">
							  <label for="example-date-input" class="col-4 col-form-label">Date of Handover</label>
							  <div class="col-8">
								<p id="date_view"></p>
							  </div>
							</div>
							<div class="form-group row">
							  <label for="example-date-input" class="col-4 col-form-label">Current Manager</label>
							  <div class="col-8">
									<p id="current_manager_view"></p>
							  </div>
							</div>
							<div class="form-group row">
							  <label for="example-date-input" class="col-4 col-form-label">New Manager</label>
							  <div class="col-8">
								<p id="new_manager_view"></p>
							  </div>
							</div>
							<div class="form-group row">
							  <label for="example-date-input" class="col-4 col-form-label">District Manager</label>
							  <div class="col-8">
								<p id="district_manager_view"></p>
							  </div>
							</div>					
						   
						</div>
					  </div>
					  <div class="card">
						<div class="card-header d-flex align-items-center">
						  <h5 class="h5">Hard Count</h5>
						</div>
						<div class="card-body">
						   <div class="form-group row">
							  <label class="col-6 col-form-label">Hard Count Sheet Number</label>
							  <label class="col-6 col-form-label" id="hard_count_sheet_number_view">Hard Count Sheet Number</label>
							  <!--<div class="col-6">
								<p id="hard_count_sheet_number_view"></p>
							  </div>-->
							</div>
							<!--<div class="col-lg-12">
								<div class="col-lg-6" style="float:left;">
								<h3 class="h5">IMEI</h3>
								</div>
								<div class="col-lg-6" style="float:left;">
								<h3 class="h5">Reason Missing</h3>
								</div>
							</div>-->
						   <div class="form-group row">
							  <label class="col-6 col-form-label">IMEI</label>
							  <label class="col-6 col-form-label">Reason Missing</label>
							  <!--<div class="col-6">
								<p id="hard_count_sheet_number_view"></p>
							  </div>-->
							</div>							
							<div id="hardcount_view_imei_reason">
							</div>
							<!--<div class="col-lg-12">
								<div class="col-lg-6" style="float:left;">
								<h3 class="h5">IMEI</h3>
								</div>
								<div class="col-lg-6" style="float:left;">
								<h3 class="h5">Reason Missing</h3>
								</div>
							</div>	-->						
							<!--<div class="form-group row">
							  <label for="example-date-input" class="col-4 col-form-label">Store Image</label>
							  <div class="col-8">
								<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;" ><img id="store_image_view" src="" height="100px" width="100px" /> </label>
							  </div>
							</div>-->
						</div>
					  </div>	
					  <div class="card">
						<div class="card-header d-flex align-items-center">
						  <h5 class="h5">Clover Devices</h5>
						</div>
						<div class="card-body">
						   <div class="form-group row">
							  <label class="col-6 col-form-label">IMEI</label>
							  <label class="col-6 col-form-label">Reason Missing</label>
							</div>							
							<div id="cloverdevices_view_imei_reason">
							</div>
						</div>
					  </div>

					  <div class="card">
						<div class="card-header d-flex align-items-center">
						  <h5 class="h5">RMA</h5>
						</div>
						<div class="card-body">
						   <div class="form-group row">
							  <label class="col-6 col-form-label">IMEI</label>
							  <label class="col-6 col-form-label">Reason Missing</label>
							</div>							
							<div id="rma_view_imei_reason">
							</div>
						</div>
					  </div>
					  
					  <div class="card">
						<div class="card-header d-flex align-items-center">
						  <h5 class="h5">Cash drawer</h5>
						</div>
						<div class="card-body">
						   <div class="form-group row">
							  <label class="col-4 col-form-label">Register</label>
							  <label class="col-4 col-form-label">Amount</label>
							  <label class="col-4 col-form-label">Comment</label>
							</div>							
							<div id="cashdrawer_view_div">
							</div>
						   <div class="form-group row" id="exp_cashdrawer_view_div" >
							</div>								
						</div>
					  </div>

					  <div class="card">
						<div class="card-header d-flex align-items-center">
						  <h5 class="h5">Misc Items</h5>
						</div>
						<div class="card-body">
						   <div class="form-group row">
							  <label class="col-8 col-form-label">Question</label>
							  <label class="col-4 col-form-label">Yes/No</label>
							</div>							
							<div id="misc_items_view_div">
							</div>
						</div>
					  </div>
					  
					</div>
					
					<div class="col-lg-6">
					  <div class="card">
						<div class="card-header d-flex align-items-center">
						  <h5 class="h5">Store Details</h5>
						</div>
						<div class="card-body">
						   <div class="form-group row">
							  <label for="example-date-input" class="col-4 col-form-label">Store Name</label>
							  <div class="col-8">
								<p id="store_name_view"></p>
							  </div>
							</div>
							<div class="form-group row">
							  <label for="example-date-input" class="col-4 col-form-label">Store Address</label>
							  <div class="col-8">
									<p id="store_address_view"></p>
							  </div>
							</div>
							<div class="form-group row">
							  <label for="example-date-input" class="col-4 col-form-label">Store Image</label>
							  <div class="col-8">
								<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;" ><img id="store_image_view" src="" height="100px" width="100px" /> </label>
							  </div>
							</div>
						</div>
					  </div>
					  
					  <div class="card">
						<div class="card-header d-flex align-items-center">
						  <h5 class="h5">IT Equipment</h5>
						</div>
						<div class="card-body">
						   <div class="form-group row">
							  <label class="col-4 col-form-label">Equipment</label>
							  <label class="col-4 col-form-label">QTY</label>
							  <label class="col-4 col-form-label">Condition</label>
							</div>							
							<div id="it_equipment_view_div">
							</div>
							<div class="form-group row" id="exp_it_equipment_view_div" >
							</div>	
						</div>
					  </div>


					  <div class="card">
						<div class="card-header d-flex align-items-center">
						  <h5 class="h5">Store Fixtures</h5>
						</div>
						<div class="card-body">
						   <div class="form-group row">
							  <label class="col-4 col-form-label">Fixtures</label>
							  <label class="col-4 col-form-label">QTY</label>
							  <label class="col-4 col-form-label">Condition</label>
							</div>							
							<div id="store_fixtures_view_div">
							</div>
							<div class="form-group row" id="exp_store_fixtures_view_div" >
							</div>							
						</div>
					  </div>

					  <div class="card">
						<div class="card-header d-flex align-items-center">
						  <h5 class="h5">Marketing Material</h5>
						</div>
						<div class="card-body">
						   <div class="form-group row">
							  <label class="col-4 col-form-label">Fixtures</label>
							  <label class="col-4 col-form-label">QTY</label>
							  <label class="col-4 col-form-label">Condition</label>
							</div>							
							<div id="marketing_material_view_div">
							</div>
						</div>
					  </div>
					  
					</div>


					<div class="col-lg-6">
					  <div class="card">
						<div class="card-header d-flex align-items-center">
						  <h5 class="h5">Signature</h5>
						</div>
						<div class="card-body">
						<p>New Manager Sign</p>
						<img id="new_mgr_image" />
						<p>District Manager Sign</p>
						<img id="dm_image" />
						<p>Current Manager Sign</p>
						<img id="cur_mgr_image" />
						</div>
					  </div>
					</div>	

					<div class="col-lg-6">
					  <div class="card">
						<div class="card-header d-flex align-items-center">
						  <h5 class="h5">Comments & Date</h5>
						</div>
						<div class="card-body">
						<p id="departing_manager_comment"></p>
						<p id="new_manager_comment"></p>
						<p id="new_mgr_date"></p>
						<p id="dm_date"></p>
						<p id="cur_mgr_date"></p>
						</div>
					  </div>
					</div>						

					</div>  
				</div>
				</div>
			</section>
		</div>
		</div>
	  </div>
	  
		
    </div><!-- /.container -->
  </body>
  <?php
  include_once("footer.php");
  ?>
</html>
