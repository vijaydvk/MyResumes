<!DOCTYPE html>



<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tracking</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>



    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin.php">Suncommobile</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php  echo $_SESSION['user']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li  class="active">
                        <a href="tickets.php"><i class="fa fa-fw fa-bar-chart-o"></i> Tickets</a>
                    </li>
                    <li>
                        <a href="customers.php"><i class="fa fa-fw fa-table"></i> Customers</a>
                    </li>
                  
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading 
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Customers <small>All customers details</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                           <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                            <!--<i class="fa fa-info-circle"></i> --> <strong>Tickets</strong>
							</div>
							
                    </div>
                </div>
                <!-- /.row -->

              <!--  <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">26</div>
                                        <div>New Comments!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">12</div>
                                        <div>New Tasks!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">124</div>
                                        <div>New Orders!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">13</div>
                                        <div>Support Tickets!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> -->
                <!-- /.row -->

              <!--  <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

             <!--   <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Donut Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-donut-chart"></div>
                                <div class="text-right">
                                    <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-4" style="width:30%;padding-left:0px">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i>Filter</h3>
								
                            </div>
							     <div class="
								 -group has-success" style="padding-left:15px;padding-top:10px"><label class="control-label" for="inputSuccess">Ticket Id</label><input type="text" class="form-control" id="name">
													</div>
												
								<div class="form-group has-success" style="padding-left:15px;">
														<label  class="control-label" for="inputSuccess">Background</label>
														<select class="form-control" name="background">
														<option value="Maintanance">Maintanance</option>
														<option value="Operation">Operation</option>
														<option value="AccessoryRequirement">AccessoryRequirement</option>
														<option value="SupplyOrder">SupplyOrder</option>
														<option value="BackgroundCheck">BackgroundCheck</option>
														<option value="Salesoperation">Salesoperation</option>
														<option value="Phoneissues">Phoneissues</option>
														</select>
								</div>
								<div class="form-group  has-success" style="padding-left:15px;">
                                <label  class="control-label" for="inputSuccess">Priority</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">Low
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">Medium
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">High
                                    </label>
                                </div>
								<div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">Critical
                                    </label>
                                </div>
                                </div>	
								<div class="form-group has-success" style="padding-left:15px;">
														<label  class="control-label" for="inputSuccess">Created</label>
														<select class="form-control" name="background">
														<option value="Anytime">Anytime</option>
														<option value="1hr">Within 1 hour</option>
														<option value="6hr">Within 6 hour</option>
														<option value="12hr">Within 12 hour</option>
														<option value="today">Today</option>
														<option value="yesterday">Yesterday</option>
														<option value="thisweek">ThisWeek</option>
														<option value="7day">Last7Days</option>
														</select>
								</div>
								<div class="form-group  has-success" style="padding-left:15px;">
								<button type="submit" class="btn btn-primary">Search</button>
								</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-ticket fa-fw"></i>New Ticket</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
								  <form action="addmail.php" method="post"  enctype="multipart/form-data" accept-charset='UTF-8'>
                                    <table class="table table-bordered table-hover table-striped">
                                        <tbody>
                                            <tr>
                                                <td><div class="form-group has-success"><label class="control-label" for="inputSuccess"><i class="fa fa-group fa-fw"></i>E-Mail</label><input type="text" class="form-control" id="mail" name="mail">
												

													</div>
												</td>

                                            </tr>
                                            <tr>
                                                <td><div class="form-group has-success"><label class="control-label" for="inputSuccess"><i class="fa fa-user fa-fw"></i>Group </label>
												<select class="form-control" name="group">
														<option value="accessories">Accessories</option>
														<option value="backgrounds">Backgrounds</option>
														<option value="maintenance">Maintenance</option>
														<option value="salesops">Sales OPS</option>
														<option value="storesupplies">Store Supllies</option>
														</select>
													</div>
												</td>
                                            </tr>
											<tr>
                                                <td><div class="form-group has-success"><label class="control-label" for="inputSuccess"><i class="fa fa-envelope-o fa-fw"></i>Subject</label><input type="text" class="form-control" id="subject" name="subject">
													</div>
												</td>
                                            </tr>
											<tr>
                                                <td><div class="form-group has-success"><label class="control-label" for="inputSuccess"><i class="fa fa-file-o fa-fw"></i>Type </label>
												<select class="form-control" name="type">
														<option value="accessories">Question</option>
														<option value="backgrounds">Incident</option>
														<option value="maintenance">Problem</option>
														<option value="salesops">Feature Request</option>
														<option value="storesupplies">Lead</option>
														</select>
													</div>
												</td>
                                            </tr>
										    <tr>
                                                <td><div class="form-group has-success"><label class="control-label" for="inputSuccess">Priority </label>
												<select class="form-control" name="priority">
														<option value="low">Low</option>
														<option value="medium">Medium</option>
														<option value="high">High</option>
														<option value="critical">Critical</option>
														</select>
													</div>
												</td>
                                            </tr>
                                            <tr>
                                                <td><div class="form-group has-success"><label class="control-label" for="inputSuccess"><i class="fa fa-user fa-fw"></i>Agent </label>
												<select class="form-control" name="agent">
														<option value="accessories">Accessories</option>
														<option value="backgrounds">Backgrounds</option>
														<option value="maintenance">Maintenance</option>
														<option value="edgarlopez">Edgar lopez</option>
														<option value="phoneissues">Phone Issues</option>
														<option value="sreejith">Sreejith</option>
														<option value="supplies">Supplies</option>
														<option value="supplies">Tim Riesman</option>
														</select>
													</div>
												</td>
                                            </tr>
											<tr>
                                                <td><div class="form-group" style="width:100%">
													<label>Description</label>
													<textarea id="description" class="form-control" rows="4" name="description"></textarea>
												     </div>
												</td>
											</tr>
											
											
											<!--<input type="hidden" value="0" id="theValue" />
											
											
											<input type="file" id="attach" name="attach" />


											<div id="myDiv"> </div>
											
										    <p><a href="javascript:;" onclick="addElement();">Add attach</a></p>-->
											
											<tr>
                                                <td>
											
											<input type="hidden" value="0" id="theValue" /><input type="file" id="attach" name="attach" />

<p><a href="javascript:;" onclick="addElement();">Add Attachments</a></p>

<div id="my"> </div></td>
											</tr>
											
<!--<input id="btnAdd" type="button" value="Add" />
<br />
<br />
<div id="TextBoxContainer">
    <!--Textboxes will be added here 
<br />
<input id="btnGet" type="button" value="Get Values" />
</div>-->
   										    <tr>
                                                <td>
												<button type="submit" class="btn btn-primary">Create Ticket</button>&nbsp;&nbsp;&nbsp;<button type="reset" class="btn btn-primary">Clear</button>
												</td>
                                            </tr>
                                        </tbody>
                                    </table></form>
                                </div>
                                <!--<div class="text-right">
                                    <a href="newcustomer.php">Create contact with full details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!--<script type="text/javascript">
$(function () {
    $("#btnAdd").bind("click", function () {
        var div = $("<div />");
        div.html(GetDynamicTextBox(""));
        $("#TextBoxContainer").append(div);
    });
    $("#btnGet").bind("click", function () {
        var values = "";
        $("input[name=DynamicTextBox]").each(function () {
            values += $(this).val() + "\n";
        });
        alert(values);
    });
    $("body").on("click", ".remove", function () {
        $(this).closest("div").remove();
    });
});
function GetDynamicTextBox(value) {
    return '<input name = "DynamicTextBox" type="text" value = "' + value + '" />&nbsp;' +
            '<input type="button" value="Remove" class="remove" />'
}
</script>-->
<!--
<script>

function addElement() {

  var ni = document.getElementById('myDiv');

  var numi = document.getElementById('theValue');

  var num = (document.getElementById('theValue').value -1)+ 2;

  numi.value = num;

  var newdiv = document.createElement('div');

  var divIdName = 'my'+num+'Div';

  newdiv.setAttribute('id',divIdName);

    newdiv.innerHTML = '<input type="file" id="attach" name="attach'+num+'" /> <a href=\'#\' onclick=\'removeElement('+num+')\'>Remove the div "'+divIdName+'"</a>';
  
    //newdiv.innerHTML = 'Element Number '+num+' has been added! <a href=\'#\' onclick=\'removeElement('+divIdName+')\'>Remove the div "'+divIdName+'"</a>';

  ni.appendChild(newdiv);

}

function removeElement(divNum) {
	

  var d = document.getElementById('my');

  var divIdName = 'my'+divNum+'Div';
  
  var olddiv = document.getElementById(divIdName);
 
  d.removeChild(olddiv);

}


</script>-->

<script>

function addElement() {

  var ni = document.getElementById('my');

  var numi = document.getElementById('theValue');

  var num = (document.getElementById('theValue').value -1)+ 2;

  numi.value = num;

  var newdiv = document.createElement('div');

  var divIdName = 'my'+num+'Div';

  newdiv.setAttribute('id',divIdName);
    newdiv.innerHTML = '<input type="file" id="attach" name="attach'+num+'" /> <a href=\'#\' onclick=\'removeElement('+num+')\'>Remove the Attach '+num+'</a>';
//  newdiv.innerHTML = 'Element Number '+num+' has been added! <a href=\'#\' onclick=\'removeElement('+num+')\'>Remove the div "'+divIdName+'"</a>';

  ni.appendChild(newdiv);

}

function removeElement(divNum) {
	
  var d = document.getElementById('my');

  var divIdName = 'my'+divNum+'Div';
  
  var olddiv = document.getElementById(divIdName);
 
  d.removeChild(olddiv);

}
</script>



</body>

</html>
