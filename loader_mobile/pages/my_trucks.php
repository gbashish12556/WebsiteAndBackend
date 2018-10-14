<?php
	loader_file_put_content('post_data','my_trucks',$_REQUEST);
if(loader_post_isset("current_lat")&&loader_post_isset("current_lng")&&loader_post_isset("user_token"))
{
        $userRow = array();
	$error_message = $success_message = $current_lat = $current_lng=$user_token= "";
	$current_lat = 	loader_get_post("current_lat");
	$current_lng = 	loader_get_post_escape("current_lng");
	$user_token = 	loader_get_post_escape("user_token");
	//$curr_datetime = date("Y-m-d h:i:sa");
	if(("" == $current_lat)||("" == $current_lng)||("" == $user_token))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if(validate_owner_token($user_token))
			{
				if(loader_isValidLng($current_lng))
				{
					if(loader_isValidLat($current_lat))
					{
						$query1 ="SELECT  name, vehicletype_id,mobile_no,location_lat,location_lng,
						( 3959 * acos( cos( radians('".$current_lat."')) * cos( radians(location_lat))
						* cos( radians(location_lng) - radians('".$current_lng."')) + sin(radians('".$current_lat."'))
						* sin( radians(location_lat)))) AS distance
						FROM view_driver_info
						WHERE is_active = '1' AND owner_token = '".$user_token."'
						HAVING distance < ".MY_TRUCKS_RADIUS."
						ORDER BY distance ASC ";
						loader_file_put_content('query_data','my_trucks',$query1);
					if(loader_query($query1))
					{
						$result1 = loader_query($query1);
						loader_file_put_content('query_data','my_trucks',"query_run");
						if(loader_num_rows($result1)>0){
							loader_file_put_content('query_data','my_trucks',"rows_returned");
							$userRow['likes'] = array();
							$success_message = IS_SUCCESS;
							$i = 0;
							while($row = loader_fetch_assoc($result1))
							{
								$userRow["likes"][$i]["name"] = $row["name"]."";
								$userRow["likes"][$i]["mobile_no"] = $row["mobile_no"]."";
								$userRow["likes"][$i]["vehicletype_id"] = $row["vehicletype_id"]."";
								$userRow["likes"][$i]["location_lat"] = $row["location_lat"]."";
								$userRow["likes"][$i]["location_lng"] = $row["location_lng"]."";
								$i++;
							}
				
					}else
					{
						$success_message = NO_VEHICLE;	
					}
					}
					else
					{
						$error_message = SERVER_ERROOR;
					}
					}
					else
					{
						$error_message = LAT_INVALID;
					}
				}
				else
				{
					$error_message = LNG_INVALID;
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
	loader_file_put_content('send_data','my_trucks',$send_data);	 	
}
?>