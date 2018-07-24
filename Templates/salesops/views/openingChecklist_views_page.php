<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>
	<script src="js/opening_checklist.js"></script>
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
		<h5 class="text-left" style="padding-left:30px;"><u>Opening CheckList</u></h5>
		<div class="col-md-12">
			<div class="col-md-12" id="opening_checklist_view">
			<table id="view_opening_checklist_details" class="display responsive" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Question</th>
						<th>Status</th>
						<th>Edit</th>
					</tr>
				</thead>          
			</table> 
			</div>
		</div>
	  </div>
	  
	  <div class="modal fade" id="opening_checklist_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title">New Question</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				  <div class="form-group">
					<label class="control-label">Question</label>
					<div>										
						<input class="form-control input-lg" id="question" name="question"></input>
					</div>
				 </div>
			  </div>
			  <div class="modal-footer">
				<button type="button" id="save_opening_checklist" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
