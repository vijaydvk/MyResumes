<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>

	<script src="js/stores.js"></script>
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
		<h5 class="text-left" style="padding-left:30px;"><u>Stores</u></h5>
		<div class="col-md-12">
			<div class="col-md-12" id="region_view">
			<table id="view_stores_details" class="display responsive" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Store Name</th>
						<th>Address</th>
						<th>Phone Number</th>
						<th>District Name</th>
						<th>Store Image</th>
						<th>Edit</th>
					</tr>
				</thead>          
			</table> 
			</div>
		</div>
	  </div>
	  <div class="modal fade" id="stores_model" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title">New Store</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <form id="stores_form" name="stores_form" >
			  <div class="modal-body row">				
				<div class="col-lg-6">
					<div class="form-group">
						<label class="control-label">Store ID</label>
						<div>										
							<input class="form-control input-lg" id="store_id" name="store_id"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Store Name</label>
						<div>										
							<input class="form-control input-lg" id="store_name" name="store_name"></input>
						</div>
				    </div>
					<div class="form-group">
						<label class="control-label">Store Address</label>
						<div>										
							<textarea class="form-control" id="store_address" name="store_address" style="height:125px;"></textarea>
						</div>
					 </div>
					 <div class="form-group">
						<label class="control-label">Store Email</label>
						<div>										
							<input class="form-control input-lg" id="store_email" name="store_email" ></input>
						</div>
					 </div>	
					  <div class="form-group">
						<label class="control-label">Store Phone</label>
						<div>										
							<input class="form-control" id="store_phone" name="store_phone"></input>
						</div>
					 </div>
					 <script>
							$(document).ready(function() 
								{
								   var phones = [{ "mask": "(###) ###-####"}];
									$('#store_phone').inputmask({
										mask: phones, 
										greedy: false, 
										definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
								});
					</script>
					
				</div>
				 <div class="col-lg-6">
					 <div class="form-group">
						<label class="control-label">Store UID</label>
						<div>										
							<input class="form-control input-lg" id="store_uid" name="store_uid" readonly></input>
						</div>
					 </div>	
					 <div class="form-group">
						<label class="control-label">RQ Store Name</label>
						<div>										
							<input class="form-control input-lg" id="rq_store_name" name="rq_store_name"></input>
						</div>
				    </div>
					<div class="form-group">
						<label class="control-label">Store State</label>
						<div>										
							<select class="form-control input-lg select_box selectpicker" data-live-search="true" title="--Please Select State--" name="store_state" id="store_state" style="font-size:11px;" >
							</select>
						</div>
					 </div>
					 <div class="form-group">
						<label class="control-label">Store City</label>
						<div>										
							<input class="form-control" id="store_city" name="store_city"></input>
						</div>
					 </div>
					 <div class="form-group">
						<label class="control-label">Store Zip</label>
						<div>										
							<input class="form-control" id="store_zip" name="store_zip" ></input>
						</div>
					 </div>
					<div class="form-group">
						<label class="control-label">Store District</label>
						<div>										
							<select class="form-control input-lg select_box selectpicker" data-live-search="true" title="--Please Select District--" name="store_district_id" id="store_district_id" style="font-size:11px;" >
							</select>
						</div>
					</div>
					
				</div>

					<div class="col-lg-6">
					<div class="form-group" id="store_image_div">
						<label class="control-label" for="store_image">Store Image</label>
						<div class="col-lg-12"> 
							  <i class="fa fa-upload" aria-hidden="true" onclick="document.getElementById('store_image').click();"></i>
							  <input type="file" id="store_image" name="store_image" value="" accept="image/jpeg" required style="display:none;">
							  <span>*JPG Files only allowed</span>
						</div>
					</div>
					</div>
					<div class="col-lg-6" id="popup_store_image">
					<div class="parent-container"><a id="a_magnific" href="" ></a></div>
						<img src="" style="height:75px;width:75px;display:none;" id="store_image_view" alt="No image" data-toggle="tooltip" data-placement="top" title="Click to View Image" ></img>
					</div>

			  </div>  
			  <!--<div class="alert alert-danger" role="alert" id="delete_alert" style="margin:5px;padding:5px">
				  <p class="text-center" style="padding:0px;margin:0px;">Make sure store list is empty</p>
			  </div>-->
			  <div class="modal-footer">
				<button type="button" id="save_store_details" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			  </form>
			</div>
		  </div>
		</div>
		<script>
				$('#region_name').selectpicker();					
		</script>
    </div><!-- /.container -->
  </body>
  <?php
  include_once("footer.php");
  ?>
</html>
