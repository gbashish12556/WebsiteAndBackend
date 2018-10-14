<?php
$name = $phone = $subject = $message = "";
if(loader_post_isset('feedback_name')&&loader_post_isset('feedback_phone')&&loader_post_isset('feedback_subject')&&loader_post_isset('feedback_message')&&loader_post_isset('submit'))
{


	$name = loader_get_post_escape('feedback_name');
	$phone = loader_get_post_escape('feedback_phone');
	$subject = loader_get_post_escape('feedback_subject');
	$message = loader_get_post_escape('feedback_message');
	$session = loader_get_post_escape('fsession');

	//echo 'session'.$session;
	//echo 'form_session'.loader_get_session('feedback_session');
	if($session == loader_get_session('feedback_session'))
	{


		if(("" == $name)||("" == $phone)||("" == $subject)||("" == $message))
		{
			$error_message = MANDATORY_MISSING;
		}
		else
		{
		   if(validate_phone_number($phone))
		   {
				 $recipient = COMPANY_EMAIL;
				 $template_data_array = array("SUBJECT","NAME","PHONE","MESSAGE");
				 $template_value_array = array($subject,$name,$phone,$message);
				 global $mailTemplate;
				 $send = loader_send_mail($mailTemplate['feedback_content'],$template_data_array,$template_value_array,$recipient,$email,$mailTemplate['feedback_subject']);
				  $query = "INSERT INTO tbl_feedback (fld_name , fld_phone, fld_subject, fld_message) VALUES('".$name."','".$phone."','".$subject."','".$message."')";
				  //echo $query;
				  if(loader_query($query))
				  {
					  echo '<script>alert("Feedback Successfully Submitted");</script>';
				  }
				  else 
				  {
					echo '<script>alert("Server Error");</script>';
				  }
		   }
		   else
		   {
			   $error_message = MOBILE_INVALID;

		   }
		}
	}
}
?>
