<?php
//echo 'ashish';
loader_file_put_content('post_data','driver_notassigned',$_REQUEST);
if(loader_post_isset("owner_token")&&loader_post_isset("location_lat")&&loader_post_isset("location_lng"))
{

    $userRow = array();
	$error_message = $success_message = $location_lat = $location_lng = $user_token = "";
	$location_lat = 	loader_get_post("location_lat");
	$location_lng = 	loader_get_post_escape("location_lng");
	$user_token = 	loader_get_post_escape("owner_token");
	$curr_datetime = date("Y-m-d G:i:s");
	if(("" == $user_token))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if(validate_owner_token($user_token))
		{
			$query1 = "SELECT booked_vehicle_id, booking_datetime,customer_location_lat,customer_location_lng,crn_no,booking_datetime,vehicletype_id,from_point,to_point,( 3959 * acos( cos( radians('".$current_lat."')) * cos( radians(customer_location_lat))
						* cos( radians(customer_location_lng) - radians('".$current_lng."')) + sin(radians('".$current_lat."'))
						* sin( radians(customer_location_lat)))) AS distance 
						FROM view_booking_detail WHERE booked_vehicle_id = '0' 
						HAVING distance < ".MY_TRUCKS_RADIUS."
						ORDER BY distance ASC ";
			loader_file_put_content('query_data','driver_notassigned',$query1);
			if(loader_query($query1))
			{
				$result1 = loader_query($query1);
						loader_file_put_content('query_data','driver_notassigned',"query_run");
						if(loader_num_rows($result1)>0){
							loader_file_put_content('query_data','driver_notassigned',"rows_returned");
							$userRow['likes'] = array();
							$success_message = IS_SUCCESS;
							$i = 0;
							while($row = loader_fetch_assoc($result1))
							{
								$userRow['likes'][$i]['crn_no'] = $row['crn_no']."";
						$userRow['likes'][$i]['booking_datetime'] = $row['booking_datetime']."";
            	$userRow['likes'][$i]['vehicletype_id'] = $row['vehicletype_id']."";
							$userRow['likes'][$i]['pickup_point'] = $row['from_point']."";
							$userRow['likes'][$i]['dropoff_point'] = $row['to_point']."";

								
								$i++;
							}
				$success_message = UPDATE_SUCCESS;
			}
			else
			{
				$error_message = SERVER_ERROOR;
			}
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
	loader_file_put_content('send_data','driver_notassigned',$send_data);
}
?>
