<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>

	<script src="js/users.js"></script>
	<link href="css/suncom.css" rel="stylesheet">
    <!-- Custom styles for this template -->
	<style>
	.dropdown-menu{
	position:absolute;
	}
	.show > .dropdown-menu {
	  display: block;
	}
	.mfp-content { z-index: 2080 }
	a.disabled {
	   pointer-events: none;
	   cursor: default;
	}
	.tab-content {
	  position: relative;
	  overflow: hidden;
	}
	.tab-content.is-animating {
	  position: absolute;
	  top: 0;
	  left: 15px;
	  right: 15px;
	  width: auto;
	}

	.content-pane {
	  position: absolute;
	  top: 0;
	  left: 0;
	  right: 0;
	  margin: 0;
	  width: 100%;
	  opacity: 0;
	  -webkit-transform: translateY(100%);
			  transform: translateY(100%);
	}
	.content-pane.is-active {
	  position: relative;
	  opacity: 1;
	  -webkit-transform: translateY(0%);
			  transform: translateY(0%);
	}
	.content-pane.is-exiting {
	  opacity: 0;
	  -webkit-transform: translateX(-100%) rotateY(90deg);
			  transform: translateX(-100%) rotateY(90deg);
	}
	.content-pane.is-animating {
	  -webkit-transition: opacity 900 ease-out, -webkit-transform 900ms ease-out;
	  transition: opacity 900ms ease-out, -webkit-transform 900ms ease-out;
	  transition: opacity 900ms ease-out, transform 900ms ease-out;
	  transition: opacity 900ms ease-out, transform 900ms ease-out, -webkit-transform 900ms ease-out;
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
		<h5 class="text-left" style="padding-left:15px;"><u>Manage Users</u></h5>
		<div class="col-md-12">
			<ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="tab_li_a_list" data-toggle="tab" href="#tabUsersViews">User List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" id="tab_li_a_edit" data-toggle="tab" href="#tabEditUsers" disabled>Edit User</a>
                </li>
            </ul><br>
        <div class="tab-content">
			<div role="tabpanel" class="content-pane is-active" id="tabUsersViews">
				<ul class="list-group media-list media-list-stream">
				<div class="col-md-12">
					<div class="col-md-12" id="users_view">
					<table id="view_users_details" class="display responsive" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Employee Name</th>
								<th>Mail</th>
								<th>Role</th>
								<th>Status</th>
								<th>Phone Number</th>
								<th>Store</th>
								<th>Edit</th>
							</tr>
						</thead>          
					</table> 
					</div>
				</div>
				</ul>
			</div>
			<div role="tabpanel" class="content-pane" id="tabEditUsers" class="display:none;">
				<ul class="list-group media-list media-list-stream" id="tab_edit" style="height:3800px;">	
				<div class="row justify-content-center">
				<div class="col-md-6">
					<form name="user_edit_form" id="user_edit_form">
					<div class="form-group">
						<label class="control-label" id="employee_name">Employee Name :</label>
					 </div>
					<div class="form-group">
						<label class="control-label">Status</label>
						<div>										
							<label class="custom-control custom-radio">
							  <input id="edit_user_status" name="edit_user_status" type="radio" class="custom-control-input" value="1">
							  <span class="custom-control-indicator"></span>
							  <span class="custom-control-description">Active</span>
							</label>
							<label class="custom-control custom-radio">
							  <input id="edit_user_status" name="edit_user_status" type="radio" class="custom-control-input" value="0">
							  <span class="custom-control-indicator"></span>
							  <span class="custom-control-description">Block</span>
							</label>
						</div>
					 </div>
					 <button style="margin-bottom:1rem;" type="button" class="btn btn-primary btn-md btn-block" id="BtnClearPortalLock" data-uid="">Clear Portal Lock</button>
					  <div class="form-group">
						<label class="control-label">Store(s)</label>
						<div>
							<select class="form-control input-lg select_box selectpicker" data-live-search="true" title="--Please Select Store--" name="edit_user_store" id="edit_user_store" style="font-size:11px;" >
							</select>
						</div>
					 </div>
					 </form>
				  </div>
				  </div>
				  <!--<div class="alert alert-danger" role="alert" id="delete_alert" style="margin:5px;padding:5px">
					  <p class="text-center" style="padding:0px;margin:0px;">Make sure store list is empty</p>
				  </div>-->
				  <div class="modal-footer">
					<button type="button" id="save_users_details" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-secondary" id="back_users_details">Back</button>
				  </div>				
				</ul>
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
