<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SunCom Mobile Portal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="libs/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="libs/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
	    <script src="libs/js/jquery-3.3.1.js"></script>
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    <script src="https://use.fontawesome.com/99347ac47f.js"></script>
    <!-- Font Icons CSS-->
    <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">
	<script src="js/manager_handoff_view.js"></script>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<!--[if lt IE 9]>
	<script type="text/javascript" src="libs/flashcanvas.js"></script>
	<![endif]-->
	<script src="libs/js/jSignature.min.js"></script>
	<style>
	section {
		padding: 10px 0;
	}
	.list-unstyled{
		padding: 5px 0!important;
	}
	.sidebar-header {
		padding: 15px 15px!important;
	}
	.input-material
	{
		padding:3px;!important;
	}
	select,input
	{
		color:#7b858a!important;
	}
	label
	{
		color:black!important;
	}
	#radioBtn .notActive{
		color: #3276b1;
		background-color: #fff;
	}	
	#radioBtn .active{
		color: #3276b1;
		background-color: #eee;
	}	
	.btn-sm
	{
		font-size: 0.675rem;
	}
	select {

	  /* styling */
	  background-color: white!important;
	  border: thin solid #EEF5F9 !important;
	  border-radius: 4px!important;
	  display: inline-block!important;
	  font: inherit!important;
	  line-height: 1.5em!important;
	  padding: 0.5em 3.5em 0.5em 1em!important;

	  /* reset */

	  margin: 0!important;      
	  -webkit-box-sizing: border-box!important;
	  -moz-box-sizing: border-box!important;
	  box-sizing: border-box!important;
	  -webkit-appearance: none!important;
	  -moz-appearance: none!important;
	  appearance:none!important;
	}
	select.round {
	  background-image:
		linear-gradient(45deg, transparent 50%, gray 50%),
		linear-gradient(135deg, gray 50%, transparent 50%),
		radial-gradient(#ddd 70%, transparent 72%);
	  background-position:
		calc(100% - 16px) calc(1em + 2px),
		calc(100% - 11px) calc(1em + 2px),
		calc(100% - .5em) .5em;
	  background-size:
		5px 5px,
		5px 5px,
		1.5em 1.5em;
	  background-repeat: no-repeat;
	}
	.nopad
	{
		padding:5px;
		border:0;
		border-bottom:1px solid #eee;
	}
	body
	{
		font-size: 0.8rem!important;
	}
	.form-control
	{
		font-size: 0.8rem!important;
	}
	.full-width
	{
		width:100%!important;
		padding-left:30px;
		padding-right:30px;
	}
	.jSignature
	{
		background-color:white!important;
		width:100%!important;
		box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1), -1px 0 2px rgba(0, 0, 0, 0.05);
	}
	.select-no-pad
	{
		padding:0px!important;
	}
	.form-group-material
	{
		margin-bottom:5px!important;
	}
	.alert {
		padding: 20px;
		background-color: green;
		color: white;
	}

	.closebtn {
		margin-left: 15px;
		color: white;
		font-weight: bold;
		float: right;
		font-size: 22px;
		line-height: 20px;
		cursor: pointer;
		transition: 0.3s;
	}

	.closebtn:hover {
		color: black;
	}	
	</style>
  </head>
  <body>
    <div class="page home-page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
              <input type="search" placeholder="What are you looking for..." class="form-control">
            
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand">
                  <div class="brand-text brand-big hidden-lg-down"><span>Sun Com Mobile Store Handoff</div>
                  <div class="brand-text brand-small"><strong>Sun Com Mobile</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Search-->
                <!-- Logout    -->
                <!--<li class="nav-item"><a href="index.php?action=logout" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>-->
              </ul>
            </div>
          </div>
        </nav>
      </header>	
		<input type="hidden" value="<?php echo $_GET['handoff_id'];?>" id="handoff_id" />
		<input type="hidden" value="<?php echo $_SESSION['store_id'];?>" id="store_id" />
		  <div  id="handoff_form_view" style="display:block;">
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
						   <div class="form-group row" id="exp_cashdrawer_view_div">
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
								<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;"><img id="store_image_view" src="" height="100px" width="100px" /> </label>
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
							<div class="form-group row" id="exp_it_equipment_view_div">
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
							<div class="form-group row" id="exp_store_fixtures_view_div">
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
	       <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>Sun Com Mobile &copy; 2017-2018</p>
                </div>
                <div class="col-sm-6 text-right">
                  <!--<p>Design by <a href="https://bootstrapious.com/admin-templates" class="external">Bootstrapious</a></p>-->
                  <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                </div>
              </div>
            </div>
          </footer>
	</div>
    <!-- Javascript files-->
    <script src="libs/js/tether.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <script src="libs/js/jquery.cookie.js"> </script>
    <script src="libs/js/jquery.validate.min.js"></script>
    <script src="libs/js/front.js"></script>
  </body>
</html>