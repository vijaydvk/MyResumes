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
	<script src="js/opening_checklist.js"></script>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<!--[if lt IE 9]>
	<script type="text/javascript" src="libs/flashcanvas.js"></script>
	<![endif]-->
  </head>
  <body>
    <div class="page home-page">
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
            </div>
          </header>-->
          <!-- Dashboard Counts Section-->
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
                      <!--<p>Lorem ipsum dolor sit amet consectetur.</p>-->
                      
					    <!--<div class="form-group row">
						  <label for="example-date-input" class="col-4 col-form-label">Store Location</label>
						  <div class="col-8">
                            <select class="form-control round" id="store_location">
							</select>
						  </div>
						</div>-->
						<input type="hidden" value="<?php echo $_SESSION['record_id']; ?>" id="record_id" />
						<div class="form-group row" style="margin-bottom:5px;">
						  <label for="example-date-input" class="col-4 col-form-label">Store Name</label>
						  <div class="col-8">
							<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;"><?php echo $_SESSION['storename'];?></label>							
						  </div>
						</div>					
                       <div class="form-group row" style="margin-bottom:5px;">
						  <label for="example-date-input" class="col-4 col-form-label">Employee Name</label>
						  <div class="col-8">
							<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;"><?php echo $_SESSION['employeename'];?></label>
						  </div>
						</div>
					    <div class="form-group row" style="margin-bottom:5px;">
						  <label for="example-date-input" class="col-4 col-form-label">Submit Time</label> 
						  <div class="col-8">
								<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;"><?php echo $_SESSION['SubmitTime'];?></label>
						  </div>
                     </div>
					    <div class="form-group row" style="margin-bottom:5px;">
						  <label for="example-date-input" class="col-4 col-form-label">Comment</label> 
						  <div class="col-8">
								<label for="example-date-input" class="col-12 col-form-label" style="padding-left:0px;"><?php echo $_SESSION['comment'];?></label>
						  </div>
                     </div>						  
                  </div>                 
                </div>
				</div>
                <div class="col-lg-6">
                  <div class="card">
                     <div class="card-header d-flex align-items-center">
                      <h5 class="h5">Opening Checklist Report</h5>
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
						<div id="disp_opening_checklist_answer">
						</div>
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