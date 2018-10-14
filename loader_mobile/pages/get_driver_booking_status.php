<?php
	loader_file_put_content('post_data','get_driver_booking_status',$_REQUEST);
if(loader_post_isset("user_token")&&loader_post_isset("crn_no"))
{
        $userRow = array();
	$error_message = $success_message = $crn_no =$user_token = "";
	$crn_no = loader_get_post_escape("crn_no");
	$user_token = loader_get_post_escape("user_token");
	if(("" == $user_token)||("" == $crn_no))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if(validate_driver_token($user_token))
		{
			$where1 = " WHERE ((driver_token = '".$user_token."') AND (crn_no = '".$crn_no."'))";
			$query1 = "SELECT customer_token,customer_location_datetime,
	                   customer_name,customer_mobile_no,customer_location_lat,customer_location_lng,material_image FROM view_booking_detail ".$where1." ";
			loader_file_put_content('query_data','get_driver_booking_status',$query1);
			if($result1 = loader_query($query1))
			{
				if(loader_num_rows($result1)>0)
				{
					$userRow['likes'] = array();
					$row = loader_fetch_assoc($result1);
					$userRow['likes'][0]['crn_no'] = $crn_no."";
					$userRow['likes'][0]['customer_location_datetime'] = $row['customer_location_datetime']."";
					$userRow['likes'][0]['customer_token'] = $row['customer_token']."";
					$userRow['likes'][0]['customer_name'] = $row['customer_name']."";
					$userRow['likes'][0]['customer_mobile_no'] = $row['customer_mobile_no']."";
					$userRow['likes'][0]['customer_location_lat'] = $row['customer_location_lat']."";
					$userRow['likes'][0]['customer_location_lng'] = $row['customer_location_lng']."";
					if((NULL == $row['material_image']) || ("" == $row['material_image']))
					{ 
						$userRow["likes"][0]["material_image_url"] = "";
					}
					else
					{
						$image_path  = ('upload/'.$row['material_image']);
						if(loader_file_exists($image_path)) 
						{
							$userRow["likes"][0]["material_image_url"] = $image_path.""; 
						}
						else
						{
							$userRow["likes"][0]["material_image_url"]  = "";
						}
					} 
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
	loader_file_put_content('send_data','get_driver_booking_status',$send_data);
}

?>
