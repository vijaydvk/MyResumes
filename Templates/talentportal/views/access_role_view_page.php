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
	<script src="js/access_role_settings.js"></script>
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
							<h3 style="padding:15px;padding-top:0px;">Settings - Button Access Role</h3>
                            <div class="col-lg-12" id="applicant_view_list_div">
							<div class="alert alert-success" id="success-alert" style="display:none;">
							  Data has been Updated successfully...
							</div>
                                <div class="table-responsive table--no-card m-b-30" style="border-radius:0px;">
                                    <table class="table table-borderless table-striped table-earning" id="view_access_role_settings">
                                        <thead>
                                            <tr>
                                                <th>Setting Name</th>
												<th>Role</th>
												<th>Created By</th>
												<th>Status</th>
												<th>Edit</th>
                                            </tr>
                                        </thead>
                                     </table>
                                </div>
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
				<div class="modal fade" id="new_access_role_modal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="application_change_head">New Access Role</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
								<div class="modal-body" id="application_cahnge_status_body">
									<div class="col-md-12">
										<div class="row form-group">
											<div class="col-12 col-md-5">
												<label class=" form-control-label">Role</label>
											</div>
												<div class="col-12 col-md-7">
                                                    <select name="role_dropdown" id="role_dropdown" class="form-control-sm form-control">
                                                    </select>
                                                </div>
										</div>
									</div>	
									<div class="col-md-12">
										<div class="row form-group">
											<div class="col-12 col-md-5">
												<label class=" form-control-label">Setting Name</label>
											</div>
												<div class="col-12 col-md-7">
                                                    <select name="setting_name_dropdown" id="setting_name_dropdown" class="form-control-sm form-control">
                                                    </select>
                                                </div>
										</div>
									</div>	
									<div class="col-lg-12" id="access_role_danger_div" style="display:none;">
										<div class="alert alert-danger" id="access_role_danger" style="text-align:center;">
												
										</div>
									</div>
								</div>
							<div class="modal-footer" id="application_steps_footer">
								<button type="button" id="access_role_save" class="btn btn-primary">Save</button>
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

</body>

</html>
<!-- end document-->