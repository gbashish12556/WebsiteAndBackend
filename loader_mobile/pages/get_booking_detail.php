<?php
	loader_file_put_content('post_data','get_booking_detail',$_REQUEST);
if(loader_post_isset("crn_no"))
{
    $userRow = array();
	$error_message = $success_message = $crn_no = "";
	$crn_no = loader_get_post_escape("crn_no");
	if("" == $crn_no)
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if(validate_crn_no($crn_no))
		{
			$where1 = " WHERE crn_no = '".$crn_no."'";
			$query1 = "SELECT customer_token,customer_name,contact_no,vehicletype_id,vehicle_name,datetime1,from_point,is_booked,is_active
						FROM view_booking_detail ".$where1." ";
			loader_file_put_content('query_data','get_booking_detail',$query1);
			if($result1 = loader_query($query1))
			{
				if(loader_num_rows($result1)>0)
				{
					$userRow['likes'] = array();
					$row = loader_fetch_assoc($result1);
					$userRow['likes'][0]['customer_token'] = $row['customer_token'];
					$userRow['likes'][0]['customer_name'] = $row['customer_name'];
					$userRow['likes'][0]['contact_no'] = $row['contact_no'];
					$userRow['likes'][0]['vehicletype_id'] = $row['vehicletype_id'];
					$userRow['likes'][0]['vehicle_name'] = "".$row['vehicle_name']."";
					$userRow['likes'][0]['datetime1'] = "".$row['datetime1']."";
					$userRow['likes'][0]['from_point'] = $row['from_point'];
					$userRow['likes'][0]['is_booked'] = $row['is_booked'];
					$userRow['likes'][0]['is_active'] = $row['is_active'];
					//$userRow['likes'][0]['driver_location_lat'] = $row['driver_location_lat'];
					//$userRow['likes'][0]['driver_location_lng'] = $row['driver_location_lng'];
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
			$error_message = CRN_INVALID;
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
	//loader_file_put_content('send_data','booking_status',$send_data);
}

?>
