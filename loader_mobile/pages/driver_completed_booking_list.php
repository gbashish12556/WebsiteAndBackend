<?php

/*
	 ******  Created by:          Sourav Halder
	 ******  Last Edit Date:      20/05/2016
	 ******  Works Done:          Fetch future booking list any user and return as json data
*/

loader_file_put_content('post_data','driver_completed_booking_list',$_REQUEST);
if(loader_post_isset("user_token")&&loader_post_isset("page_no"))
{
    	$userRow = array();
	$error_message = $success_message = $user_token = $page_no = "";
	$user_token = loader_get_post_escape("user_token");
	$page_no = loader_get_post_escape("page_no");
	if(("" == $user_token)||("" == $page_no))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if(validate_driver_token($user_token))
		{
			$offset  = ($page_no*5);
			$where1 = "WHERE driver_token = '".$user_token."' AND customer_token != 'DefaultIsNothing' AND is_cancelled = '0' AND is_completed = '1'";
			$query1 = "SELECT crn_no, booking_datetime,vehicletype_id,from_point,to_point FROM view_booking_detail ".$where1." ORDER BY booking_datetime DESC LIMIT ".$offset.",100 ";
			loader_file_put_content('query_data','driver_completed_booking_list',$query1);
			if($result1 = loader_query($query1))
			{
				if(loader_num_rows($result1)>0)
				{
					$success_message = IS_SUCCESS;
					$i = 0;
					$userRow['likes'] = array();
					while($row = loader_fetch_assoc($result1))
					{
						$userRow['likes'][$i]['crn_no'] = $row['crn_no']."";
						$userRow['likes'][$i]['booking_datetime'] = $row['booking_datetime']."";
							$userRow['likes'][$i]['vehicletype_id'] = $row['vehicletype_id']."";
							$userRow['likes'][$i]['pickup_point'] = $row['from_point']."";
							$userRow['likes'][$i]['dropoff_point'] = $row['to_point']."";

						$i++;
					}
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
	loader_file_put_content('send_data','driver_completed_booking_list',$send_data);
}

?>