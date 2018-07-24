<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>
	<script src="js/settings.js"></script>
    <!-- Custom styles for this template -->
	<style>
	.fa-input {
	  font-family: FontAwesome, 'Helvetica Neue', Helvetica, Arial, sans-serif;
	}
	.buttongreen {
		background-color: #4CAF50; /* Green */
		border: none;
		color: white;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 24px;
		-webkit-transition-duration: 0.4s; /* Safari */
		transition-duration: 0.4s;
		cursor: pointer;
		border-radius: 25px;
	}
	.buttonred {
		background-color: red; /* Green */
		border: none;
		color: white;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 24px;
		-webkit-transition-duration: 0.4s; /* Safari */
		transition-duration: 0.4s;
		cursor: pointer;
		border-radius: 25px;
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
		
		<div class="col-md-12" style="margin-top:5%;" >
			<div id="view_settings_datatables">
			<h5 class="text-left"><u>Settings</u></h5>
			<div class="col-md-12" id="view_order_product_div" style="margin-top:2%;">
			<table id="view_order_product_details" class="display responsive" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Email</th>						
						<th>Created By</th>
						<th>Status</th>
						<th>Edit</th>
					</tr>
				</thead>          
			</table> 
			</div>
			</div>
			<div id="view_settings_email_details" style="display:none;">
			    <a id="back" style="cursor:pointer;"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a>
				<h5 class="text-left" id="product_email_heading"><u>Settings - Ordering Product Email Details</u></h5>
					<div class="col-md-12" id="view_order_product_email_div" style="margin-top:2%;">
					<table id="view_order_product_email_details" class="display responsive" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Email</th>						
								<th>Subject</th>
								<th>Status</th>
								<th>Edit</th>
							</tr>
						</thead>          
					</table> 
					</div>
			</div>			
			<div class="modal fade" id="order_product_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title">Add Product Name</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					  <div class="form-group">
                        <label class="control-label">Product Name</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="product_name" id="product_name" value="">
                        </div>
                    </div>
				  </div>
				  
				  <!--<div class="modal-body">
					  <div class="form-group">
                        <label class="control-label">Email</label>
                        <div class="col-md-12" style="padding:0px;" id="email_parent_div">
						<div>
                          <div class="col-md-10" style="padding:0px;float:left"><input type="text" class="form-control input-lg" name="product_name" id="product_name" value=""></div>
						  <div class="col-md-2" style="padding:0px;float:left;padding-left:5%;padding-top:0%;"><button class="buttongreen buttonadd"><i class="fa fa-plus"></i></button></div>
                        </div>
						</div>
                    </div>
				  </div>-->
				  <div class="modal-footer">
					<button type="button" id="save_product_name" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>
			<!-- Model 2-->
			<div class="modal fade" id="order_product_email_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title">Add Email</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="form-group">
                        <label class="control-label">Email</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="email" id="email" value="">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label">Subject</label>
                        <div>
                            <textarea class="form-control" id="subject" name="subject" rows="3"></textarea>
                        </div>
                    </div>					
				  </div>			  
				  <!--<div class="modal-body">
					  <div class="form-group">
                        <label class="control-label">Email</label>
                        <div class="col-md-12" style="padding:0px;" id="email_parent_div">
						<div>
                          <div class="col-md-10" style="padding:0px;float:left"><input type="text" class="form-control input-lg" name="product_name" id="product_name" value=""></div>
						  <div class="col-md-2" style="padding:0px;float:left;padding-left:5%;padding-top:0%;"><button class="buttongreen buttonadd"><i class="fa fa-plus"></i></button></div>
                        </div>
						</div>
                    </div>
				  </div>-->
				  <div class="modal-footer">
					<button type="button" id="save_product_email" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>
		</div>
	  </div>

    </div><!-- /.container -->
  </body>
  <?php
  include_once("footer.php");
  ?>
</html>
