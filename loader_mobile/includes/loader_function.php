<?php
ini_set("allow_url_fopen","On");
function loader_include($file_name){	return include_once($file_name);}
# Database query
function loader_escape($string){loader_debug(__LINE__,__FILE__,__FUNCTION__);global $con;return mysqli_real_escape_string($con,$string);}
function loader_trim($value){loader_debug(__LINE__,__FILE__,__FUNCTION__);return trim($value);}
function loader_fetch_array($value){loader_debug(__LINE__,__FILE__,__FUNCTION__);return mysqli_fetch_array($value);}
function loader_fetch_assoc($result){loader_debug(__LINE__,__FILE__,__FUNCTION__);global $con;return mysqli_fetch_assoc($result);}
function loader_query($query){loader_debug(__LINE__,__FILE__,__FUNCTION__);loader_print_query(__LINE__,__FILE__,$query);global $con;return mysqli_query($con,$query);}
function loader_num_rows($result){$rows = mysqli_num_rows($result);loader_debug(__LINE__,__FILE__,__FUNCTION__); return $rows;}
function loader_last_inserted(){loader_debug(__LINE__,__FILE__,__FUNCTION__);global $con;return mysqli_insert_id($con);}
function find_position($string, $findme){loader_debug(__LINE__,__FILE__,__FUNCTION__);return strpos($string, $findme);}
function loader_is_numeric($value){loader_debug(__LINE__,__FILE__,__FUNCTION__);return is_numeric($value);}
function loader_commit_off(){global $con;mysqli_query($con,"SET AUTOCOMMIT=0"); }
function loader_commit_on(){global $con;mysqli_query($con,"SET AUTOCOMMIT=1"); }
function loader_commit(){global $con;mysqli_query($con,"COMMIT"); }
function loader_rollback(){global $con;mysqli_query($con,"ROLLBACK");}
function loader_upper($value){loader_debug(__LINE__,__FILE__,__FUNCTION__);return strtoupper($value);}
function loader_date_function($date){loader_debug(__LINE__,__FILE__,__FUNCTION__);return $date;}
function loader_email_function($email){loader_debug(__LINE__,__FILE__,__FUNCTION__);return $email;}
function loader_phone_function($phone){loader_debug(__LINE__,__FILE__,__FUNCTION__);return $phone;}
function loader_count($value){loader_debug(__LINE__,__FILE__,__FUNCTION__);return count($value);}
#file put contents......
function loader_file_put_content($folder,$file,$content)
{
	file_put_contents($folder."/".date('d_m_Y', time())."".$file.".txt", date('d/m/Y h:i:s a', time())." ".print_r($content,true), FILE_APPEND);
	// loader_debug(__LINE__,__FILE__,__FUNCTION__);
}
#date time addittion Function....
function loader_sum_the_time($time1, $time2) {
  $times = array($time1, $time2);
  $seconds = 0;
  foreach ($times as $time)
  {
    list($hour,$minute,$second) = explode(':', $time);
    $seconds += $hour*3600;
    $seconds += $minute*60;
    $seconds += $second;
  }
  $hours = floor($seconds/3600);
  $seconds -= $hours*3600;
  $minutes  = floor($seconds/60);
  $seconds -= $minutes*60;
  // return "{$hours}:{$minutes}:{$seconds}";
  return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); }
#null function....
function loader_isnull($value){return is_null($value); }
#enum function
function loader_isenum($value){ return preg_match('/^[0-1]/',$value);}
#round function....
function loader_round($value){return round($value, 2); }
#isset function...
function loader_isset($variable){loader_debug(__LINE__,__FILE__,__FUNCTION__); return isset($variable);}
#validate date format......
function loader_validateDate($date, $format)
{
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;}
# Initialize session data
function loader_start_session() {session_start();}
function loader_destroy_session() {session_destroy();}
function loader_set_session( $session_name,$session_value ){	$_SESSION[$session_name] = $session_value;}
function loader_get_session($session_name){loader_debug(__LINE__,__FILE__,__FUNCTION__);	return $_SESSION[$session_name];}
function loader_session_isset($session_name){loader_debug(__LINE__,__FILE__,__FUNCTION__);	return isset($_SESSION[$session_name]);}
function loader_unset_session($session_name){unset($_SESSION[$session_name]);}
function loader_all_session_unset(){loader_debug(__LINE__,__FILE__,__FUNCTION__);session_unset();}
function loader_close_session(){	session_close();}
#session function end
function loader_today_date(){loader_debug(__LINE__,__FILE__,__FUNCTION__);return date('Y-m-d H:i:s');}
function loader_display($content){ echo $content;}
function loader_html_display($content){ echo $content;}
function loader_strip($str){loader_debug(__LINE__,__FILE__,__FUNCTION__);return stripslashes($str);}
function loader_hash($content)	{$output = sha1(TOKEN_SALT.time().$content);	if(!$output) {loader_display("error in hashing input "."\r\n"); } else { loader_debug(__LINE__,__FILE__,__FUNCTION__);return $output;}}

# Post function
function loader_get_post_escape($post_name){loader_debug(__LINE__,__FILE__,__FUNCTION__);global $con;return mysqli_real_escape_string($con,trim($_POST[$post_name]));	}
function loader_get_post($post_name){loader_debug(__LINE__,__FILE__,__FUNCTION__);	return $_POST[$post_name];	}
function loader_get_files($post_name){loader_debug(__LINE__,__FILE__,__FUNCTION__);	return $_FILES[$post_name];	}
function loader_post_isset($post_name){loader_debug(__LINE__,__FILE__,__FUNCTION__); return isset($_POST[$post_name]);}
function loader_all_post(){loader_debug(__LINE__,__FILE__,__FUNCTION__); return $_POST;}
#2D post function.....
function loader_get_2Dpost($first,$second){loader_debug(__LINE__,__FILE__,__FUNCTION__); return ($_POST[$first][$second]);}
function loader_2Dpost_isset($first,$second){loader_debug(__LINE__,__FILE__,__FUNCTION__); return isset($_POST[$first][$second]);}
#function for uc words.........
function loader_ucwords($string){loader_debug(__LINE__,__FILE__,__FUNCTION__);return ucwords(strtolower($string));}
#function for lc words.........
function loader_uppercase($string){loader_debug(__LINE__,__FILE__,__FUNCTION__);return strtoupper($string);}
#End post function
function loader_debug($line_number,$file_name,$function,$var = NULL){
	/*if($var){
		$var = implode(",", $var);
		}
	$somecontent = "[".date('Y-m-d H:i:s')."]  \t ".$file_name."\t".$function."\t Line_number:".$line_number."\t".$var."\r\n";
    $filename = dirname(__FILE__) . '/debug_log.txt';
	if (!$handle = fopen($filename, 'a'))
    {
        echo "Cannot open file ($filename)";
         exit;
    }
    if (fwrite($handle, $somecontent) === FALSE)
	{
        echo "Cannot write to file ($filename)";
        exit;
    }*/
}
function loader_url_log(){
	/*	$somecontent = "[".date('Y-m-d H:i:s')."]  \t ".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\r\n";
		$filename = dirname(__FILE__) . '/url_log/'.date('Y-m-d').'.txt';
		if (!$handle = fopen($filename, 'a')) {
			 //echo "Cannot open file ($filename)";
			 exit;
		}

		if (fwrite($handle, $somecontent) === FALSE) {
			//echo "Cannot write to file ($filename)";
			exit;
		}*/
}
//loader_url_log();
function loader_print_query($line_number,$file_name,$query){
	/*	$somecontent = "[".date('Y-m-d H:i:s')."]  \t ".$file_name."\t Line_number:".$line_number."\t".$query."\r\n";
		$filename = dirname(__FILE__) . '/query_log/'.date('Y-m-d').'.txt';
		if (!$handle = fopen($filename, 'a')) {
			 //echo "Cannot open file ($filename)";
			 exit;
		}

		if (fwrite($handle, $somecontent) === FALSE) {
			//echo "Cannot write to file ($filename)";
			exit;
		}*/
}
function loader_debug_print($var, $print_stack = 0, $exit_here = 0){

	if(1 == $print_stack)
	{
		//var_dump(debug_backtrace());
	}
	if(1 == $exit_here)
	{
		exit();
	}}
function loader64_encode($string){ loader_debug(__LINE__,__FILE__,__FUNCTION__);return base64_encode($string);}
function loader64_decode($string){ loader_debug(__LINE__,__FILE__,__FUNCTION__);return base64_decode($string);}
#Cookie handler functions
function loader_cookie_isset($cookie_name){loader_debug(__LINE__,__FILE__,__FUNCTION__);return isset($_COOKIE[$cookie_name]);}
function loader_get_cookie($cookie_name){loader_debug(__LINE__,__FILE__,__FUNCTION__);	return $_COOKIE[$cookie_name];}
#End cookie handler functions
# Get function
function loader_get_get($get_name){loader_debug(__LINE__,__FILE__,__FUNCTION__);	return trim($_GET[$get_name]);	}
function loader_get_isset($get_name){loader_debug(__LINE__,__FILE__,__FUNCTION__);	return isset($_GET[$get_name]);}
#End get function
# Request function
function loader_get_request($request_name){loader_debug(__LINE__,__FILE__,__FUNCTION__);	return $_REQUEST[$request_name];	}
function loader_request_isset($request_name){loader_debug(__LINE__,__FILE__,__FUNCTION__);	return isset($_REQUEST[$request_name]);}
#End request function
#Get the ip address of the visitor's machine
function loader_get_ip(){ loader_debug(__LINE__,__FILE__,__FUNCTION__);	return $_SERVER["REMOTE_ADDR"]; }
#End
#Get the browser address of the visitor's machine
function loader_get_user_browser(){ loader_debug(__LINE__,__FILE__,__FUNCTION__);	return $_SERVER['HTTP_USER_AGENT'];}
#Page redirect
function loader_redirect($url){loader_debug(__LINE__,__FILE__,__FUNCTION__); return (header('Location: '.$url));	}
#Return number of element in the array
function loader_array_count($ar_data){loader_debug(__LINE__,__FILE__,__FUNCTION__);	 return count($ar_data);}
#End
function genRandomString(){
	$length=6;
	if($length>0)
	{
		$rand_id="";
	   	for($i=1; $i<=$length; $i++)
	   	{
	   		mt_srand((double)microtime() * 1000000);
	   		$num = mt_rand(1,36);
	   		$rand_id .= assign_rand_value($num);
	   	}
	}
	return $rand_id;}
function loader_in_array($value, $arr){return in_array($value, $arr);}
function loader_key_exists($value, $arr){return array_key_exists($value, $arr);}
function assign_rand_value($num){
// accepts 1 - 36
  switch($num)
  {
    case "1":
     $rand_value = "a";
    break;
    case "2":
     $rand_value = "b";
    break;
    case "3":
     $rand_value = "c";
    break;
    case "4":
     $rand_value = "d";
    break;
    case "5":
     $rand_value = "e";
    break;
    case "6":
     $rand_value = "f";
    break;
    case "7":
     $rand_value = "g";
    break;
    case "8":
     $rand_value = "h";
    break;
    case "9":
     $rand_value = "i";
    break;
    case "10":
     $rand_value = "j";
    break;
    case "11":
     $rand_value = "k";
    break;
    case "12":
     $rand_value = "l";
    break;
    case "13":
     $rand_value = "m";
    break;
    case "14":
     $rand_value = "n";
    break;
    case "15":
     $rand_value = "o";
    break;
    case "16":
     $rand_value = "p";
    break;
    case "17":
     $rand_value = "q";
    break;
    case "18":
     $rand_value = "r";
    break;
    case "19":
     $rand_value = "s";
    break;
    case "20":
     $rand_value = "t";
    break;
    case "21":
     $rand_value = "u";
    break;
    case "22":
     $rand_value = "v";
    break;
    case "23":
     $rand_value = "w";
    break;
    case "24":
     $rand_value = "x";
    break;
    case "25":
     $rand_value = "y";
    break;
    case "26":
     $rand_value = "z";
    break;
    case "27":
     $rand_value = "0";
    break;
    case "28":
     $rand_value = "1";
    break;
    case "29":
     $rand_value = "2";
    break;
    case "30":
     $rand_value = "3";
    break;
    case "31":
     $rand_value = "4";
    break;
    case "32":
     $rand_value = "5";
    break;
    case "33":
     $rand_value = "6";
    break;
    case "34":
     $rand_value = "7";
    break;
    case "35":
     $rand_value = "8";
    break;
    case "36":
     $rand_value = "9";
    break;
  }
  loader_debug(__LINE__,__FILE__,__FUNCTION__);
return $rand_value;}
function get_rand_id($length){
 	if($length>0)
  	{
 		$rand_id="";
	   	for($i=1; $i<=$length; $i++)
	   	{
		   mt_srand((double)microtime() * 1000000);
		   $num = mt_rand(1,36);
		   $rand_id .= assign_rand_value($num);
	   	}
  	}
  	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	return $rand_id;}
#vaidate time
function loader_isValidTime($time){
	$regexp = "/(1[012]|[1-9]):[0-5][0-9](?i)(am|pm)/";
	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	return preg_match($regexp, trim($time));}
#validate date
function loader_isValidDateTime($date){
	//echo $date;
	//$reg = "/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/";
	$regexp = "/^([0][1-9]|[12][0-9]|3[0-1])\/([0][1-9]|1[0-2])\/(\d{4}) (0[0-9]|1[0-2]):([0-5][0-9]) (am|pm|AM|PM)$/";
	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	return preg_match($regexp, trim($date));}
function loader_isValidEmail($Email){
	$regexp='/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	return preg_match($regexp, trim($Email));}
# Implode Function
function loader_implode($format,$val){loader_debug(__LINE__,__FILE__,__FUNCTION__);	return implode($format,$val);}
#End
function validate_alphanumeric_underscore($str){
    if(preg_match('/^[a-zA-Z0-9_]+$/',$str) && substr($str, 0, 1)!="_"){loader_debug(__LINE__,__FILE__,__FUNCTION__);	return true;}
	else{loader_debug(__LINE__,__FILE__,__FUNCTION__);return false;}}
function validate_phone_number($phone){
	//echo $phone;
	if(!preg_match("/^[0-9]{10}$/i",$phone))
	{
		loader_debug(__LINE__,__FILE__,__FUNCTION__);
		return false;
	}
	else
	{
		loader_debug(__LINE__,__FILE__,__FUNCTION__);
	 	return true;
	}}
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;}
function redirect_login(){
	loader_set_session(VARIABLE_PREFIX."redirect_url",curPageURL());
	?>
			<script type="text/javascript">
				 window.location='<?php loader_display(ROOT_PATH.'login'); ?>';
			</script>
	<?php
}
function loader_replace_message($message_date_array, $message_value_array, $string){
	$message_date_array = array_map("add_email_template_code", $message_date_array);
	return str_replace($message_date_array, $message_value_array, $string);
}
function loader_send_mail($template,$template_data_array,$template_value_array,$receiver,$sender,$subject){
// 	$template_data_array = array_map("add_email_template_code", $template_data_array);
// 	$email_data = str_replace($template_data_array, $template_value_array, $template);
// 	$subject = str_replace($template_data_array, $template_value_array, $subject);
// 	$email_id = "";
// 	$from = "theshipper.org<".COMPANY_EMAIL.">";
// 	if("" == LOCAL)
// 	{
// 		$email_id =	$receiver;
// 	   // file_put_contents("extra_data/".date('d-m-Y',time())."testFile.txt",date('d-m-Y H:i:s a',time())." ".print_r("Main".$email_id.LOCAL,true)."<br>",FILE_APPEND);
// 	}
// 	else
// 	{
// 		$email_id =	"user1@ashishserver1.ashish.in";
//        // file_put_contents("extra_data/".date('d-m-Y',time())."testFile.txt",date('d-m-Y H:i:s a',time())." ".print_r("Local".$email_id.LOCAL,true)."<br>",FILE_APPEND);
// 	}
// 	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
// <html xmlns="http://www.w3.org/1999/xhtml">
// <head>
// <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
// <title>TheShipper</title>
// </head>
// <body>
//     <div style="width:650px; margin-left:auto; margin-right:auto; height:auto; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:18px; color:#777; border:1px solid #ecebeb; overflow:hidden;">
//     	<div style="width:100%; float:left; border-bottom:1px solid #ecebeb; height:auto; padding:10px;">
//         	<img src="'.ROOT_PATH.'/images/small_logo.png" border="0" alt="loader" width="128" height="64"/>
//         </div>
//         <div style="width:100%; float:left; height:auto; padding:20px;">
//    '.$email_data.'
//      <br/><br/>
//             If you have any questions please read the <a href="'.ROOT_PATH.'"/support" style="color:#ff1bff; font-weight:bold;">FAQ</a> section or <a href="'.ROOT_PATH.'"/support" style=" font-weight:bold;color:#ff1bff">email us</a>.<br/><br/>
//             Please reply to this mail as ASAP!<br/>
//             <strong>TheShipper Team</strong>
//         </div>
//         <div style="padding:5px 20px; background:#004586; color:#fff; width:100%; height:auto; float:left;">
//         	If you didnt sign up for loader and have received this email in error, please <a href="www.theshipper.org/contact" style="color:#8dc63f; font-weight:bold;">Contact Us</a>.
//         </div>
//     </div>
// </body>
// </html>';

//     $headers = "Reply-To: ".$sender."\r\n";
//     $headers .= "Return-Path: ".$sender."\r\n";
//     $headers .= "From: ".$from."\r\n";
// 	$headers .= "MIME-Version: 1.0\r\n";
// 	$headers .= "Content-type: text/html; charset=iso-8859-1\r\nX-Priority: 3\r\nX-Mailer: PHP". phpversion() ."\r\n";
// 	//file_put_contents("email.txt", date('d/m/Y h:i:s a', time())."/r/n/r/n".$message."/r/n/r/n", FILE_APPEND);
// 	if(!mail($email_id,$subject,$message,$headers, 'O DeliveryMode=b'))
// 	{
// 		loader_debug(__LINE__,__FILE__,__FUNCTION__);
// 		return "FAIL";
// 	}
// 	else
// 	{
// 		loader_debug(__LINE__,__FILE__,__FUNCTION__);
// 		loader_file_put_content('mail_data',$email_data);
// 		return "SUCCESS";
// 	}
}
function loader_send_sms($sms_data,$receiver, $page){

	// $url =  'http://sms.salert.co.in/new/api/api_http.php?';
 //    $data = 'username=ashishgupta&password=ashish123&senderid=SHIPPR&to='.$receiver.'&text='.urlencode($sms_data).'&route=Transaction&type=text';
	// $ch = curl_init();
	// curl_setopt($ch, CURLOPT_URL, $url);
	// curl_setopt($ch, CURLOPT_POST, 1);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	// $result = curl_exec($ch);
	// curl_close($ch);
	// $result = explode(",",$result);
	// $status = explode("=",$result[0]);
	// loader_file_put_content("sms_data",$page, $sms_data."".$receiver."".$result);
	// if(isset($status[1]) && $status[1] != 0)
	// {
	// 	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	// 	return "FAIL";
	// }
	// else
	// {
	// 	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	// 	return "SUCCESS";
	// }
}
function loader_send_promotional_sms($sms_data,$receiver, $page){

	// $url =  'http://sms.salert.co.in/new/api/api_http.php?';
 //    $data = 'username=ashishgupta&password=ashish123&senderid=SHIPPR&to='.$receiver.'&text='.urlencode($sms_data).'&route=Enterprise&type=text';
	// $ch = curl_init();
	// curl_setopt($ch, CURLOPT_URL, $url);
	// curl_setopt($ch, CURLOPT_POST, 1);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	// $result = curl_exec($ch);
	// curl_close($ch);
	// $result = explode(",",$result);
	// $status = explode("=",$result[0]);
	// loader_file_put_content("sms_data",$page, $sms_data."".$receiver."".$result);
	// if(isset($status[1]) && $status[1] != 0)
	// {
	// 	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	// 	return "FAIL";
	// }
	// else
	// {
	// 	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	// 	return "SUCCESS";
	// }
}
function add_email_template_code($n){
	loader_debug(__LINE__,__FILE__,__FUNCTION__);
    return("%%".$n."%%");
}
function lower($str){
	return strtolower($str);
}
function display_notification(){
		$user_id = loader_get_session(VARIABLE_PREFIX."user_id");
		$notice_view = loader_fetch_assoc(loader_query("select noticeview from user_info where ai_user_id=".$user_id));
		$query ="SELECT `text`,`time` FROM usernotice WHERE user_id = ".$user_id." ORDER BY `time` DESC LIMIT 0,8";
		$result = loader_query($query);
		$count = loader_num_rows($result);
		$notice = "";
		$new_count = 0;
		while($row = loader_fetch_assoc($result))
		{

			if($notice_view['noticeview'] != "" && $row['time'] > $notice_view['noticeview'])
				$new_count++;
		 	$notice .='<li><span class="event">'.$row['text'].'</span></li>';
    	}
		if($notice_view['noticeview'] == "")
			$new_count = $count ;

	?>
 	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="icon16 icomoon-icon-bell"></span><?php if($new_count > 0) { ?> <span class="notification"><?php loader_display($new_count);?></span><?php } ?>
        </a>
        <ul class="dropdown-menu">
            <li class="menu">
                <ul class="notif">
                    <li class="header"><strong>Notifications</strong> :</li>
                    <?php //	echo $notice; ?>
                </ul>
            </li>
        </ul>
    </li>


<?php
}
function has_access(){
	$user_id = loader_get_session(VARIABLE_PREFIX."user_id");
	$query = "SELECT `is_locked` FROM user_info WHERE ai_user_id = ".$user_id;
	$result = loader_fetch_assoc(loader_query($query));
	if($result['is_locked'] == 1)
		return false;
	else
		return true;
}
function statelist($select_city = ""){
	global $indian_all_states;
	$option = "<option></option>";
	foreach($indian_all_states as $key => $val)
	{
		$selected = "";
		if($key == $select_city)
			$selected = "selected='selected'";

		$option .= "<option value='".$key."' ".$selected .">".$val."</option>";
	}
	loader_display("<select name='state' id='state' class='nostyle' style='width:100%;'>".$option."</select>");
}
function loader_date_format($date){
	return date("jS M, Y (g:i A)",strtotime($date));
}
function loader_number_format($number){
	return number_format($number, 2);
}
function loader_log($place,$message,$type){
	return loader_query("INSERT INTO `log`  (ip,`text`,place,`type`) VALUES ('".$_SERVER['REMOTE_ADDR']."','".$message."',".$place.",'".$type."')");
}
//match update function.....
function loader_image_upload($image,$is_copy=0){
	$error_message = "";
	$upload_file = "";
	$return_array = array();
	if($is_copy==1)
	{
		$return_array["iserror"] = 0;
		$return_array["image_name"] = $upload_file;
		return $return_array;
	}


	if($image['name'] != "")
	{
		$check = getimagesize($image["tmp_name"]);
		if($check !== false)
		{
			$allowedtype = array('image/jpg', 'image/png', 'image/jpeg' ,'image/gif');
			$allowedExts = array("jpg","png","jpeg","gif" );
			$extension = explode(".", $image["name"]);
			$extension = end($extension);

			if (($image["size"] > 1000000))
			{
					$error_message = IMAGE_SIZE_ERROR;
			}
			elseif(! loader_in_array($extension,$allowedExts))
			{
				$error_message = IMAGE_EXE_ERROR;
			}
			elseif(! loader_in_array($image['type'],$allowedtype))
			{
				$error_message = IMAGE_FORMAT_ERROR;
			}
		   else
		   {
				$upload_file = time(). $image["name"];
				move_uploaded_file($image["tmp_name"],"upload/" .$upload_file);
			}
		}
		else
		{
			$error_message = IMAGE_SIZE_ERROR;
		}

	}
	$return_array = array();
	if($error_message == "")
	{
		$return_array["iserror"] = 0;
		$return_array["image_name"] = $upload_file;
	}
	else
	{
		$return_array["iserror"] = 1;
		$return_array["error_message"] = $error_message;
	}
	return $return_array;
}
#get country function for get country from db............
function loader_getCountry(){
	$country_array = array();
	$queryres=loader_query("SELECT fld_country_code,fld_country_name FROM view_country WHERE fld_is_active = '1'");
	 while($result = loader_fetch_assoc($queryres))
	 {
		 $country_array[$result['fld_country_code']] = $result['fld_country_name'];
	 }
	 return $country_array;
}
#get city name.........
function loader_getCity($country_code){
	$state_array = array();
	$query = loader_query("SELECT fld_city_name FROM view_city WHERE fld_country_code='".$country_code."'");
	while($result = loader_fetch_assoc($query))
	{
		$state_array[$result['fld_city_name']] = $result['fld_city_name'];
	}
	return $state_array;
}
#get issuing country....
function loader_getCount($country_code){
	$city_array = array();
	$query = loader_query("SELECT fld_country_name FROM view_country WHERE fld_country_code = '".$country_code."'");
	while($result = loader_fetch_assoc($query))
	{
		$country_name = $result['fld_country_name'];
	}
	return $country_name;
}
#get GM date.........
function getGmt(){
	return gmdate("Y-m-d H:i:s");
}
#.....file exists...
function loader_file_exists($filename){
	return file_exists($filename);
}
#get date.........
function loader_date($timestap)
{
	return date('jS M,Y',strtotime($timestap));
}
#generate POTEA id
function generateloaderId()
{
	return md5(rand());
}

#generate verification code........
function loader_verification_code()
{
	return rand(10000,99999);
}
#validate country name......
function validateCountry($country_name)
{
	$query_validate_country = "SELECT fld_country_name FROM view_country WHERE fld_country_name = '".$country_name."'";
	$query_validate_country_res = loader_query($query_validate_country);
	if(loader_num_rows($query_validate_country_res))
	{
		return true;
	}
}

#validate city name......
function validateCity($country_code,$city_code)
{
	$query_validate_city = "SELECT fld_city_name FROM view_city WHERE fld_country_code = '".$country_code."' AND fld_city_name='".$city_code."'";
	$query_validate_city_res = loader_query($query_validate_city);
	if(loader_num_rows($query_validate_city_res))
	{
		return true;
	}
}

#file write.....
 function loader_file_write($filename,$data,$type)
 {
	 $filename = fopen("../Log/'".$type."'".".txt","a+");
	 fwrite($filename,$data);
	 fclose($filename);
 }
function loader_validate_social($social_data)
{
	$mobileapi = ""; //hard code value...
	$login_device = "web";
	$login_using = "web";
	$login_ip = loader_get_ip();
	$device_id = loader_get_user_browser();
	extract($social_data);
	 //var_dump($social_data);
	if("linkedin" == $social_type )
	{
		$quiry = ("SELECT `fld_ai_id`,`fld_name`,`fld_email`,`fld_is_active`,`fld_user_token`,fld_is_block,fld_user_type,fld_".$social_type."_id FROM view_user_info WHERE fld_email = '".$email."'");
		$quiryRun = loader_query($quiry);
		if(loader_num_rows($quiryRun))
		{
			$row_data = loader_fetch_assoc($quiryRun);
			if($row_data['fld_is_block'] == 1)
			{
				$error_message = BLOCKED_MEMBER;				// User Inactive
			}
			else
			{
				$isset = "";
				if($social_id != $row_data["fld_".$social_type."_id"])
				{
					$isset .= " fld_".$social_type."_id='".$social_id."' ";
				}
				if($row_data['fld_is_active'] == 0)
				{
					if($isset != "")
					{
						$isset .= ",";
					}
					$isset .= "fld_is_active= '1' ";
				}
				if($isset != "")
				{
					$updateQuery = ("UPDATE tbl_user_info SET ".$isset." WHERE fld_ai_id='".$row_data['fld_ai_id']."'");
					$updateQueryRun = loader_query($updateQuery);
				}
				loader_set_session(VARIABLE_PREFIX."name",$row_data['fld_name']);
				loader_set_session(VARIABLE_PREFIX."email",$row_data['fld_email']);
				loader_set_session(VARIABLE_PREFIX."member_id",$row_data['fld_ai_id']);
				loader_set_session(VARIABLE_PREFIX."member_token",$row_data['fld_user_token']);
				loader_set_session(VARIABLE_PREFIX."user_type",$row_data['fld_user_type']);
				$userRow["likes"]["name"] = $row_data['fld_name'];
				$userRow["likes"]["user_token"] = $row_data['fld_user_token'];

				//$userRow = array("name" => $row_data['fld_name'],"member_token" => $row_data['fld_user_token']);
				$query_login = "INSERT INTO tbl_login_log (fld_member_id,fld_login_ip,fld_login_device,fld_login_using,fld_using_browser,fld_login_date_time) VALUES ('".$row_data['fld_ai_id']."','".$login_ip."','".$login_device."','".$login_using."','".$device_id."',NOW())";
				$query_login_log_res = loader_query($query_login);
				if(!$query_login_log_res)
				{
					$error_message = SERVER_ERROR;
				}
				else
				{
					if($mobileapi != 1)
					{
						if(loader_session_isset(VARIABLE_PREFIX."redirect_url") &&  loader_get_session(VARIABLE_PREFIX."redirect_url") != "")
						{
							$url = loader_get_session(VARIABLE_PREFIX."redirect_url");
							loader_set_session(VARIABLE_PREFIX."redirect_url","");
							//header('Location: '.$url);
							?>
							<script type="text/javascript">
								 window.location='<?php loader_display($url); ?>';
							</script>
							<?php
						}
						else
						{
							//header('Location: '.ROOT_PATH."myitems");
							?>
							<script type="text/javascript">
								 window.location='<?php loader_display(ROOT_PATH."student-profile"); ?>';
							</script>
							<?php
						}
					}
					$success_message = "Welcome  ".$row_data['fld_name'];
				}
			}
		}
		else
		{
				$_SESSION['social_id'] = $social_id;
				$_SESSION['first_name'] = $first_name;
				$_SESSION['last_name'] = $last_name;
				$_SESSION['social_type'] = $social_type;
				$_SESSION["email"] = $email;
				$_SESSION['profile_pic'] = $profile_pic_url;
				?>
				<script type="text/javascript">
					window.location='<?php loader_display(ROOT_PATH.'signup-staff'); ?>';
				</script>
				<?php
		}
		if("" != $error_message)
		{
			$_SESSION['error_message'] = $error_message;
			header('Location: '.ROOT_PATH."login");

		}
	 }
}
function loader_isMailExist($email)
{
	$query = loader_query("SELECT fld_ai_id,fld_email,fld_name FROM view_user_info WHERE fld_email = '".$email."'");
	if($row = loader_num_rows($query))
	{
		$dataRes = loader_fetch_assoc($query);
		$result['fld_ai_id'] = $dataRes['fld_ai_id'];
		$result['status'] = 1;
	}
	else
	{
		$result['status'] = 0;
	}
	return $result;
}
#function for redirect 404 with don't permission...
function loader_unatuthorized()
{
?>
	<script type="text/javascript">
		window.location='<?php loader_display(ROOT_PATH.'unauthorized'); ?>';
	</script>
<?php
}
function loader_home_redirect()
{
?>
	<script type="text/javascript">
		window.location='<?php loader_display(ROOT_PATH); ?>';
	</script>
<?php
}
//Shipper original function
#get vehicle function for get country from db............
function get_vehiclelist($select_vehicle = "")
{
	$option = "<option value=''>Select Vehicle</option>";
    $query = "SELECT vehicle_name,vehicletype_id FROM view_vehicle_type WHERE is_active = '1' ";
	//echo $query;
	if($result = loader_query($query))
	{
		while($row = loader_fetch_assoc($result))
		{
				$selected = "";
				if($row['vehicletype_id'] == $select_vehicle)
				{
					$selected = "selected='selected'";
				}

				$option .= "<option value='".$row['vehicletype_id']."' ".$selected .">".$row['vehicle_name']."</option>";
		}
		loader_display("<select name='vehicle_type' id='vehicle_type' class='form-control required' >".$option."</select>");
	}
	else
	{
		$error_message = SERVER_ERROR;
	}
}
#get vehicle type to be displayed on page
function get_vehicletype_text($select_vehicle)
{
	$queryres=loader_query("SELECT vehicle_name FROM view_vehicle_type WHERE vehicletype_id = '".$select_vehicle."'");
	$row = loader_fetch_assoc($queryres);
	$vehicle = $row['vehicle_name'];
	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	return $vehicle;
}
#get vehicle type to be displayed on page
function get_vehicletype($select_vehicle)
{
	$queryres =  "SELECT vehicle_name,vehicletype_id FROM view_vehicle_type WHERE vehicletype_id = '".$select_vehicle."' AND is_active = '1'";
	//echo $queryres;
	$list = "";
	if($result =loader_query($queryres))
	{
		$row = loader_fetch_assoc($result);
	    $list .= "<option value='".$row['vehicletype_id']."' >".$row['vehicle_name']."</option>";
	}
	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	return $list;
}
#validate vehicle type
function validate_vehicletype($select_vehicle)
{
	$queryres=loader_query("SELECT vehicle_name FROM view_vehicle_type WHERE vehicletype_id = '".$select_vehicle."'");
	if(loader_num_rows($queryres))
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return true;
	}
	else
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return false;
	}
}

#validate otp
function validate_otp($otp_code)
{
	if(!preg_match("/^[0-9]{6}$/i",$otp_code))
	{
		loader_debug(__LINE__,__FILE__,__FUNCTION__);
		return false;
	}
	else
	{
		loader_debug(__LINE__,__FILE__,__FUNCTION__);
	 	return true;
	}
}

#validate user_token
function validate_user_token($token)
{
	$queryres=loader_query("SELECT email FROM view_customer_info WHERE user_token = '".$token."' AND is_active = '1' AND is_blocked = '0' ");
	if(loader_num_rows($queryres)>0)
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return true;
	}
	else
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return false;
	}
}
#validate driver_token
function validate_driver_token($token)
{
	$queryres=loader_query("SELECT name FROM view_driver_info WHERE user_token = '".$token."' AND is_active = '1' AND is_blocked = '0'  ");
	if(loader_num_rows($queryres)>0)
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return true;
	}
	else
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return false;
	}
}
#validate crn no in booking_detail table
function validate_crn_no($crn)
{
	$queryres=loader_query("SELECT * FROM view_booking_detail WHERE crn_no = '".$crn."'");
	if(loader_num_rows($queryres)>0)
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return true;
	}
	else
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return false;
	}
}
#validate customer name
function loader_isValidName($name)
{
	//$regexp='/^[a-zA-Z\s.]*$/';
	$regexp="/^[^0-9\(\)\{\}\[\]\!\"\$\^\&\*\+\_\#\@\<\>\:\;\/]*$/";
	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	return preg_match($regexp, $name);
}
#validate postal address
function loader_isValidAddress($loc)
{
	$regexp="/^[a-zA-Z]{2,}[a-zA-Z0-9\s\.\-\:\,\;\(\)]*$/";
	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	return preg_match($regexp, $loc);
}
#validate Latitude
function loader_isValidLat($lng)
{
	$regexp="/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/";
	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	return preg_match($regexp, $lng);
}
#validate longitude
function loader_isValidLng($lat)
{
	$regexp="/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/";
	loader_debug(__LINE__,__FILE__,__FUNCTION__);
	return preg_match($regexp, $lat);
}
#check if customer mail already exist
function customer_isMailExist($email,$token)
{
	$queryres = loader_query("SELECT customer_ai_id FROM view_customer_info WHERE email = '".$email."' AND user_token != '".$token."'");
	loader_file_put_content('post_data','validate_data',"SELECT customer_ai_id FROM view_customer_info WHERE email = '".$email."' AND user_token != '".$token."'");
	if(loader_num_rows($queryres)>0)
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return true;
	}
	else
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return false;
	}
}
#check if customer token already exist
function customer_isTokenExist($token)
{
	$queryres = loader_query("SELECT customer_ai_id FROM view_customer_info WHERE user_token = '".$token."'");
	if(loader_num_rows($queryres)>0)
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return true;
	}
	else
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return false;
	}
}
#check if driver token already exist
function driver_isTokenExist($token)
{
	$queryres = loader_query("SELECT driver_ai_id FROM view_driver_info WHERE user_token = '".$token."'");
	if(loader_num_rows($queryres)>0)
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return true;
	}
	else
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return false;
	}
}
#check if driver token already exist
function get_customer($token)
{
	$queryz = "SELECT name,mobile_no FROM view_customer_info WHERE user_token = '".$token."'";
	loader_file_put_content('validate_data','confirm_booking',$queryz);
	$queryres = loader_query($queryz);
	if(loader_num_rows($queryres)>0)
	{
		    $row = loader_fetch_assoc($queryres);
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return $row;
	}
	else
	{
			loader_debug(__LINE__,__FILE__,__FUNCTION__);
	        return "";
	}
}

function loader_push_message($gcm_regid,$msg,$page)
{
	
    loader_file_put_content('push_data',$page,'device_id:'.$gcm_regid);
    $registrationIds = array($gcm_regid);
	$fields = array
	(
		'registration_ids' 	=> $registrationIds,
		'data'			=> $msg
	);
	$headers = array
	(
		'Authorization: key='.API_ACCESS_KEY,
		'Content-Type: application/json'
	);
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch );
	curl_close( $ch );
	loader_file_put_content('push_data',$page,'device_id:'.$gcm_regid."".$msg."".$result);

}
?>
