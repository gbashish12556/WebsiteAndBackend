<?php
$name = $email = $subject = $message = "";
if(loader_post_isset('email'))
{
	//echo "ashish";
	$name = loader_ucwords(loader_get_post_escape('name'));
	$email = loader_get_post_escape('email');
	$subject = loader_get_post_escape('subject');
	$message = loader_get_post_escape('message');
	$session = loader_get_post_escape('session');
	//echo 'session'.$session;
	//echo 'form_session'.loader_get_session('form_session');
	if($session == loader_get_session('form_session'))
	{
		if(("" == $name)||("" == $email)||("" == $subject)||("" == $message))
		{
			$error_message = MANDATORY_MISSING;
		}
		else
		{  
		   if(loader_isValidEmail($email))
		   {
				if((strlen($name)>NAME_MAXLEN)||(strlen($email)>EMAIL_MAXLEN)||(strlen($subject)<SUBJECT_MINLEN)||(strlen($subject)>SUBJECT_MAXLEN)||(strlen($message)<MESSAGE_MINLEN)||(strlen($message)>MESSAGE_MAXLEN))
				{
					$errror_message = WRONG_HAPPEN;
				}
				else
				{
					
					$recipient = COMPANY_EMAIL;
					$template_data_array = array("SUBJECT","NAME","MAIL","MESSAGE");
					$template_value_array = array($subject,$name,$email,$message);
					global $mailTemplate;
					$send = loader_send_mail($mailTemplate['contactus_content'],$template_data_array,$template_value_array,$recipient,$email,$mailTemplate['contactus_subject']);
					if ("SUCCESS" == $send) {
						$success_message = EMAIL_SEND_SUCCESS;
						loader_set_session('form_session','processed');
						//echo loader_get_session('form_session');
						//http_response_code(200);
					} 
					else 
					{
						$error_message = SERVER_ERROR;
						//http_response_code(500);
					}
			
				}
		   }
		   else
		   {
			   $error_message = EMAIL_INVALID;
		   }
		}
	}
}
?>