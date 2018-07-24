<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>

	<script src="js/export_stores.js"></script>
	<link href="css/suncom.css" rel="stylesheet">
    <!-- Custom styles for this template -->
	<style>
	.show > .dropdown-menu {
	  display: block;
	}
	.mfp-content { z-index: 2080 }
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
		<h5 class="text-left" style="padding-left:30px;"><u>Export Store Masterlist</u></h5>
		<div class="col-md-12">
			<div class="col-md-12" id="region_view">
			<table id="export_stores_details" class="display responsive" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Region</th>
						<th>Market</th>
						<th>District</th>
						<th>Store Id</th>
						<th>Store Name</th>
						<th>RQ Store Name</th>
						<th>Store Email</th>
						<th>Store Address</th>
						<th>Store City</th>
						<th>Store State</th>
						<th>Store Zip</th>
						<th>Store Phone</th>
						<th>Store UID</th>
					</tr>
				</thead>          
			</table> 
			</div>
		</div>
	  </div>
	  
		
    </div><!-- /.container -->
  </body>
  <?php
  include_once("footer.php");
  ?>
</html>
