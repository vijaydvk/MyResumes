<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>

	<script src="js/stores_docs.js"></script>
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
		<h5 class="text-left" style="padding-left:15px;"><u>Store(s) Documents</u></h5>
		<div class="col-md-12">
			<!--<ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="tab_li_a_store_docs" data-toggle="tab" href="#tabStoreDocsViews">Store(s) Documents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_li_a_new_docs" data-toggle="tab" href="#tabNewStoresDocs">New Documents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_li_a_doc_types" data-toggle="tab" href="#tabDocsTypes">Documents Type(s)</a>
                </li>				
            </ul>-->
			<ul class="nav nav-tabs" role="tablist">
			  <li class="nav-item">
				<a class="nav-link active" id="tab_li_a_store_docs" href="#tabStoreDocsViews" role="tab" data-toggle="tab">Store(s) Documents</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="tab_li_a_new_docs" href="#tabNewStoresDocs" role="tab" data-toggle="tab">New Documents</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="tab_li_a_doc_types" href="#tabDocsTypes" role="tab" data-toggle="tab">Document Type(s)</a>
			  </li>
			</ul><br>
        <div class="tab-content">
			<div role="tabpanel" class="content-pane is-active" id="tabStoreDocsViews">
				<ul class="list-group media-list media-list-stream">
				<div class="col-md-12">
					<div class="col-md-12" id="stores_docs_view">
					<table id="view_stores_docs_details" class="display responsive" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Document ID</th>
								<th>Store ID</th>
								<th>Store Name</th>
								<th>Document Type</th>
								<th>File Name</th>
								<th>File Type</th>
								<th>Renewal Date</th>
							</tr>
						</thead>          
					</table> 
					</div>
				</div>
				</ul>
			</div>
			<div role="tabpanel" class="content-pane" id="tabNewStoresDocs">
				<ul class="list-group media-list media-list-stream" id="tab_edit">	
				<div class="row justify-content-center">
				<div class="col-md-6">
					<form name="stores_docs_form" id="stores_docs_form">
					<div class="form-group">
						<label class="control-label">Store Name</label>
						<div>
							<select class="form-control input-lg select_box selectpicker" data-live-search="true" title="--Please Select Store--" name="store_id" id="store_id" style="font-size:11px;" >
							</select>
						</div>
					 </div>
					<div class="form-group">
						<label class="control-label">Document Type</label>
						<div>
							<select class="form-control input-lg select_box selectpicker" data-live-search="true" title="--Please Select Document Type--" name="docs_type" id="docs_type" style="font-size:11px;" >
							</select>
						</div>
					 </div>	
					<div class="form-group">
						<label class="control-label">Document Title</label>
						<div>									
							<input class="form-control input-lg" id="doc_title" name="doc_title">					
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputFile">Select File to Upload</label><br>
						<i class="fa fa-upload" aria-hidden="true" onclick="document.getElementById('doc_file_name').click();"></i><label id="file_name" style="margin-left:5px;"></label>
						<input type="file" class="form-control-file" id="doc_file_name" name="doc_file_name" aria-describedby="fileHelp" style="display:none;" 
						onchange="displayName()">
					 </div>
					<div class="form-group">
						<label class="control-label">File Extension</label>
						<div>									
							<input class="form-control input-lg" id="file_extension" name="file_extension" readonly>					
						</div>
					</div>
					<div class="form-group" id="date_picker">
						<label class="control-label">Renewal date</label>
						<div>									
							<input type="date" class="form-control input-lg" id="renewal_date" name="renewal_date">					
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label">Document Number</label>
						<div>									
							<input class="form-control input-lg" id="doc_number" name="doc_number">					
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
			<div role="tabpanel" class="content-pane" id="tabDocsTypes">
				<ul class="list-group media-list media-list-stream" id="tab_edit" style="height:3800px;">	
				<div class="col-md-12">
					<div class="col-md-12" id="docs_types_view">
					<table id="view_docs_type" class="display responsive" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Document Type</th>
								<th>Status</th>
								<th>Edit</th>
							</tr>
						</thead>          
					</table> 
					</div>
				</div>				
				</ul>
			</div>
		</div>
	</div>
	</div>
	  <div class="modal fade" id="doc_type_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title">New Document Type</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				  <div class="form-group">
					<label class="control-label">Document Type</label>
					<div>									
						<input class="form-control input-lg" id="doc_type" name="doc_type">					
					</div>
				 </div>
				<div class="form-group" id="status_div">
					<label class="control-label">Status</label>
					<div>										
						<label class="custom-control custom-radio">
						  <input id="edit_doc_type_status" name="edit_doc_type_status" type="radio" class="custom-control-input" value="1">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Active</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="edit_doc_type_status" name="edit_doc_type_status" type="radio" class="custom-control-input" value="0">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Inactive</span>
						</label>
					</div>
				 </div>				 
			  <div class="modal-footer">
				<button type="button" id="save_doc_type" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
	</div>
    </div><!-- /.container -->
  </body>
  <script>
  function displayName()
  {
	  var fileName = document.getElementById("doc_file_name").files[0].name;
	  $('#file_name').html(document.getElementById("doc_file_name").files[0].name);
	  var ext = fileName.split('.').pop();
	  $('#file_extension').val(ext);
  }
	$(document).ready(function(){
		var date_input=$('input[name="renewal_date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "#date_picker";
		date_input.datepicker({
		format: "yyyy-mm-dd",
		container: container ,
		todayHighlight: true,
		endDate: '+0d',
		autoclose: true,
		orientation: "left",
		forceParse: false,
		})
		});
  </script>
  <?php
  include_once("footer.php");
  ?>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
</html>
