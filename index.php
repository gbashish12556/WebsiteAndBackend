<?php
//phpinfo();
//header('Access-Control-Allow-Origin: *');
//ini_set('display_errors', 0);
//ini_set('log_errors', 0);
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
//error_reporting(1);
echo 'ashish';
include_once('includes/config.php');
include_once('includes/db.php');
include_once('includes/loader_function.php');
include_once('includes/message.php');
include_once('includes/mailTemplate.php');
$page = "";
if(isset($_REQUEST['page']))
{
	echo $_REQUEST['page'];
    $page = $_REQUEST['page'];
}
//echo 'page'.$page;
if($page == "logout")
{
	$page = "";
	session_unset();
	  ?>
			<script type="text/javascript">
				 window.location='<?php loader_display(ROOT_PATH.'home'); ?>';
			</script>
	 <?php 
}
$case = "";
if(isset($_REQUEST['case']))
{
	//echo "caseset";
    $case = $_REQUEST['case'];
}
//echo 'case'.$case;

//echo "myitems";
if($page == "")
{
	$page = "home";
}
// echo INCLUDE_PATH.'header.php';
include(INCLUDE_PATH.'header.php');
include("pages/".$page.".php");
include(INCLUDE_PATH.'footer.php');
?>
