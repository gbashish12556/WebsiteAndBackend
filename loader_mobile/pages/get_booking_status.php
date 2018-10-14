<?php
	loader_file_put_content('post_data','get_booking_status',$_REQUEST);
if(loader_post_isset("user_token")&&loader_post_isset("crn_no"))
{
        $userRow = array();
	$error_message = $success_message = $crn_no = $user_token = "";
	$crn_no = loader_get_post_escape("crn_no");
	$user_token = loader_get_post_escape("user_token");
	if(("" == $user_token)||("" == $crn_no))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if(validate_user_token($user_token))
		{
			$where1 = " WHERE ((customer_token = '".$user_token."') AND (crn_no = '".$crn_no."'))";
			$query1 = "SELECT driver_location_datetime, driver_token,is_cancelled,booked_vehicle_id,is_active,
	                driver_vehicle_no,driver_name,driver_mobile_no,driver_location_lat,driver_location_lng,driver_profile_pic_url FROM view_booking_detail ".$where1." ";
			loader_file_put_content('query_data','get_booking_status',$query1);
			if($result1 = loader_query($query1))
			{
				if(loader_num_rows($result1)>0)
				{
					$userRow['likes'] = array();
					$row = loader_fetch_assoc($result1);
					$userRow['likes'][0]['driver_location_datetime'] = $row['driver_location_datetime']."";
					$userRow['likes'][0]['driver_token'] = $row['driver_token']."";
					$userRow['likes'][0]['is_cancelled'] = "".$row['is_cancelled']."";
					$userRow['likes'][0]['booked_vehicle_id'] = "".$row['booked_vehicle_id']."";
					$userRow['likes'][0]['is_active'] = "".$row['is_active']."";
					$userRow['likes'][0]['driver_vehicle_no'] = $row['driver_vehicle_no']."";
					$userRow['likes'][0]['driver_name'] = $row['driver_name']."";
					$userRow['likes'][0]['driver_mobile_no'] = $row['driver_mobile_no']."";
					if((NULL == $row['driver_profile_pic_url']) || ("" == $row['driver_profile_pic_url']))
					{ 
						$userRow["likes"][0]["driver_profile_pic_url"] = "";
					}
					else
					{
						$image_path  = ('upload/'.$row['driver_profile_pic_url']);
						if(loader_file_exists($image_path)) 
						{
							$userRow["likes"][0]["driver_profile_pic_url"] = $image_path.""; 
						}
						else
						{
							$userRow["likes"][0]["driver_profile_pic_url"]  = "";
						}
					} 
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
	loader_file_put_content('send_data','get_booking_status',$send_data);	 	  
}

?>
