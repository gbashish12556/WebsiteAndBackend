<?php
	loader_file_put_content('post_data','book_now',$_REQUEST);
if(loader_post_isset("user_token")&&loader_post_isset("vehicle_type")&&loader_post_isset("datetime"))
{
    $userRow = array();
	$error_message = $success_message = $datetime = $vehicle_type = $user_token = "";
	$datetime = 	 loader_get_post_escape("datetime");
	$vehicle_type =  loader_get_post_escape("vehicle_type");
	$user_token = 	 loader_get_post_escape("user_token");
	//$date = DateTime::createFromFormat('d/m/Y g:i a',$datetime);
    //$datetime = $datetime->format('Y-m-d H:i:s');
    /*
	 ******  Edited by:           Sourav Halder
	 ******  Last Edit Date:      22/04/2016
	 ******  Works Done:          Validation of input data
	*/
	if(("" == $user_token)||("" == $datetime)||("" == $vehicle_type))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if(validate_user_token($user_token))
		{
			if(loader_validateDate($datetime,"Y-m-d H:i:s"))
			{
				if(validate_vehicletype($vehicle_type))
				{
					$crn_no = 'CRN'.strtotime($datetime);
					$query1 = "INSERT INTO tbl_booking_now
						(fld_customer_token,fld_booking_datetime,fld_vehicletype_id,fld_crn_no)
						VALUES('".$user_token."', '".$datetime."', '".$vehicle_type."', '".$crn_no."')";
					loader_file_put_content('query_data','book_now',$query1);
					if($result = loader_query($query1))
					{
						$userRow['likes'] = array();
						$userRow["likes"][0]["crn_no"] =  $crn_no ;
						$success_message = UPDATE_SUCCESS;
					}
					else
					{
						$error_message = SERVER_ERRROR;
					}
				}
				else
				{
					$error_message = VEHICLETYPE_INVALID;
				}
			}
			else
			{
				$error_message = DATETIME_INVALID;
			}
		}
		else
		{
			$error_message = USER_INVALID;
		}
	}
	//SEND JSON DATA
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
	loader_file_put_content('send_data','book_now',$send_data);
}

?>
