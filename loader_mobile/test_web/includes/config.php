<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
   if(($_SERVER['HTTP_HOST'] == "localhost") || ($_SERVER['HTTP_HOST'] == "127.0.0.1")|| ($_SERVER['HTTP_HOST'] == "192.168.0.100")|| ($_SERVER['HTTP_HOST'] == "192.168.0.101")|| ($_SERVER['HTTP_HOST'] == "192.168.0.102")|| ($_SERVER['HTTP_HOST'] == "192.168.0.103")|| ($_SERVER['HTTP_HOST'] == "192.168.0.104")){
  	define('DB_SERVER', "127.0.0.1"); 	//database server
 	define('DB_USER', "root");	//database login name
	define('DB_PASS', "");	//database login password
  	define('DB_DATABASE', "shipper_db_old");	//database name
	define('VARIABLE_PREFIX', "loader_");
    define('LOCAL',$_SERVER['HTTP_HOST']);
 	if($_SERVER['HTTP_HOST'] == "127.0.0.1")
   	{
  		define('ROOT_PATH','/loader_mobile/');
   	}
	else
	{
		define('ROOT_PATH','/loader_mobile/');
	}
	define('ACTION_PATH','/action/');
	define('INCLUDE_PATH','/includes/');
 	define('RECORDS',6);
 	define('QR_DIR_TEMP_PATH',dirname(__DIR__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR);
	define('EMAIL_ADD', 'loader@localserver.in'); // define any notification email
define('PAYPAL_EMAIL_ADD', 'guptarohan555@gmail.com'); // facilitator email which will receive payments change this email to a live paypal account id when the site goes live
	
  }else{
	define('DB_SERVER',"shipperdbinstance.clonumzsp6m9.ap-southeast-1.rds.amazonaws.com"); 	//database server
	define('DB_USER', "shipper_admin");	//database login name
	define('DB_PASS', "complexlife123$");	//database login password
	define('DB_DATABASE', "shipper_db_old");	//database name
	define('VARIABLE_PREFIX', "shipper_");
	define('LOCAL',"");
    define('LOADER_ADMIN_MAIL','loader@localserver.in');
	define('ROOT_PATH','/');
	define('VARIABLE_PREFIX', "shipper_");
	define('ACTION_PATH','action/');
	define('INCLUDE_PATH','includes/');
	define('QR_DIR_TEMP_PATH',dirname(__DIR__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR);
	define('RECORDS',6);
	define('EMAIL_ADD', 'guptarohan555@gmail.com'); // define any notification email
	define('PAYPAL_EMAIL_ADD', 'guptarohan555@gmail.com'); // facilitator email which will receive payments change this email to a live paypal account id when the site goes live
}
	define('AREA_RADIUS',25);
	define('MOBILE_MINLEN',10);
	define('MOBILE_MAXLEN',10);
	define('NAME_MAXLEN',50);
	define('SUBJECT_MINLEN',10);
	define('SUBJECT_MAXLEN',50);
	define('MESSAGE_MINLEN',30);
	define('MESSAGE_MAXLEN',500);
	define('EMAIL_MAXLEN',50);
	define('VEHICLE_NO_MAXLEN',11);
	define('VEHICLE_NO_MINLEN',8);
	define('COMPANY_EMAIL','theshipper.co@gmail.com');
	define('COMPANY_NO','8276-097-972');
	
	/*
	 * ***** Edited by:      Sourav Halder (PHP Intern)
	 * ***** Last Edit Date: 25/04/2016
	 * ***** Works done:     Added constants for validation
	 * ***** I have written and currently working with the codes written under this comment. Dont edit them without telling me.
	*/
	define('OTP_MINLEN',6);
	define('OTP_MAXLEN',6);
	define('POSTAL_ADDRESS_MAXLEN',50);
	define('TOKEN_SALT','K0a!4H$#');
	?>
