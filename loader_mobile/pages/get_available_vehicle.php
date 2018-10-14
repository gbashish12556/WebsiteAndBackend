<?php
    loader_file_put_content('post_data','get_available_vehicle',$_REQUEST);
if(loader_post_isset("vehicle_type")&&loader_post_isset("current_lat")&&loader_post_isset("current_lng")){

    $userRow = array();

	$error_message = $success_message = $vehicletype_id = $current_lat =$current_lng = "";

	$vehicletype_id = loader_get_post_escape("vehicle_type");
	$current_lat = loader_get_post_escape("current_lat");
	$current_lng = loader_get_post_escape("current_lng");
	/*
	 ******  Edited by:           Sourav Halder
	 ******  Last Edit Date:      26/04/2016
	 ******  Works Done:          Validation of input data
	*/
	if(("" == $vehicletype_id)||("" == $current_lat)||("" == $current_lng))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
			if(validate_vehicletype($vehicletype_id))
			{
				if(loader_isValidLng($current_lng))
				{
					if(loader_isValidLat($current_lat))
					{
						$query1 ="SELECT DISTINCT location_lat,location_lng,
							( 3959 * acos( cos( radians('".$current_lat."')) * cos( radians(location_lat))
							* cos( radians(location_lng) - radians('".$current_lng."')) + sin(radians('".$current_lat."'))
							* sin( radians(location_lat)))) AS distance
							FROM view_driver_info
							WHERE vehicletype_id = '".$vehicletype_id."' AND is_busy = '0' AND is_active = '1'
							HAVING distance < ".GET_AVAILABLE_VEHILCE_RADIUS."
							ORDER BY distance ASC ";
						loader_file_put_content('query_data','get_available_vehicle',$query1);
						if($result1 = loader_query($query1))
						{
							loader_file_put_content('query_data','get_available_vehicle',"loader_num_rows".loader_num_rows($result1));
							if(0 < loader_num_rows($result1))
							{
								$userRow['likes'] = array();
								$success_message = IS_SUCCESS;
								$i = 0;
								while($row = loader_fetch_assoc($result1))
								{
									$userRow["likes"][$i]["location_lat"] = $row["location_lat"]."";
									$userRow["likes"][$i]["location_lng"] = $row["location_lng"]."";
									$i++;
								}
							}
							else
							{
								$success_message = NO_VEHICLE;
							}
						}
						else
						{
							$error_message = SERVER_ERROR;
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
				$error_message = VEHICLETYPE_INVALID;
			}
	}
	if($error_message == "")
	{
		$errFlag = "0";			// Success status
		$errMsg = $success_message;
		//$userRow['likes'][0]['isupdated'] = "1";
	}
	else
	{
		$errFlag = "1";			// Failure status
		$errMsg = $error_message;
		//$userRow['likes'][0]['isupdated'] = "0";
	}
	$userRow["errFlag"] = $errFlag."";
	$userRow["errMsg"] = $errMsg."";
	//$json = array("errFlag" => $errFlag, "errMsg" => $errMsg, "likes" => $noteRow);
	//header('Content-Type: application/json');
	$send_data = json_encode($userRow);
	loader_display($send_data);
	loader_file_put_content('send_data','get_available_vehicle',$send_data);



	}





?>
