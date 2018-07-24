<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>
	<script src="js/daily_dashboard.js"></script>
	<link href="css/suncom.css" rel="stylesheet">
    <!-- Custom styles for this template -->
	<style>
.show > .dropdown-menu {
  display: block;
}
.multiselect-container
{
	min-width:240px;
}
.multiselect-clear-filter:before {
    font-family: FontAwesome;
    content: "\f05c";
}
.input-group-addon:before
{
    font-family: FontAwesome;
    content: "\f002";	
}
	  <?php 
		if(isset($_REQUEST['sid']))
		{
	  ?>
		td {
			border: 1px solid black;
			border-bottom:0px;
			border-right:0px;
			text-align:center;
		}
		tr td:last-child {
			border-right: 1px solid black;
		}
		.th_font
		{	
			font-size:14px;
	
		}
		.th_bgcolor_ddd
		{
			background-color:#f2f2f2;
		}
		
	<?php
		}
	?>

	</style>
  </head>

  <body>

  <?php
  include_once("menu.php");
  ?>

    <div class="container">
	
	  <?php 
		if(!isset($_REQUEST['sid']))
		{
	  ?>
		<h5 class="text-left"><u>Dashboard</u></h5>
		<!--<button data-name="Mcclelland (S)" id="navigate">Donna Snider</button>-->

	  <?php
		}
		else
		{
	  ?>
	   <h5 class="text-left"><a id="history_navigate" href="index.php?action=dailydashboard" style="color:black;text-decoration:none;"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a>&nbsp;&nbsp;&nbsp;&nbsp;<u>Dashboard</u> </h5>
	  <?php
		}
	  ?>
		
      <!--<div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div>-->
	  <?php 
		if(!isset($_REQUEST['sid']))
		{
	  ?>
	  <div class="row">
		<div class="col-md-12">
			<div class="col-md-12" id="daily_dashboard_view">
			<table id="view_daily_dashboard_details" class="display responsive" cellspacing="0" width="110%">
				<thead>
					<tr>
						<th>Store Id</th>
						<th>Store Name</th>
						<th>Month_Year</th>
						<th>Address</th>
						<th>View</th>
					</tr>
				</thead>          
			</table> 
			</div>
		</div>
	  </div>
	  <?php
		}
		else
		{
	  ?>
	  <div class="row">
		<div class="col-md-12">
			<div class="col-md-12" id="daily_dashboard_store_view">
			<table id="view_daily_dashboard_store_details" class="display responsive" cellspacing="0" width="100%" style="padding:2px;">
				<thead>
					<tr>
						<th class="text-center " style="border:1px solid black;border-right:0px;width:15px;">MONTHLY</th>
						<th colspan="5" class="text-center " style="border:1px solid black">SALES</th>
						<th colspan="3" class="text-center " style="border:1px solid black;border-left:0px;">REVENUE</th>
						<th colspan="3" class="text-center " style="border:1px solid black;border-left:0px;">RETENTION</th>
						<!--<th colspan="2" class="text-center" style="border:1px solid black;border-left:0px;">Customer Experience</th>-->
					</tr>
					<tr>
						<th class="th_font" style="border:1px solid black;border-top:0px;border-right:0px;"><?php echo date("F");?></th>
						<th class="th_font" style="border-left:1px solid black;border-top:0px solid black;">ADDS</th>
						<th class="th_font" style="border-left:1px solid black;">UPG</th>
						<th class="th_font" style="border-left:1px solid black;">DTV</th>
						<th class="th_font" style="border-left:1px solid black;">GOAL</th>
						<th class="th_font" style="border-left:1px solid black;border-top:0px solid black;">% TO GOAL</th>
						<th class="th_font" style="border-left:1px solid black;">$50 RPM</th>
						<th class="th_font" style="border-left:1px solid black;">ACC/REV</th>
						<th class="th_font" style="border-left:1px solid black;">ACC/OPP</th>
						<th class="th_font" style="border-left:1px solid black;">ABP</th>
						<th class="th_font" style="border-left:1px solid black;">PROTECT</th>
						<!--<th style="border-left:1px solid black;">Reward Rate</th>-->
						<th class="th_font"style="border-left:1px solid black;border-right:1px solid black;">WTR</th>
					</tr>
				</thead>          
			</table> 
			<br><br>
			<table id="view_daily_dashboard_store_details1" class="display responsive" cellspacing="0" width="100%" style="padding:2px;">
				<thead>
					<tr>
						<th class="text-center" style="border:1px solid black;border-right:0px;">DAILY</th>
						<th colspan="5" class="text-center" style="border:1px solid black">SALES</th>
						<th colspan="3" class="text-center" style="border:1px solid black;border-left:0px;">REVENUE</th>
						<th colspan="3" class="text-center" style="border:1px solid black;border-left:0px;">RETENTION</th>
						<!--<th colspan="2" class="text-center" style="border:1px solid black;border-left:0px;">Customer Experience</th>-->
					</tr>
					<tr>
						<th class="th_font" style="border:1px solid black;border-top:0px;border-right:0px;">&nbsp;</th>
						<th class="th_font" style="border-left:1px solid black;border-top:0px solid black;">ADDS</th>
						<th class="th_font" style="border-left:1px solid black;">UPG</th>
						<th class="th_font" style="border-left:1px solid black;">DTV</th>
						<th class="th_font" style="border-left:1px solid black;">GOAL</th>
						<th class="th_font" style="border-left:1px solid black;border-top:0px solid black;">% TO GOAL</th>
						<th class="th_font" style="border-left:1px solid black;">$50 RPM</th>
						<th class="th_font" style="border-left:1px solid black;">ACC/REV</th>
						<th class="th_font" style="border-left:1px solid black;">ACC/OPP</th>
						<th class="th_font" style="border-left:1px solid black;">ABP</th>
						<th class="th_font" style="border-left:1px solid black;">PROTECT</th>
						<!--<th style="border-left:1px solid black;">Reward Rate</th>-->
						<th class="th_font"style="border-left:1px solid black;border-right:1px solid black;">WTR</th>
					</tr>
				</thead>          
			</table> 
			</div>
		</div>
	  </div>
	  <?php
		}
		?>
    </div><!-- /.container -->
  </body>   
  <?php
  include_once("footer.php");
  ?>
   <script src="https://cdn.datatables.net/plug-ins/1.10.16/api/page.jumpToData().js"></script>
</html>
