<?php
	loader_file_put_content('post_data','my_driver_details',$_REQUEST);
if(loader_post_isset("driver_token"))
{
        $userRow = array();
	$error_message = $success_message = $driver_token = "";
	
	$driver_token = loader_get_post_escape("driver_token");
	if(("" == $driver_token))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if(validate_driver_token($driver_token))
		{
			$where1 = " WHERE ((driver_token = '".$driver_token."'))";
			$query1 = "SELECT driver_location_datetime,driver_name,driver_mobile_no,driver_location_lat,driver_location_lng FROM view_booking_detail ".$where1." ";
			loader_file_put_content('query_data','my_driver_details',$query1);
			if($result1 = loader_query($query1))
			{
				if(loader_num_rows($result1)>0)
				{
					$userRow['likes'] = array();
					$row = loader_fetch_assoc($result1);
					$userRow['likes'][0]['driver_location_datetime'] = $row['driver_location_datetime']."";
					
					
					
					
					$userRow['likes'][0]['driver_name'] = $row['driver_name']."";
					$userRow['likes'][0]['driver_mobile_no'] = $row['driver_mobile_no']."";
					
					$userRow['likes'][0]['driver_location_lat'] = $row['driver_location_lat']."";
					$userRow['likes'][0]['driver_location_lng'] = $row['driver_location_lng']."";
					$success_message = MATCH_FOUND;
				}
			else
			{
				$success_message = NO_MATCH_FOUND;
			}
			}
			else
			{
				$error_message = SERVER_ERROR;
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
	loader_file_put_content('send_data','my_driver_details',$send_data);	 	  
}

?>
