<?php
	loader_file_put_content('post_data','get_city',$_REQUEST);
if(loader_post_isset("current_lat")&&loader_post_isset("current_lng"))
{
        $userRow = array();
	$error_message = $success_message = $current_lat = $current_lng= "";
	$current_lat = 	loader_get_post("current_lat");
	$current_lng = 	loader_get_post_escape("current_lng");
	//$curr_datetime = date("Y-m-d h:i:sa");
	if(("" == $current_lat)||("" == $current_lng))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		$query1 ="SELECT DISTINCT city_id,
			( 3959 * acos( cos( radians('".$current_lat."')) * cos( radians(city_lat))
			* cos( radians(city_lng) - radians('".$current_lng."')) + sin(radians('".$current_lat."'))
			* sin( radians(city_lat)))) AS distance
			FROM view_city
			WHERE is_active = '1'
			HAVING distance < ".GET_CITY_RADIUS."
			ORDER BY distance ASC LIMIT 0,1 ";
		loader_file_put_content('query_data','get_city',$query1);
		if(loader_query($query1))
		{
			$result1 = loader_query($query1);
	        	loader_file_put_content('query_data','get_city',"query_run");
			if(loader_num_rows($result1)>0){
		        	loader_file_put_content('query_data','get_city',"rows_returned");
				$userRow['likes'] = array();
				$row = loader_fetch_assoc($result1);
				$userRow["likes"][0]["city_id"] =  $row['city_id']."";
				$success_message = IS_SUCCESS;
			}else
			{
			   $success_message = IS_SUCCESS;	
			}
		}
		else
		{
			$error_message = SERVER_ERROOR;
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
	loader_file_put_content('send_data','get_city',$send_data);	 	
}
?>