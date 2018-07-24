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
	<script src="js/manager_handoff.js"></script>
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
		<div class="alert" id="div_alert" style="display:none;margin-bottom:420px">
		  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
		  <strong>Success!</strong> Data has been inserted successfully <strong>&nbsp;&nbsp;&nbsp;&nbsp;<span id="view_of_handoff" data-id="1" style="cursor:pointer;color:yellow;">view</span></strong>
		</div>		
      </header>
	  
	  
		  <div  id="handoff_form_view" style="display:none;">
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
  
	  <div  id="handoff_form_controls">
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <!--<nav class="side-navbar">-->
          <!-- Sidebar Header-->
          <!--<div class="sidebar-header d-flex align-items-center">
            <div class="title">
              <h1 class="h4">Store Handoff</h1>
            </div>
          </div>-->
          <!-- Sidebar Navidation Menus--><!--<span class="heading">Main</span>-->
          <!--<ul class="list-unstyled">-->
            <!--<li class="active"> <a href="./"><i class="icon-home"></i>Home</a></li>
            <li><a href="#dashvariants" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Dropdown </a>
              <ul id="dashvariants" class="collapse list-unstyled">
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li>
            <li> <a href="tables.html"> <i class="icon-grid"></i>Tables </a></li>
            <li> <a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>-->
            <!--<li class="active"> <a href="index.html"> <i class="icon-padnote"></i>Handoff Form</a></li>-->
            <!--<li> <a href="login.html"> <i class="icon-interface-windows"></i>Login Page</a></li>
          </ul><span class="heading">Extras</span>-->
        <!--</nav>-->
        <div class="content-inner full-width">
          <!-- Page Header-->
          <!--<header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Dashboard</h2>
            </div>-->
          </header>
          <!-- Dashboard Counts Section-->
          <section class="forms "> 
            <div class="container-fluid">
              <div class="row">
                <!-- Basic Form-->
                <div class="col-lg-6">
                  <div class="card">
                    <!--<div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>-->
					<form name="handoff_form" id="handoff_form">
                    <div class="card-header d-flex align-items-center">
                      <h5 class="h5">Basic Details</h5>
                    </div>
                    <div class="card-body">
                      <!--<p>Lorem ipsum dolor sit amet consectetur.</p>-->
                      
					    <!--<div class="form-group row">
						  <label for="example-date-input" class="col-4 col-form-label">Store Location</label>
						  <div class="col-8">
                            <select class="form-control round" id="store_location">
							</select>
						  </div>
						</div>-->
						<!--<div class="form-group row">
						  <label for="example-date-input" class="col-4 col-form-label">Store Location</label>
						  <div class="col-8">
							<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;"><?php echo $_SESSION['store_name'];?></label>							
						  </div>
						</div>-->
						<input type="hidden" name="handoff_id" id="handoff_id" value="<?php echo $_SESSION['handoff_id'];?>">						
					   <input type="hidden" name="store_id" id="store_id" value="<?php echo $_SESSION['store_id'];?>">
					   <input type="hidden" name="store_name" id="store_name" value="<?php echo $_SESSION['store_name'];?>">
                       <div class="form-group row">
						  <label for="example-date-input" class="col-4 col-form-label">Date of Handover</label>
						  <div class="col-8">
							<input class="form-control" type="date" value="<?php echo date("Y-m-d"); ?>" id="doh" name="doh">
						  </div>
						</div>
					    <div class="form-group row">
						  <label for="example-date-input" class="col-4 col-form-label">Current Manager</label>
						  <div class="col-8">
								<select class="form-control round" id="current_manager" name="current_manager">
								</select>
						  </div>
						</div>
						<div class="form-group row">
						  <label for="example-date-input" class="col-4 col-form-label">New Manager</label>
						  <div class="col-8">
                            <select class="form-control round" id="new_manager" name="new_manager">
							</select>
						  </div>
						</div>
					    <div class="form-group row">
						  <label for="example-date-input" class="col-4 col-form-label">District Manager</label>
						  <div class="col-8">
                            <select class="form-control round" id="district_manager" name="district_manager">
							</select>
						  </div>
						</div>						
                       
                    </div>
                  </div>
                </div>
				<div class="col-lg-6">
                  <div class="card">
                    <!--<div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>-->
                    <div class="card-header d-flex align-items-center">
                      <h5 class="h5">Store Details</h5>
                    </div>
                    <div class="card-body">
                      <!--<p>Lorem ipsum dolor sit amet consectetur.</p>-->
                      
					    <!--<div class="form-group row">
						  <label for="example-date-input" class="col-4 col-form-label">Store Location</label>
						  <div class="col-8">
                            <select class="form-control round" id="store_location">
							</select>
						  </div>
						</div>-->
						<div class="form-group row" style="margin-bottom:5px;">
						  <label for="example-date-input" class="col-4 col-form-label">Store Name</label>
						  <div class="col-8">
							<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;"><?php echo $_SESSION['store_name'];?></label>							
						  </div>
						</div>					
                       <div class="form-group row" style="margin-bottom:5px;">
						  <label for="example-date-input" class="col-4 col-form-label">Store Address</label>
						  <div class="col-8">
							<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;" id="store_address"></label>
						  </div>
						</div>
					    <div class="form-group row" style="margin-bottom:5px;">
						  <label for="example-date-input" class="col-4 col-form-label">Store Image</label>
						  <div class="col-8">
								<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;" ><img id="store_image" src="" height="100px" width="100px" /> </label>
						  </div>
                     </div>
                  </div>				
				</div>
				</div>
                 <!-- Inline Form-->
                <div class="col-lg-6">
                  <div class="card">
                    <!--<div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>-->
                    <div class="card-header d-flex align-items-center">
                      <h5 class="h5">Hard count must be performed by the DM in the presence of the new Manager</h5>
                    </div>
                    <div class="card-body">
                      <!--<p>Lorem ipsum dolor sit amet consectetur.</p>-->
                      
                       <div class="form-group row">
						  <label for="example-date-input" class="col-6 col-form-label">Phone Hard Count Sheet Number</label>
						  <div class="col-6">
							<input class="form-control" type="text" id="hard_count_number" name="hard_count_number">
						  </div>
						</div>				
                       
                    </div>
                    <div id= "hard_count_disp" class="card-header d-flex align-items-center justify-content-center align-self-center">
                      <h5 class="h5">Provide IMEI of phones not found in inventory</h5>
                    </div>
                    <div id= "hard_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-6" style="float:left;">
						<h3 class="h5">IMEI</h3>
						</div>
						<div class="col-lg-6" style="float:left;">
						<h3 class="h5">Reason Missing</h3>
						</div>
					</div>
                    </div>					
                    <div class="card-body" id="phone_missing_div">
                      <!--<p>Lorem ipsum dolor sit amet consectetur.</p>-->
					  <div class="row align-items-center" >
					   <div class="input-group-btn-sm col-2" style="float:left;" > 
						<button class="btn btn-success add-more" id="phone_missing_imei_add" style="font-size:0.6rem;" type="button"><i class="fa fa-plus"></i> Add</button>
					  </div>
					  <div class="col-8"></div>
					   <div class="input-group-btn-sm col-2" style="float:left;padding:0px;" > 
						<button class="btn btn-danger add-more" id="phone_missing_imei_remove" style="font-size:0.6rem;" type="button"><i class="fa fa-minus"></i> Remove</button>
					  </div>					  
					  </div><br>
                      <div id="IMEI_View">
						<div class="col-lg-6" style="float:left;">
							<div class="form-group-material">
								<input id="imei[]" type="text" name="imei[]" required="" placeholder="IMEI" class="input-material">
							</div>
						</div>
						<div class="col-lg-6" style="float:left;">
							<div class="form-group-material">
								<input id="reasonmissing[]" type="text" name="reasonmissing[]" required="" placeholder="Reason" class="input-material">
							</div>
						</div>
                       </div>
                    </div>					
                  </div>
                  <div class="card">
						<!--<div class="card-close">
						  <div class="dropdown">
							<button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
							<div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
						  </div>
						</div>-->
						<div class="card-header d-flex align-items-center justify-content-center align-self-center">
						  <h5 class="h5">Clover Devices</h5>
						</div>
						<div class="card-body">
						  <!--<p>Lorem ipsum dolor sit amet consectetur.</p>-->
								<div class="row align-items-center" >
								   <div class="input-group-btn-sm col-2" style="float:left;" > 
									<button class="btn btn-success add-more" id="clover_devices_add" style="font-size:0.6rem;" type="button"><i class="fa fa-plus"></i> Add</button>
								  </div>
								  <div class="col-8"></div>
								   <div class="input-group-btn-sm col-2" style="float:left;padding:0px;" > 
									<button class="btn btn-danger add-more" id="clover_devices_remove" style="font-size:0.6rem;" type="button"><i class="fa fa-minus"></i> Remove</button>
								  </div>					  
								</div><br>
								<div id="Clover_Devices_Div">
								<div class="col-lg-12" id="CLOVER_View">
									<div class="col-lg-6" style="float:left;">
										<div class="form-group-material">
										  <input id="clover_device_imei[]" name="clover_device_imei[]" required="" placeholder="" class="input-material" type="text">
										</div>
									</div>
									<div class="col-lg-6" style="float:left;">
										<div class="form-group-material">
										  <input id="clover_device_reason[]" name="clover_device_reason[]" required="" placeholder="" class="input-material" type="text">
										</div>
									</div>						
								</div> 
								</div>
						</div>
					</div>
					<div class="card">
						<!--<div class="card-close">
						  <div class="dropdown">
							<button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
							<div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
						  </div>
						</div>-->
						<div class="card-header d-flex align-items-center justify-content-center align-self-center">
						  <h5 class="h5">RMA</h5>
						</div>
						<div class="card-body">
						  <!--<p>Lorem ipsum dolor sit amet consectetur.</p>-->
								<div class="row align-items-center" >
								   <div class="input-group-btn-sm col-2" style="float:left;" > 
									<button class="btn btn-success add-more" id="rma_add" style="font-size:0.6rem;" type="button"><i class="fa fa-plus"></i> Add</button>
								  </div>
								  <div class="col-8"></div>
								   <div class="input-group-btn-sm col-2" style="float:left;padding:0px;" > 
									<button class="btn btn-danger add-more" id="rma_remove" style="font-size:0.6rem;" type="button"><i class="fa fa-minus"></i> Remove</button>
								  </div>					  
								</div><br>	
								<div id="RMA_Div">
								<div class="col-lg-12" id="RMA_View">
									<div class="col-lg-6" style="float:left;">
										<div class="form-group-material">
										  <input id="rma_imei[]" name="rma_imei[]" required="" placeholder="" class="input-material" type="text">
										</div>
									</div>
									<div class="col-lg-6" style="float:left;">
										<div class="form-group-material">
										  <input id="rma_reason[]" name="rma_reason[]" required="" placeholder="" class="input-material" type="text">
										</div>
									</div>						
								</div> 
								</div>
						</div>
					</div>
                  <div class="card">
                    <!--<div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>-->
                    <div id= "cash_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-4" style="float:left;">
						<h3 class="h5">Cash Count</h3>
						</div>
						<div class="col-lg-4" style="float:left;">
						<h3 class="h5">$ Amount</h3>
						</div>
						<div class="col-lg-4" style="float:left;">
						<h3 class="h5">Comments</h3>
						</div>						
					</div>
                    </div>
					<div class="card-body text-center" >
					<div class="row align-items-center" >
					   <div class="input-group-btn-sm col-2" style="float:left;" > 
						<button class="btn btn-success add-more" id="register_add" style="font-size:0.6rem;" type="button"><i class="fa fa-plus"></i> Add</button>
					  </div>
					  <div class="col-8"></div>
					   <div class="input-group-btn-sm col-2" style="float:left;padding:0px;" > 
						<button class="btn btn-danger add-more" id="register_remove" style="font-size:0.6rem;" type="button"><i class="fa fa-minus"></i> Remove</button>
					  </div>					  
					</div>
					</div><br>						
                    <div class="card-body text-center" >
						<div id="Register_Div">
						<div class="col-lg-12" id="Register_view">
							<div class="col-lg-4" style="float:left;padding-top:15px;">
							<h3 class="h6" style="text-align:left;">Register #1</h3>
							</div>
							<div class="col-lg-4" style="float:left;">
								<div class="form-group-material">
								  <input id="register_amt[]" name="register_amt[]" required="" placeholder="amount" class="input-material" type="text">
								</div>
							</div>
							<div class="col-lg-4" style="float:left;">
								<div class="form-group-material">
								  <input id="register_comments[]" name="register_comments[]" required="" placeholder="comments" class="input-material" type="text">
								</div>
							</div>							
						</div>
						</div>
					<div class="card-header d-flex align-items-center justify-content-center align-self-cente">
                      <h5 class="h5">Explain Variance</h5>
                    </div>
						<div class="col-lg-12">
							<textarea class="form-control" rows="5" id="exp_variance" name="exp_variance"></textarea>				
						</div>
                    </div>
                  </div>
                  <div class="card">
                    <!--<div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>-->
                    <div id= "cash_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-9" style="float:left;">
						<h3 class="h5">Misc Items</h3>
						</div>
						<div class="col-lg-3" style="float:left;">
						<h3 class="h5">Yes/No</h3>
						</div>
					</div>
                    </div>
                    <div class="card-body text-center">
						<div id="misc_items_view_div_list">
						</div>
						<!--<div class="col-lg-12">
							<div class="col-lg-10" style="float:left;">
							<h3 class="h6" style="text-align:left;">Did we take the deposit card from the previous manager?</h3>
							</div>
							<div class="col-lg-2" style="float:left;">
							<div class="input-group" style="margin-top:2px;margin-bottom:2px;">
								<div id="radioBtn" class="btn-group">
									<a class="btn btn-primary btn-sm notActive" data-toggle="deposite_card" data-title="1">YES</a>
									<a class="btn btn-primary btn-sm active" data-toggle="deposite_card" data-title="0">NO</a>
								</div>
								<input type="hidden" name="deposite_card" id="deposite_card" value="0">
							</div>
							</div>					
						</div>  
						<div class="col-lg-12">
							<div class="col-lg-10" style="float:left;">
							<h3 class="h6" style="text-align:left;">Was the safe combination changed?</h3>
							</div>
							<div class="col-lg-2" style="float:left;">
							<div class="input-group" style="margin-top:2px;margin-bottom:2px;">
								<div id="radioBtn" class="btn-group">
									<a class="btn btn-primary btn-sm notActive" data-toggle="safe_combination" data-title="1">YES</a>
									<a class="btn btn-primary btn-sm active" data-toggle="safe_combination" data-title="0">NO</a>
								</div>
								<input type="hidden" name="safe_combination" id="safe_combination" value="0">
							</div>
							</div>					
						</div> 
						<div class="col-lg-12">
							<div class="col-lg-10" style="float:left;">
							<h3 class="h6" style="text-align:left;">Was the alarm code changed?</h3>
							</div>
							<div class="col-lg-2" style="float:left;">
							<div class="input-group" style="margin-top:2px;margin-bottom:2px;">
								<div id="radioBtn" class="btn-group">
									<a class="btn btn-primary btn-sm notActive" data-toggle="alarm_code" data-title="1">YES</a>
									<a class="btn btn-primary btn-sm active" data-toggle="alarm_code" data-title="0">NO</a>
								</div>
								<input type="hidden" name="alarm_code" id="alarm_code" value="0">
							</div>
							</div>					
						</div> 	
						<div class="col-lg-12">
							<div class="col-lg-10" style="float:left;">
							<h3 class="h6" style="text-align:left;">Do we have the Manager PIN for the Drop Safe?</h3>
							</div>
							<div class="col-lg-2" style="float:left;">
							<div class="input-group" style="margin-top:2px;margin-bottom:2px;">
								<div id="radioBtn" class="btn-group">
									<a class="btn btn-primary btn-sm notActive" data-toggle="drop_safe_bin" data-title="1">YES</a>
									<a class="btn btn-primary btn-sm active" data-toggle="drop_safe_bin" data-title="0">NO</a>
								</div>
								<input type="hidden" name="drop_safe_bin" id="drop_safe_bin" value="0">
							</div>
							</div>					
						</div> 
						<div class="col-lg-12">
							<div class="col-lg-10" style="float:left;">
							<h3 class="h6" style="text-align:left;">Did we get all keys from the previous manager?</h3>
							</div>
							<div class="col-lg-2" style="float:left;">
							<div class="input-group" style="margin-top:2px;margin-bottom:2px;">
								<div id="radioBtn" class="btn-group">
									<a class="btn btn-primary btn-sm notActive" data-toggle="key_prev_manager" data-title="1">YES</a>
									<a class="btn btn-primary btn-sm active" data-toggle="key_prev_manager" data-title="0">NO</a>
								</div>
								<input type="hidden" name="key_prev_manager" id="hkey_prev_managerappy" value="0">
							</div>
							</div>					
						</div> 	
						<div class="col-lg-12">
							<div class="col-lg-10" style="float:left;">
							<h3 class="h6" style="text-align:left;">Were the door locks changed/replaced?</h3>
							</div>
							<div class="col-lg-2" style="float:left;">
							<div class="input-group" style="margin-top:2px;margin-bottom:2px;">
								<div id="radioBtn" class="btn-group">
									<a class="btn btn-primary btn-sm notActive" data-toggle="door_locks" data-title="1">YES</a>
									<a class="btn btn-primary btn-sm active" data-toggle="door_locks" data-title="0">NO</a>
								</div>
								<input type="hidden" name="door_locks" id="door_locks" value="0">
							</div>
							</div>					
						</div> 
						<div class="col-lg-12">
							<div class="col-lg-10" style="float:left;">
							<h3 class="h6" style="text-align:left;">Have all deposits been verified?</h3>
							</div>
							<div class="col-lg-2" style="float:left;">
							<div class="input-group" style="margin-top:2px;margin-bottom:2px;">
								<div id="radioBtn" class="btn-group">
									<a class="btn btn-primary btn-sm notActive" data-toggle="verified_deposits" data-title="1">YES</a>
									<a class="btn btn-primary btn-sm active" data-toggle="verified_deposits" data-title="0">NO</a>
								</div>
								<input type="hidden" name="verified_deposits" id="verified_deposits" value="0">
							</div>
							</div>					
						</div> 	-->					
                    </div>
                  </div>				  
                  <div class="card">
                    <!--<div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>-->
                    <div class="card-body text-center">
                    <div id= "cash_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-12" style="float:left;">
							<h3 class="h5">Departing Manager's Comments:</h3>
						</div>
					</div>
                    </div>
						<div class="col-lg-12">
							<textarea class="form-control" rows="5" id="departing_mgr_comment" name="departing_mgr_comment"></textarea>				
						</div>
                    </div>
                  </div>					
                </div>
                <!-- Modal Form-->
                <div class="col-lg-6">
                  <div class="card">
                    <!--<div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>-->
                    <div id= "hard_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-6" style="float:left;">
						<h3 class="h5">IT Equipment</h3>
						</div>
						<div class="col-lg-2" style="float:left;">
						<h3 class="h5">QTY</h3>
						</div>
						<div class="col-lg-2" style="float:left;">
						<h3 class="h5">Condition</h3>
						</div>						
					</div>
                    </div>
                    <div class="card-body text-center">
						<div id="it_equipment_view_div_list">
						
						</div>
					<div class="col-lg-12 d-flex align-items-center justify-content-center align-self-cente" style="padding-top:15px;">
                      <h5 class="h5">Describe the condition of the POS stations</h5>
                    </div>
						<div class="col-lg-12">
							<textarea class="form-control" rows="5" id="pos_station_condition" name="pos_station_condition"></textarea>				
						</div>
					</div>
                  </div>
                  <div class="card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>
                    <div id= "hard_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-6" style="float:left;">
						<h3 class="h5">Store Fixtures</h3>
						</div>
						<div class="col-lg-2" style="float:left;">
						<h3 class="h5">QTY</h3>
						</div>
						<div class="col-lg-2" style="float:left;">
						<h3 class="h5">Condition</h3>
						</div>						
					</div>
                    </div>
                    <div class="card-body text-center">
						<div id="store_fixtures_view_div_list">
						
						</div>
					<div class="col-md-12 d-flex align-items-center justify-content-center align-self-center" style="padding-top:15px;">
                      <h5 class="h5">Describe the condition of the store fixtures</h5>
                    </div>
						<div class="col-lg-12">
							<textarea class="form-control" rows="5" id="store_fixtures_condition_cmt" name="store_fixtures_condition_cmt"></textarea>				
						</div>
                    </div>
                  </div>
				<div class="card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>
                    <div id= "hard_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-6" style="float:left;">
						<h3 class="h5">Marketing Material</h3>
						</div>
						<div class="col-lg-2" style="float:left;">
						<h3 class="h5">QTY</h3>
						</div>
						<div class="col-lg-2" style="float:left;">
						<h3 class="h5">Condition</h3>
						</div>						
					</div>
                    </div>
                    <div class="card-body text-center">
					<div id="marketing_material_view_div_list">
					</div>
                    </div>
                  </div>	
                  <div class="card">
                    <!--<div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                    </div>-->
                    <div class="card-body text-center">
                    <div id= "cash_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-12" style="float:left;">
							<h3 class="h5">New Manager Comments: </h3>
						</div>
					</div>
                    </div>
						<div class="col-lg-12">
							<textarea class="form-control" rows="5" id="new_mgr_comment" name="new_mgr_comment"></textarea>				
						</div>
                    </div>
                  </div>				  
                </div>
                <!-- Form Elements -->
				<div class="col-md-12">
					<div class="col-md-6" style="float:left;">
						<div id="old_manager_signature_div" style="display:block;">
							<div id="old_manager_signature" style="background-color:#eee;border-bottom:2px solid black;"></div>Old Manager
							<input type="button" value="Clear" name="om_signature_reset" id="om_signature_reset" style="float:right;" />
						</div>
						<div id="old_manager_signature_div_img" style="display:none;">
							<img id="old_manager_img" src="" alt="No Image Available" />Old Manager
						</div>						
					</div>
					<div class="col-md-6" style="float:left;">
						<div style="background-color:white;border-bottom:2px solid black;min-height:115px;">
							<div class="form-group row">
							  <div class="col-8">
								<input class="form-control" style="margin:7% 25%" value="mm/dd/yyyy" name="current_mgr_date" id="current_mgr_date" type="date">
							  </div>
							</div>
						</div>Date
					</div>
					<div class="col-md-6" style="float:left;">
						<div id="new_manager_signature_div" style="display:block;">
							<div id="new_manager_signature" style="background-color:#eee;border-bottom:2px solid black;"></div>New Manager
							<input type="button" value="Clear" name="nm_signature_reset" id="nm_signature_reset" style="float:right;" />
						</div>
						<div id="new_manager_signature_div_img" style="display:none;">
							<img id="new_manager_img" src="" alt="No Image Available" />New Manager
						</div>
					</div>
					<div class="col-md-6" style="float:left;">
						<div style="background-color:white;border-bottom:2px solid black;min-height:115px;">
							<div class="form-group row">
							  <div class="col-8">
								<input class="form-control" style="margin:7% 25%" value="mm/dd/yyyy" name="new_mgr_date" id="new_mgr_date" type="date">
							  </div>
							</div>
						</div>Date
					</div>
					<div class="col-md-6" style="float:left;">
					<div id="district_manager_signature_div" style="display:block;">
						<div id="district_manager_signature" style="background-color:#eee;border-bottom:2px solid black;"></div>District Manager
						<input type="button" value="Clear" name="dm_signature_reset" id="dm_signature_reset" style="float:right;" />
					</div>
					<div id="district_manager_signature_div_img" style="display:none;">
						<img id="district_manager_img" src="" alt="No Image Available" />District Manager
					</div>
					</div>
					<div class="col-md-6" style="float:left;">
						<div style="background-color:white;border-bottom:2px solid black;min-height:115px;">
							<div class="form-group row">
							  <div class="col-8">
								<input class="form-control" style="margin:7% 25%" value="mm/dd/yyyy" name="dm_date" id="dm_date" type="date">
							  </div>
							</div>
						</div>Date
					</div>
					<!--<input type="button" id="save_images" value="submit" name="save_images" />-->
					<input type="reset" value="Reset the form" id="reset" style="display:none;">
					</form>
					<center><button type="button" id="save_button" name="save_button" class="btn btn-primary sm">Save</button><center>
				</div>
             </div>
            </div>
          </section>
        </div>
      </div>
	 </div>
	<script>
	    $(document).ready(function() {
	        $("#old_manager_signature").jSignature({
			    'decor-color': 'transparent',
				height: 100
			});
	        $("#new_manager_signature").jSignature({
			    'decor-color': 'transparent',
				height: 100
			});
			$("#district_manager_signature").jSignature({
			    'decor-color': 'transparent',
				height: 100
			});
			$('#om_signature_reset').click(function(){
				$("#old_manager_signature").jSignature("reset");
			});
			$('#dm_signature_reset').click(function(){
				$("#district_manager_signature").jSignature("reset");
			});
			$('#nm_signature_reset').click(function(){
				$("#new_manager_signature").jSignature("reset");
			});		
	    });
	</script>		  
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