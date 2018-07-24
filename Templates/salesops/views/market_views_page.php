<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>
	<script src="js/market.js"></script>
	<link href="css/suncom.css" rel="stylesheet">
    <!-- Custom styles for this template -->
	<style>
		.show > .dropdown-menu {
		  display: block;
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
		<h5 class="text-left" style="padding-left:30px;"><u>Market</u></h5>
		<div class="col-md-12">
			<div class="col-md-12" id="market_view">
			<table id="view_market_details" class="display responsive" cellspacing="0" width="100%">
				<thead>
					<tr>
						<!--<th>Market ID</th>-->
						<th>Market Name</th>
						<th>Region Name</th>
						<th>Edit</th>
					</tr>
				</thead>          
			</table> 
			</div>
		</div>
	  </div>
	  
	  <div class="modal fade" id="market_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title">New Market</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				  <div class="form-group">
					<label class="control-label">Market Name</label>
					<div>										
						<select class="form-control input-lg select_box selectpicker" data-live-search="true" title="--Please Select Market--" name="market_name" id="market_name" style="font-size:11px;" >
						</select>
					</div>
				 </div>
				  <div class="form-group">
					<label class="control-label">Region Name</label>
					<div>
						<select class="form-control input-lg select_box selectpicker" data-live-search="true" title="--Please Select RD--" name="region_name" id="region_name" style="font-size:11px;" >
						</select>
					</div>
				 </div>
				<!-- <div class="form-group">
					<label class="control-label">Store(s)</label>
					<div>
						<select class="form-control select_box selectM" name="store_district_id[]" id="store_district_id" style="height:65px;font-size:11px;" multiple>
						</select>
					</div>
				 </div>-->
			  </div>
			  <div class="alert alert-danger" role="alert" id="regiondelete_alert" style="margin:5px;padding:5px;display:none;">
				  <p class="text-center" style="padding:0px;margin:0px;">Make sure region name is empty</p>
			  </div>
			  <div class="modal-footer">
				<button type="button" id="save_market_details" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		<script>
				$('#market_name').selectpicker();	
				$('#rd_name').selectpicker();					
		</script>
    </div><!-- /.container -->
  </body>
  <?php
  include_once("footer.php");
  ?>
</html>
