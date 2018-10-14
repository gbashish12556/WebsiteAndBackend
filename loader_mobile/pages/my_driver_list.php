<?php
	loader_file_put_content('post_data','my_driver_list',$_REQUEST);
if(loader_post_isset("user_token")&&loader_post_isset("page_no"))
{
        $userRow = array();
	$error_message = $success_message = $page_no = $user_token = "";
	$page_no = loader_get_post_escape("page_no");
	$user_token = loader_get_post_escape("user_token");
	if(("" == $user_token)||("" == $page_no))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if(validate_owner_token($user_token))
		{
			$offset = ($page_no*5);
			$where1 = " WHERE ((owner_token = '".$user_token."'))";
			$query1 = "SELECT driver_vehicle_no,driver_name,driver_token,vehicletype_id FROM view_booking_detail ".$where1." ORDER BY vehicletype_id DESC LIMIT ".$offset.",5 ";
			loader_file_put_content('query_data','my_driver_list',$query1);
			if($result1 = loader_query($query1))
			{
				$result1 = loader_query($query1);
				loader_file_put_content('query_data','my_driver_list',"query_run");
				if(loader_num_rows($result1)>0)
				{
					loader_file_put_content('query_data','my_driver_list',"rows_returned");
					$userRow['likes'] = array();
					$i = 0;
					while($row = loader_fetch_assoc($result1))
					{
						$userRow["likes"][$i]["driver_name"] = $row["driver_name"]."";
						$userRow["likes"][$i]["vehicletype_id"] = $row["vehicletype_id"]."";
						
						$userRow["likes"][$i]["driver_vehicle_no"] = $row["driver_vehicle_no"]."";
						
						$userRow["likes"][$i]["driver_token"] = $row["driver_token"]."";
						$i++;
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

	$send_data = json_encode($userRow);
	loader_display($send_data);
	loader_file_put_content('send_data','my_driver_list',$send_data);	 	  
}

?>
