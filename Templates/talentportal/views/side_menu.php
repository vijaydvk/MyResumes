        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo">
                <a href="index.php?action=login">
                    <h4 style="color:white;">Sun Com Mobile</h4>
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="images/icon/avatar-01.png" alt="<?php echo $_SESSION['name'];?>" />
                    </div>
                    <h4 class="name"><?php echo $_SESSION['name'];?></h4>
                    <a href="index.php?action=logout">Sign out</a>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub <?php if(isset($_GET["action"]))if($_GET["action"] == "applicantListPage") echo "active";?>">
                                    <a href="index.php?action=applicantListPage">
                                        Applicant list</a>
                         </li>                        
                    </ul>
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub <?php if(isset($_GET["action"]))if($_GET["action"] == "mylikesPage") echo "active";?>">
                                    <a href="index.php?action=mylikesPage">
                                        My Likes</a>
                         </li>                        
                    </ul>	
					<ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                Settings
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list" style="margin-left:20%;">
								<li class="has-sub">
									<a href="index.php?action=stepsSettingsPage" style="padding:10px 0px;font-size:14px;">
										Steps Settings
									</a>
								</li>                                
                            </ul>
                            <ul class="list-unstyled navbar__sub-list js-sub-list" style="margin-left:20%;">
								<li class="has-sub">
									<a href="index.php?action=accessRolePage" style="padding:10px 0px;font-size:14px;">
										Access Settings
									</a>
								</li>                                
                            </ul>							
                        </li>	
					</ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->