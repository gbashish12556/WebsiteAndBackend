<?php
	loader_file_put_content('post_data','customer_registration',$_REQUEST);
if(loader_post_isset("mobile_no")&&loader_post_isset("OTP"))
{
	$userRow = array();
	$error_message = $success_message = $mobile_no = $otp = "";
	$mobile_no = loader_get_post_escape("mobile_no");
	$otp = loader_get_post_escape("OTP");
	/*
	 ******  Edited by:           Sourav Halder
	 ******  Last Edit Date:      22/04/2016
	 ******  Works Done:          Validation of input data
	*/

	if(("" == $mobile_no)||("" == $otp))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if((strlen($mobile_no)>MOBILE_MAXLEN)||(strlen($mobile_no)<MOBILE_MINLEN)||(strlen($otp)>OTP_MAXLEN)||(strlen($otp)<OTP_MAXLEN))
		{
			$error_message = WRONG_HAPPEN;
		}
		else
		{
			if(validate_phone_number($mobile_no))
			{
				if(validate_otp($otp))
				{
							$result="SUCCESS";
							$result = loader_send_sms("6 digit OTP for verification is ".$otp,$mobile_no,"customer_registration");
							if("SUCCESS" == $result)
							{
								$success_message ="OTP generated successfully";
							}
							else if("FAIL" == $result)
							{
								$error_message = "OTP could not be generated";
							}
				}
				else
				{
					$error_message = OTP_INVALID;
				}
			}
			else
			{
				$error_message = MOBILE_INVALID;
			}
		}
	}
	if($error_message == "")
	{
		$errFlag = "0";			// Success status
		$errMsg = $success_message;
	}
	else
	{
		$errFlag = "1";			// Failure status
		$errMsg = $error_message;
	}
  	$userRow["errFlag"] = $errFlag."";
  	$userRow["errMsg"] = $errMsg."";

	//$json = array("errFlag" => $errFlag, "errMsg" => $errMsg, "likes" => $noteRow);
	//header('Content-Type: application/json');
	$send_data = json_encode($userRow);
	loader_display($send_data);
	loader_file_put_content('send_data','customer_registration',$send_data);
}

?>
