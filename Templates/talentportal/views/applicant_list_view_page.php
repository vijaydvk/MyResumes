<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Sun Com Mobile - Talent Portal</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>	
	<script src="js/applicant_list.js"></script>
	<style>
	.account2
	{
		padding:5px!important;
	}
	th{
		padding:5px!important;
	}
	td{
		padding:5px!important;
	}	
	.col-lg-6
	{
		float:left;
		padding:10px;
	}
.border-center { 
            width: 100%;
            position: relative;
			padding:0px;
			
        }

.border-center:before { content: '';
        position: absolute;
        bottom: 70%;
        border-bottom: 2px rgb(31,174,154) solid;
        width: 100%;
        z-index:-100;
    }	
	@media screen and (max-width: 600px) {
		.header-wrap2
		{
			display:block;
		}
	}
	@media screen and (min-width: 600px) {
		.header-wrap2
		{
			display:none;
		}
	}	
	</style>	

</head>

<body class="animsition">
    <div class="page-wrapper">
	<?php include_once("side_menu.php"); ?>
	<input type="hidden" id="action" value="<?php echo $_GET["action"];?>" />
	<input type="hidden" id="rid" value="<?php echo $_SESSION["rid"];?>" />
        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
								<a href="index.php?action=login">
									<h4 style="color:white;">Sun Com Mobile</h4>
								</a>
                           <div class="header-button2" style="float:right;">
                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                </div>
                            </div>								
                            </div>
 
                        </div>
                    </div>
                </div>
            </header>
			<?php require_once("mobile_menu.php");?>
            <!-- END HEADER DESKTOP-->

            <!-- BREADCRUMB-->
            <div class="main-content" style="font-size:15px;">
                <div class="section__content section__content--p30" style="padding:0px;">
                    <div class="container-fluid">
                        <div class="row">
							<h3 style="padding:15px;padding-top:0px;">Applicant List</h3>
                            <div class="col-lg-12" id="applicant_view_list_div">
							<div class="alert alert-success" id="success-alert" style="display:none;">
							  Data has been Updated successfully...
							</div>
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning" id="view_applicant_list">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
												<th>Possible closeby<br>store</th>
												<th>Viewed</th>
                                                <th>Phone NO</th>
                                               <!-- <th>Email</th>-->
                                                <th>Zip Code</th>
												<th>Applied Date</th>
                                                <!--<th>Resume</th>-->
                                                <th>Pre screen<br>Questions </th>
												<th>Like</th>
												<th>Liked List</th>
                                            </tr>
                                        </thead>
                                     </table>
                                </div>
                            </div>
                            <div class="col-lg-12" id="applicant_unique_view_div" style="display:none;">
								<h5 id="unique_back" style="cursor:pointer;"><< BACK </h5>
								<div class="alert alert-success" id="applicant_unique_head" style="text-align:center;">
									Applicant Name Detail View
								</div>
								<div class="col-md-12" style="padding:0px;">
									<div class="card">
										<div class="card-header">
											<i class="zmdi zmdi-settings"></i>
											<strong class="card-title" v-if="headerText">Application Steps</strong>
										</div>
										<div class="card-body" id="process_steps">
										</div>
									</div>
								</div>								
								<div class="col-lg-12" id="applicant_steps_div" style="display:none;">
									<div class="alert alert-success" id="applicant_steps_head" style="text-align:center;">
											Data has been updated successfully
									</div>
								</div>	
								<div class="col-lg-12" id="applicant_steps_div_error" style="display:none;">
									<div class="alert alert-danger" id="applicant_steps_head" style="text-align:center;">
											Already Updated!!!
									</div>
								</div>		
								<div class="col-lg-12" style="padding:0px;min-height:260px;" >
									<div class="col-lg-4" style="float:left;;padding-left:0px;">
											<div class="col-md-12" style="padding:0px;">
												<div class="card">
													<div class="card-header">
														<i class="zmdi zmdi-account-calendar"></i>
														<strong class="card-title" v-if="headerText">Applicant data</strong>
													</div>
													<div class="card-body">
														<div class="col-lg-6">Name</div>
														<div class="col-lg-6" id="app_name"></div>
														<div class="col-lg-6">Zip</div>
														<div class="col-lg-6" id="app_addr"></div>		
														<div class="col-lg-12" id="button_rights_div" style="padding:0px;">
															<button type="button" id="status_change_popup_button" class="btn btn-primary btn-md" style="margin:5px;padding:5px;font-size:inherit;display:block;float:left;"><i class="fas fa-check-circle"></i></button>
															<button type="button" id="position_change_popup_button" class="btn btn-primary btn-md" style="margin:5px;padding:5px;font-size:inherit;display:block;float:left"><i class="fas fa-briefcase"></i></button>
															<button type="button" id="reference_change_popup_button" class="btn btn-primary btn-md" style="margin:5px;padding:5px;font-size:inherit;display:block;float:left"><i class="fas fa-user"></i></button>														
															<button type="button" id="loc_change_popup_button" class="btn btn-primary btn-md" style="margin:5px;padding:5px;font-size:inherit;display:block;float:left;"><i class="fas fa-location-arrow"></i></button>
														</div>											
													</div>
												</div>
											</div>	
									</div>
									<div class="col-lg-4" style="float:left;">
										<div class="col-md-12" style="padding:0px;">
											<div class="card">
												<div class="card-header">
													<i class="zmdi zmdi-store-24"></i>
													<strong class="card-title" v-if="headerText">Store Applied For</strong>
												</div>
												<div class="card-body" style="min-height:173px;">
													<div class="col-lg-6">Store Name</div>
													<div class="col-lg-6" id="store_name"></div>
													<div class="col-lg-12"></div>											
												</div>
											</div>
										</div>										
									</div>
									<div class="col-lg-4" style="float:left;">
										<div class="col-md-12" style="padding:0px;">
											<div class="card">
												<div class="card-header">
													<i class="zmdi zmdi-settings"></i>
													<strong class="card-title" v-if="headerText">Approval Steps</strong>												
												</div>
												<div class="card-body" style="min-height:170px;" id="approval_steps_div">
																							
												</div>
											</div>
										</div>										
									</div>
								</div>
								<div class="col-lg-12" style="padding:0px;">
										<div class="col-lg-4" style="float:left;padding:0px;padding-right:15px;">
											<div class="col-md-12" style="padding:0px;">
												<div class="card">
													<div class="card-header">
														<i class="zmdi zmdi-file"></i>
														<strong class="card-title" v-if="headerText">Applicant documents</strong>
													</div>
													<div class="card-body" style="min-height:173px;">
											<div id="div_resume_div">								
											</div>											
											<div class="col-lg-12">
												<div style="float:right;"><button class="btn btn-primary btn-xs upload_button" style="padding:3px 5px;font-size:12px;"><i class="zmdi zmdi-upload" id="" style="padding:5px;backgroud:#f2f2f2;"></i></button>
												<button type="button" id="save_resume" data-applicant_id="" class="btn btn-primary btn-xs" style="padding:5px;font-size:12px;">Save</button>
												<input style="border:0!important;display:none;" class="input-file" name="resume_uploads" id="resume_uploads" type="file" accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/png,image/jpeg,text/plain,application/rtf,application/pdf,"></div>
												<p id="resume_txt" style="font-size:12px;float:right;padding-right:5px;"></p>
											</div>											
													</div>
												</div>
											</div>										
										</div>	
										<div class="col-lg-4" style="float:right;">
											<div class="col-md-12" style="padding:0px;">
												<div class="card">
													<div class="card-header">
														<i class="zmdi zmdi-settings"></i>
														<strong class="card-title" v-if="headerText">Hiring Steps</strong>												
													</div>
													<div class="card-body" style="min-height:170px;" id="hiring_steps_div">
														<div class="col-md-12 table-responsive m-b-40" style="margin-top:5px;padding:0px;font-size:12px;">
															<table class="table table-borderless table-striped table-earning" id="append_hiring_details"></table>
														</div>
														<div class="col-md-12" style="margin-top:5px;">
															<div class="row form-group">
																<div class="col col-md-4" style="padding:0px;">
																	<label class=" form-control-label">Hiring Step</label>
																</div>
																<div class="col-8 col-md-8" style="padding:0px;">
																	<select name="select_hiring_step" id="select_hiring_step" style="padding:0px 5px;width:100%;">
																		<option value="">-- Please Select One --</option>
																	</select>
																</div>
															</div>
														</div>		
														<div class="col-md-12">
																<center>
																	<button class="btn btn-primary btn-xs" id="hiring_step_save" style="padding:5px 5px;font-size:12px;margin:20px;">Save</button>
																	<button class="btn btn-secondary btn-xs" id="hiring_step_clear" style="padding:5px 5px;font-size:12px;">Clear</button>
																<center>
														</div>
														<div class="col-md-12">
														<div class="alert alert-danger" id="hiring_step_danger" style="text-align:center;display:none;padding:5px;">
																Hiring Step must be provided
														</div>
														<div class="alert alert-success" id="hiring_step_success" style="text-align:center;display:none;padding:5px;">
																Data has been updated successfully
														</div>														
														</div>														
													</div>
												</div>
											</div>										
										</div>										
								</div>
								<!--<div class="col-lg-4" style="border:1px solid black;float:left;">
										<div class="col-lg-6" style="float:left;">
										</div>
										<div class="col-lg-6" style="float:left;">
										</div>									
								</div>
								<div class="col-lg-4" style="border:1px solid black;float:left;">
										<div class="col-lg-6" style="float:left;">
										</div>
										<div class="col-lg-6" style="float:left;">
										</div>									
								</div>	-->							
                            </div>	
								<div class="col-lg-12" id="applicant_unique_head_div" style="display:none;">
									<div class="alert alert-success" id="applicant_unique_head" style="text-align:center;">
											Data has been updated successfully
									</div>
								</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END BREADCRUMB-->

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2018 Sun Com Mobile</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END PAGE CONTAINER-->
							<!-- modal large -->
								<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="largeModalLabel">Prescreen Question & Answer</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body" id="prescreen_Q">
											
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>	
								<div class="modal fade" id="likedModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-md" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="largeModalLabel">Liked Details</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body" id="liked_div_top">
												<div class="col-md-12">
												<table class="table table-borderless table-striped table-earning" id="view_applicant_like">
													<thead>
														<tr>
															<th>Name</th>
															<th>Liked/Disliked</th>
														</tr>
													</thead>
												 </table>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>	
								<div class="modal fade" id="change_location_modal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-md" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="largeModalLabel">Change Applicant Location</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body" id="liked_div_top">
												<div class="col-md-12">
													<div class="row form-group">
														<div class="col col-md-3">
															<label class=" form-control-label">Store</label>
														</div>
														<div class="col-12 col-md-9">
															<select name="select_store" id="select_store" class="form-control">
															</select>
														</div>
													</div>
												</div>
									<div class="col-lg-12" id="location_unique_head_div" style="display:none;">
										<div class="alert alert-success" style="text-align:center;">
												Store Name must be provided
										</div>
									</div>												
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-primary" id="save_location_button">Save</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>	
								<div class="modal fade" id="application_steps" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-md" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="application_steps_head"></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form name="application_steps_form" id="application_steps_form">
												<div class="modal-body" id="application_steps_body">
												</div>
											</form>
											<div class="modal-footer" id="application_steps_footer">
												<button type="button" id="application_steps_save" class="btn btn-primary">Save</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>												
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade" id="application_change_status" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-md" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="application_change_head">Applicant Status</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
												<div class="modal-body" id="application_cahnge_status_body">
													<div class="col-md-12">
														<div class="row form-group">
															<div class="col col-md-3">
																<label class=" form-control-label">Status</label>
															</div>
															<div class="col-12 col-md-9">
																<div class="form-check">
																	<div class="radio">
																		<label for="radio1" class="form-check-label ">
																			<input id="status_change" name="status_change" value="1" class="form-check-input" type="radio">Active																			
																		</label>
																	</div>
																	<div class="radio">
																		<label for="radio2" class="form-check-label ">
																			<input id="status_change" name="status_change" value="0" class="form-check-input" type="radio">Inactive
																		</label>
																	</div>
																</div>
															</div>
														</div>
													</div>												
												</div>
											<div class="modal-footer" id="application_steps_footer">
												<button type="button" id="application_status_save" class="btn btn-primary">Save</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>												
											</div>
										</div>
									</div>
								</div>	
								<div class="modal fade" id="application_change_position" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-md" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="application_change_head">Applicant Job Position</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
												<div class="modal-body" id="application_cahnge_status_body">
													<div class="col-md-12">
														<div class="row form-group">
															<div class="col col-md-3">
																<label class=" form-control-label">Position</label>
															</div>
															<div class="col-12 col-md-9">
																<div class="form-check">
																	<div class="radio">
																		<label for="radio1" class="form-check-label ">
																			<input id="status_job_position" name="status_job_position" value="22" class="form-check-input" type="radio">Retail Sales Consultant																			
																		</label>
																	</div>
																	<div class="radio">
																		<label for="radio2" class="form-check-label ">
																			<input id="status_job_position" name="status_job_position" value="24" class="form-check-input" type="radio">Retail Store Manager
																		</label>
																	</div>
																</div>
															</div>
														</div>
													</div>												
												</div>
											<div class="modal-footer" id="application_steps_footer">
												<button type="button" id="application_position_save" class="btn btn-primary">Save</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>												
											</div>
										</div>
									</div>
								</div>	
								<div class="modal fade" id="application_change_reference" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-md" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="application_change_head">Applicant Job Position</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
												<div class="modal-body" id="application_cahnge_reference_body">
													<div class="col-md-12">
														<div class="row form-group">
															<div class="col col-md-3">
																<label for="firstname-input" class=" form-control-label">First Name</label>
															</div>
															<div class="col-12 col-md-9">
																<input id="reference_fname" name="reference_fname" placeholder="First Name" class="form-control" type="text">
																<small class="help-block form-text" style="display:none;">Please enter a first name</small>
															</div>
														</div>
													</div>	
													<div class="col-md-12">
														<div class="row form-group">
															<div class="col col-md-3">
																<label for="lastname-input" class=" form-control-label">Last Name</label>
															</div>
															<div class="col-12 col-md-9">
																<input id="reference_lname" name="reference_lname" placeholder="Last Name" class="form-control" type="text">
																<small class="help-block form-text" style="display:none;">Please enter a last name</small>
															</div>
														</div>
													</div>	
													<div class="col-md-12">
														<div class="row form-group">
															<div class="col col-md-3">
																<label for="phno-input" class=" form-control-label">Phone No</label>
															</div>
															<div class="col-12 col-md-9">
																<input id="reference_phone" name="reference_phone" placeholder="Phone Number" class="form-control" onkeypress="return isNumberKey(event)" type="text">
																<script>
																function isNumberKey(evt){
																	var charCode = (evt.which) ? evt.which : event.keyCode
																	if (charCode > 31 && (charCode < 48 || charCode > 57))
																		return false;
																	return true;
																}
																</script>
																<small class="help-block form-text" style="display:none;">Please enter a phone number</small>
															</div>
														</div>
													</div>														
												</div>
											<div class="modal-footer" id="application_reference_footer">
												<button type="button" id="application_reference_save" class="btn btn-primary">Save</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>												
											</div>
										</div>
									</div>
								</div>									
        </div>

    </div>

    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="vendor/vector-map/jquery.vmap.js"></script>
    <script src="vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="vendor/vector-map/jquery.vmap.world.js"></script>
    <!-- Main JS-->
    <script src="js/main.js"></script>
	
 	<?php 
	   include_once("dataTables.php");
	   ?> 
	   
	  <!-- <script>
			   // If theres no activity for 5 seconds do something
		var activityTimeout = setTimeout(inActive, 120000);

		function resetActive(){
			$(document.body).attr('class', 'active');
			clearTimeout(activityTimeout);
			activityTimeout = setTimeout(inActive, 120000);
		}

		// No activity do something.
		function inActive(){
			$(document.body).attr('class', 'inactive');
			alert("hi");
		}

		// Check for mousemove, could add other events here such as checking for key presses ect.
		$(document).bind('mousemove', function(){resetActive()});
		
		</script>-->

</body>

</html>
<!-- end document-->