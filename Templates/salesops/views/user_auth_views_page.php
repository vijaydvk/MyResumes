<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>
	<script src="js/user_auth.js"></script>
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
		<h5 class="text-left" style="padding-left:30px;"><u>URL Access</u></h5>
		<div class="col-md-12">
			<div class="col-md-12" id="user_auth_view">
			<table id="view_user_auth_details" class="display responsive" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Name</th>
						<th>Title</th>
						<th>Edit</th>
					</tr>
				</thead>          
			</table> 
			</div>
		</div>
	  </div>
	  
	  <div class="modal fade" id="user_auth_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title">New User Access</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				  <div class="form-group">
					<label class="control-label">Name</label>
					<div>										
						<select class="form-control input-lg select_box selectpicker" data-live-search="true" title="--Please Select Name--" name="user_name" id="user_name" style="font-size:11px;" >
						</select>
					</div>
				 </div>
				  <div class="form-group">
					<label class="control-label">Title</label>
					<div>
						<select class="form-control input-lg select_box selectpicker" data-live-search="true" title="--Please Select Title--" name="user_title" id="user_title" style="font-size:11px;" >
						</select>
					</div>
				 </div>
			  </div>
			  <div class="modal-footer">
				<button type="button" id="save_user_Auth" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		<script>
				$('#user_name').selectpicker();	
				$('#user_title').selectpicker();					
		</script>
    </div><!-- /.container -->
  </body>
  <?php
  include_once("footer.php");
  ?>
</html>
