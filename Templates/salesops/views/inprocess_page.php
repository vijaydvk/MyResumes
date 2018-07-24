<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>
    <!-- Bootstrap core CSS -->
    <script src="js/ticket_inprocess.js"></script>
	<script src="js/global_search.js"></script>
    <!-- Custom styles for this template -->
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
		<div class="col-md-12">
			<div class="col-md-12" id="Admin_view">
			<table id="view_tickets_assigned" class="display responsive" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>TicektID</th>
						<th>Store</th>
						<th>Submitted By</th>
						<th>Category</th>
						<th>Employee Commnet</th>
						<th>Submit Time</th>
						<th>Status</th>	
						<!--<th>Comment</th>-->
					</tr>
				</thead>          
			</table> 
			</div>
		</div>
		<div class="col-md-12">
			<div id="view_assigned_ticketDetails" style="width:100%;z-index:2000;" class="modal col-md-12" data-easein="bounce" tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
				<div class="modal-dialog col-md-12" style="max-width:1100px;">
					<div class="modal-content col-md-12">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-left:100%">
								×
							</button>
							<!--<h4 class="modal-title">
								Modal Header
							</h4>-->
						</div>
						<div class="modal-body">
							<table id="edit_tickets_assigned" class="display responsive" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>TicektID</th>
										<th>Store</th>
										<th>Submitted By</th>
										<th>Category</th>
										<th>Contact Person</th>
										<th>Store Phone</th>
										<th>Employee Commnet</th>
										<th>Submit Time</th>
										<th>Status</th>	
										<!--<th>Comment</th>-->
									</tr>
								</thead>          
							</table> 
							<div class="col-md-12">
								<div class="col-md-7" style="float:left;">
									<h3> Notes </h3>
									<div class="col-md-12" id="ticket_notes">
									<!--<table id="edit_ticket_notes" class="display responsive" cellspacing="0" style="white-space: pre-line;max-width:500px;">
										<thead>
											<tr>
												<th >Notes</th>													
												<th>Comment</th>
											</tr>
										</thead>          
									</table> -->
									</div>
								</div>
								<div class="col-md-5" style="float:left;">
									<div class="col-md-3">Notes</div>
									<div class="col-md-12" style="width:100%"><textarea style="width:100%;height:125px;" id="edit_ticket_note"></textarea></div>
									<div class="col-md-12" >
										<select class="col-md-12" style="margin-top:10px;" id="edit_ticket_status_category"></select>
									</div>
									<div class="col-md-6" style="margin-top:10px;float:left;"><button class="col-md-12" id="edit_ticket_submit" > Submit </button></div>
									<div class="col-md-6" style="margin-top:10px;float:left"><button class="col-md-12" id="edit_ticket_clear" > Clear </button></div>
									<input type="hidden" id="login_user_id" value="<?php echo $_SESSION['uid']; ?>" />
								</div>
							</div>
						</div>
						<!--<div class="modal-footer">
							<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
								Close
							</button>
							<button class="btn btn-primary">
								Save changes
							</button>
						</div>-->
					</div>
				</div>
			</div>
		</div>
		
	  </div>

    </div>
	<!-- /.container -->
  </body>
  <?php
  include_once("footer.php");
  ?>
</html>
