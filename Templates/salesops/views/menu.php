    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Sun Com Mobile Portal</a>	
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
	
      <div class="collapse navbar-collapse " id="navbarsExampleDefault">

        <ul class="navbar-nav mr-auto">
         <!-- <li class="nav-item <?php if(isset($_REQUEST['action'])){ if(($_REQUEST['action'] == 'DMPage')||($_REQUEST['action'] == 'login')) {echo 'active';}} ?>">
            <a class="nav-link" href="index.php?action=DMPage">DM <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if(isset($_REQUEST['action'])){ if($_REQUEST['action'] == 'expensePage') {echo 'active';}} ?>" href="index.php?action=expensePage">Expenses</a>
          </li>	
		   <li class="nav-item">
            <a class="nav-link <?php if(isset($_REQUEST['action'])){ if($_REQUEST['action'] == 'marketPage') {echo 'active';}} ?>" href="index.php?action=marketPage">Market</a>
          </li>	
		  <li class="nav-item">
            <a class="nav-link <?php if(isset($_REQUEST['action'])){ if($_REQUEST['action'] == 'regionPage') {echo 'active';}} ?>" href="index.php?action=regionPage">Region</a>
          </li>	
		  <li class="nav-item">
            <a class="nav-link <?php if(isset($_REQUEST['action'])){ if($_REQUEST['action'] == 'storesPage') {echo 'active';}} ?>" href="index.php?action=storesPage">Stores</a>
          </li>	-->
          <li class="nav-item dropdown <?php if(isset($_REQUEST['action'])){ if(($_REQUEST['action'] == 'homePage') || 
										($_REQUEST['action'] == 'marketPage') ||
										($_REQUEST['action'] == 'regionPage') ||
										($_REQUEST['action'] == 'storesPage') ||
										($_REQUEST['action'] == 'usersPage') ||
										($_REQUEST['action'] == 'hrreportPage') ||
										($_REQUEST['action'] == 'rentfilePage') ||
										($_REQUEST['action'] == 'storesdocsPage') ||
										($_REQUEST['action'] == 'monthlyEbitPage') ||
										($_REQUEST['action'] == 'userAuthPage') ||
										($_REQUEST['action'] == 'login'))
										{echo 'active';}} if(isset($_REQUEST['uid']))echo 'active'; ?>">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Masters</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="index.php?action=DMPage">District</a>
              <!--<a class="dropdown-item" href="index.php?action=expensePage">Expenses</a>-->
              <a class="dropdown-item" href="index.php?action=marketPage">Market</a>
			  <a class="dropdown-item" href="index.php?action=regionPage">Region</a>
			  <a class="dropdown-item" href="index.php?action=storesPage">Stores</a>
			  <a class="dropdown-item" href="index.php?action=usersPage">Users</a>
			  <a class="dropdown-item" href="index.php?action=hrreportPage">Upload HR Report</a>
			  <a class="dropdown-item" href="index.php?action=rentfilePage">Upload Rent File</a>
			  <a class="dropdown-item" href="index.php?action=monthlyEbitPage">Monthly EBIT Uploader</a>
			  <a class="dropdown-item" href="index.php?action=userAuthPage">User Portal Access</a>
			  <!--<a class="dropdown-item" href="index.php?action=storesdocsPage">Store(s) Documents</a>-->
            </div>
          </li>
		  <li class="nav-item">
            <a class="nav-link  <?php if(isset($_REQUEST['action'])){ if($_REQUEST['action'] == 'dailydashboard') {echo 'active';}} ?>" href="index.php?action=dailydashboard">Daily Dashboard</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link  <?php if(isset($_REQUEST['action'])){ if($_REQUEST['action'] == 'Export_Store_Masterlist') {echo 'active';}} ?>" href="index.php?action=Export_Store_Masterlist">Export Store Masterlist</a>
          </li>
          <li class="nav-item dropdown <?php if(isset($_REQUEST['action'])){ if(($_REQUEST['action'] == 'openingChecklist') || 
										($_REQUEST['action'] == 'closingChecklist') )
										{echo 'active';}}  ?>">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CheckList(s)</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="index.php?action=openingChecklist">Opening Checklist(s)</a>
              <a class="dropdown-item" href="index.php?action=closingChecklist">Closing Checklist(s)</a>			 
            </div>
          </li>
		  <li class="nav-item">
            <a class="nav-link  <?php if(isset($_REQUEST['action'])){ if($_REQUEST['action'] == 'managerhandoff') {echo 'active';}} ?>" href="index.php?action=managerhandoff">Manager Handoff</a>
          </li>	
		  <li class="nav-item">
            <a class="nav-link " href="index.php?action=logout">Log out</a>
          </li>
        </ul>
		<!--<div style="float:left;color:white;margin-left:7%;" class="mr-auto">
				Welocme&nbsp;&nbsp <?php echo $_SESSION['name'];?>
		  </div>-->
        <!--<form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" id="top_search_val" placeholder="Search" value="<?php if(isset($_REQUEST['searchVal'])) { echo $_REQUEST['searchVal']; }?>" aria-label="Search" data-toggle="tooltip" data-placement="left" title="Enter the Keyword to Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="button" id="top_search_button">Search</button>
        </form>-->
      </div>
    </nav>