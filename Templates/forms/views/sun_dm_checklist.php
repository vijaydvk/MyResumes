<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sun Com Mobile Portal</title>
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
	<script src="js/sun_dm_checklist.js"></script>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<!--[if lt IE 9]>
	<script type="text/javascript" src="libs/flashcanvas.js"></script>
	<![endif]-->
	<style>
	th
	{
		color:white;
		background-color:#2f333e;
		text-align:center;
	}
	body
	{
		font-size:1rem!important;
		background: #EEF5F9;
	}
	</style>
  </head>
  <body>
	<div class="page home-page" id="dm_checklist_location_div" style="display:block;padding:100px;top:50%;left:50%">
		<div><center><h1>Welcome</h1>Please Enable Location in Browser</center></div>
	</div>
	<div class="page home-page" id="dm_checklist_error_div" style="display:none;padding:100px;">
			<div><center>Seems like you are not at the location that you are trying to do the DM checklist for. You can only do
			DM checklist when you are at the respective location.<br><br>	 	 	 	 
											 
			If you are at the location and getting this error message, please take a screenshot and email it to 
			<span style="color:blue;"><u>portal@suncommobile.com</u></span><br><br>
			<span> Store Name </span>&nbsp;&nbsp;&nbsp;<span id="s_name"></span><br>
			<span> Current Latitude </span>&nbsp;&nbsp;&nbsp;<span id="s_lat"></span><br>
			<span> Current Longitude </span>&nbsp;&nbsp;&nbsp;<span id="s_longg"></span><br>
			</center></div>
 	 	 	 	 	 
	</div>	
    <div class="page home-page" id="dm_checklist_view_div" style="display:none;">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand">
                  <div class="brand-text brand-big hidden-lg-down"><span>Sun Com Mobile</div>
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
      <div class="page-content d-flex align-items-stretch">
        <div class="content-inner full-width">
          <!-- Dashboard Counts Section-->
          <section class="forms "> 
            <div class="container-fluid">
              <div class="row">
                <!-- Basic Form-->
                <div class="col-lg-12">
                  <div class="card">
                    <!-- <div class="card-header d-flex align-items-center">
                      <h5 class="h5">Basic Details</h5>
                    </div>-->
                    <div class="card-body">
						<table class="table-bordered" width="100%">
						<tr><td id="dm_name">DM Name</td><td id="market">Market</td></tr>
						<tr><td id="store_name">Store Name</td><td id="location_id">Location ID</td></tr>
						<tr><td id="address">Address</td><td id="date_of_vistit">Date of Visit</td></tr>
						</table>
						<table class="table-bordered thead-dark" width="100%">
						<thead><th>KPI Metrics</th><th>Gross Adds</th><th>DTV  Now</th><th>APO</th><th>Protect</th><th>Autopay</th><th>WTR</th></thead>
						<tr><td>Goal</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
						<tr><td>Actual</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
						</table>						
                      	<!--<div class="form-group row" style="margin-bottom:5px;">
						  <label for="example-date-input" class="col-4 col-form-label">Store Name</label>
						  <div class="col-8">
							<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;">Sample</label>							
						  </div>
						</div>					
                       <div class="form-group row" style="margin-bottom:5px;">
						  <label for="example-date-input" class="col-4 col-form-label">Employee Name</label>
						  <div class="col-8">
							<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;">Sample</label>
						  </div>
						</div>
					    <div class="form-group row" style="margin-bottom:5px;">
						  <label for="example-date-input" class="col-4 col-form-label">Submit Time</label> 
						  <div class="col-8">
								<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;">Sample</label>
						  </div>
                     </div>
					    <div class="form-group row" style="margin-bottom:5px;">
						  <label for="example-date-input" class="col-4 col-form-label">Comment</label> 
						  <div class="col-8">
								<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;">Sample</label>
						  </div>
                     </div>	-->					  
                  </div>                 
                </div>
				</div>
                <div class="col-lg-6">
                  <div class="card">
                    <div id= "cash_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-10" style="float:left;">
						<h3 class="h5">Facility</h3>
						</div>
						<div class="col-lg-2" style="float:left;">
						<h3 class="h5">Yes/No</h3>
						</div>
					</div>
                    </div>
					<input type="hidden" value="<?php echo $_REQUEST['sid'];?>" id="s_id" name="s_id" />
                    <div class="card-body text-center" id="facility_view">
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
						</div> -->						
                    </div>
                  </div>	                
				<div class="modal fade" id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:100px;">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						  <h6>Please Wait...</h6>
					  </div>
					  <div class="modal-body">
						<div class="progress">
						  <div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">
							<span class="sr-only">40% Complete (success)</span>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>	
                  <div class="card">
                    <div id= "cash_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-10" style="float:left;">
						<h3 class="h5">Inventory</h3>
						</div>
						<div class="col-lg-2" style="float:left;">
						<h3 class="h5">Yes/No</h3>
						</div>
					</div>
                    </div>
                    <div class="card-body text-center" id="inventory_view">

                    </div>
                  </div>
                  <div class="card">
                    <div id= "cash_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-10" style="float:left;">
						<h3 class="h5">Revenue assurance</h3>
						</div>
						<div class="col-lg-2" style="float:left;">
						<h3 class="h5">Yes/No</h3>
						</div>
					</div>
                    </div>
                    <div class="card-body text-center" id="revenue_view">

                    </div>
                  </div>				  
				</div>
                <div class="col-lg-6">
                  <div class="card">
                    <div id= "cash_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-10" style="float:left;">
						<h3 class="h5">CPOG</h3>
						</div>
						<div class="col-lg-2" style="float:left;">
						<h3 class="h5">Yes/No</h3>
						</div>
					</div>
                    </div>
                    <div class="card-body text-center" id="CPOG_view">

                    </div>
                  </div>
                  <div class="card">
                    <div id= "cash_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-10" style="float:left;">
						<h3 class="h5">Velocity</h3>
						</div>
						<div class="col-lg-2" style="float:left;">
						<h3 class="h5">Yes/No</h3>
						</div>
					</div>
                    </div>
                    <div class="card-body text-center" id="velocity_view">

                    </div>
                  </div>	
                  <div class="card">
                    <div id= "cash_count_disp" class="card-header d-flex align-items-center">
					  <div class="col-lg-12">
						<div class="col-lg-10" style="float:left;">
						<h3 class="h5">Operations</h3>
						</div>
						<div class="col-lg-2" style="float:left;">
						<h3 class="h5">Yes/No</h3>
						</div>
					</div>
                    </div>
                    <div class="card-body text-center" id="operations_view">

                    </div>
                  </div>				  
				</div>
			</div>
			</div>
                <div class="col-lg-12">
                  <div class="card">
                    <!-- <div class="card-header d-flex align-items-center">
                      <h5 class="h5">Basic Details</h5>
                    </div>-->
                    <div class="card-body">
						<table class="table-bordered thead-dark" width="100%">
						<thead><th>Note:</th></thead>
						<tr><td>* Any damaged POP should be requested for replacement through CPOG</td></tr>
						<tr><td>* Any missing demo phones should be requested from supply chain through portal</td></tr>
						<tr><td>* Any missing security bracket(s) should be requested through the portal</td></tr>						
						<tr><td>* Any Missing Items must be submited thru Sun Com Portal.</td></tr>	
						</table>						
					</div>                 
                </div>
				</div>
		</section>
   
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
		
      </div>
	</div>
  </body>
    <!-- Javascript files-->
    <script src="libs/js/tether.min.js"></script>	
    <script src="libs/js/bootstrap.min.js"></script>  
</html>