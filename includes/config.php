<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
   if($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "127.0.0.1"){
  	define('DB_SERVER', "127.0.0.1"); 	//database server
 	define('DB_USER', "root");	//database login name
	define('DB_PASS', "");	//database login password
  	define('DB_DATABASE', "shipper_db_old");	//database name
	define('VARIABLE_PREFIX', "loader_");
    define('LOCAL',$_SERVER['HTTP_HOST']);

    define('ROOT_PATH','/loader_version1/');
	define('ACTION_PATH','action/');
	define('INCLUDE_PATH','includes/');
	define('IMAGE_PATH','images/');
	define('UPLOAD_PATH','upload/');
	define('LOG_PATH','log/');
 	define('RECORDS',6);
 	define('QR_DIR_TEMP_PATH',dirname(__DIR__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR);
	define('EMAIL_ADD', 'loader@localserver.in'); // define any notification email
	define('PAYPAL_EMAIL_ADD', 'guptarohan555@gmail.com'); // facilitator email which will receive payments change this email to a live paypal account id when the site goes live
	
  }else{
	define('DB_SERVER',"shipperdb.cjw3fnoo7sak.ap-southeast-1.rds.amazonaws.com"); 	//database server
	define('DB_USER', "shipper_admin");	//database login name
	define('DB_PASS', "complexdb123$");	//database login password
	define('DB_DATABASE', "shipper_db_old");	//database name
	define('VARIABLE_PREFIX', "shipper_");
	define('LOCAL',"");
    define('LOADER_ADMIN_MAIL','loader@localserver.in');
	define('ROOT_PATH','/');
	define('VARIABLE_PREFIX', "shipper_");
	define('ACTION_PATH','action/');
	define('IMAGE_PATH','images/');
	define('UPLOAD_PATH','upload/');
	define('LOG_PATH','log/');
	define('INCLUDE_PATH','includes/');
	define('QR_DIR_TEMP_PATH',dirname(__DIR__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR);
	define('RECORDS',6);
	define('EMAIL_ADD', 'guptarohan555@gmail.com'); // define any notification email
	define('PAYPAL_EMAIL_ADD', 'guptarohan555@gmail.com'); // facilitator email which will receive payments change this email to a live paypal account id when the site goes live
}
	define('AREA_RADIUS',5);
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
	define('COMPANY_NO','8276097972 / 8276903952');

	?>
