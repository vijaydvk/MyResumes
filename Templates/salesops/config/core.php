<?php
// show error reporting
error_reporting(E_ALL);

//mysql -u root mysql
//root password sunComMySQL3!2
 
// set your default time-zone
date_default_timezone_set( "Asia/Calcutta" ); 
define( "CLASS_PATH", "classes" ); 
define( "CONTOLLER_PATH", "controller" ); 
define( "TEMPLATE_PATH", "views" );
define( "APP_URL", "index.php" );
define( "DB_DSN", "mysql:host=localhost;dbname=suncomportal" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "sunesoft123" );

require( CLASS_PATH . "/K18_Lookup.php" );
require( CLASS_PATH . "/K18_User.php" );
require( CLASS_PATH . "/K18_group.php" );
require( CLASS_PATH . "/K18_menu.php" );
require( CLASS_PATH . "/K18_uar.php" );
require( CLASS_PATH . "/K18_dropdown.php" );
require( CLASS_PATH . "/K18_utility.php" );
require( CLASS_PATH . "/ticket_update_db_page.php" );
require( CLASS_PATH . "/settings_db_page.php" );
require( CLASS_PATH . "/district_db_page.php" );
require( CLASS_PATH . "/market_db_page.php" );
require( CLASS_PATH . "/region_db_page.php" );
require( CLASS_PATH . "/store_db_page.php" );
require( CLASS_PATH . "/user_db_page.php" );
require( CLASS_PATH . "/hr_report_db_page.php" );
require( CLASS_PATH . "/rent_file_db_page.php");
require( CLASS_PATH . "/doc_type_db_page.php");
require( CLASS_PATH . "/monthly_ebit_db_page.php");
require( CLASS_PATH . "/user_url_access_db_page.php");
?>
