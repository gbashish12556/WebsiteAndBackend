<?php

	loader_file_put_content('post_data','update_customer_location',$_REQUEST);
if(loader_post_isset("user_token")&&loader_post_isset("location_lat")&&loader_post_isset("location_lng"))
{
    $userRow = array();
	$error_message = $success_message = $location_lat = $location_lng = $user_token = "";
	$location_lat = 	loader_get_post("location_lat");
	$location_lng = 	loader_get_post_escape("location_lng");
	$user_token = 	loader_get_post_escape("user_token");
	$curr_datetime = date("Y-m-d G:i:s");
	if(("" == $user_token))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if(validate_user_token($user_token))
		{
			$query1 = "UPDATE tbl_customer_info SET fld_location_lat = '".$location_lat."',fld_location_lng ='".$location_lng."' , fld_location_datetime = '".$curr_datetime."'  WHERE fld_user_token = '".$user_token."' ";
			loader_file_put_content('query_data','update_customer_location',$query1);
			if(loader_query($query1))
			{
				$success_message = UPDATE_SUCCESS;
			}
			else
			{
				$error_message = SERVER_ERROOR;
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
	loader_file_put_content('send_data','update_customer_location',$send_data);
}
?>
