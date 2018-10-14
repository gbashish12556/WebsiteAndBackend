<?php
	loader_file_put_content('post_data','get_driver_completed_booking_status',$_REQUEST);
if(loader_post_isset('user_token')&&loader_post_isset('crn_no'))
{
	$userRow = array();
    $success_message = $error_message = $user_token = $crn_no =  "";
    $user_token = loader_get_post_escape('user_token');
    $crn_no = loader_get_post_escape('crn_no');
    if( (""== $user_token)||("" == $crn_no))
    {
      $error_message = MANDATORY_MISSING;
    }
    else
    {

      if(validate_driver_token($user_token))
      {
		 $query2 = "SELECT booking_id, crn_no, from_point, to_point, exact_from_point, exact_to_point, booking_datetime,vehicletype_id,total_fare,customer_name,customer_mobile_no,customer_rating,material_image,loading_start_time,unloading_end_time,journey_start_time,journey_end_time
		           FROM view_booking_detail WHERE crn_no = '".$crn_no."' AND (booked_vehicle_id != 0) AND(is_completed=1)  ";
		 loader_file_put_content('query_data','get_driver_completed_booking_status',$query2);
		 if($result2 = loader_query($query2))
		 {
			if(loader_num_rows($result2)>0)
			{
				  $row2 = loader_fetch_assoc($result2);
				  $userRow['likes'] = array();
				  $userRow['likes'][0]["crn_no"] = $row2['crn_no']."";

				  $userRow['likes'][0]["pickup_point"] = $row2['from_point']."";
				  $userRow['likes'][0]["dropoff_point"] = $row2['to_point']."";

				  $userRow['likes'][0]["exact_pickup_point"] = $row2['exact_from_point']."";
				  $userRow['likes'][0]["exact_dropoff_point"] = $row2['exact_to_point']."";
				  
				  $userRow['likes'][0]["booking_datetime"] = $row2['booking_datetime']."";
				  $userRow['likes'][0]["vehicletype_id"] = $row2['vehicletype_id']."";
				  $userRow['likes'][0]["total_fare"] = $row2['total_fare']."";
				  $userRow['likes'][0]["customer_name"] = $row2['customer_name']."";
				  $userRow['likes'][0]["customer_mobile_no"] = $row2['customer_mobile_no']."";
					$userRow['likes'][0]["booking_id"] = $row2['booking_id']."";
					if((NULL == $row2['material_image']) || ("" == $row2['material_image']))
					{ 
						$userRow["likes"][0]["material_image_url"] = "";
					}
					else
					{
						$image_path  = ('upload/'.$row2['material_image']);
						if(loader_file_exists($image_path)) 
						{
							$userRow["likes"][0]["material_image_url"] = $image_path.""; 
						}
						else
						{
							$userRow["likes"][0]["material_image_url"]  = "";
						}
					} 
					if(is_null($row2['customer_rating']))
					{
						$userRow['likes'][0]['customer_rating'] = 0;
					}
					else
					{
						$userRow['likes'][0]['customer_rating'] = $row2['customer_rating'];
					}
				  $success_message = MATCH_FOUND;
			}
			else {
			  $error_message = NO_MATCH_FOUND;
			}
		 }
		 else {
		   $error_message = SERVER_ERROR;
		 }
      }
      else
	  {
        $error_message = USER_INVALID;
      }
    }
}

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
loader_file_put_content('send_data','get_driver_completed_booking_status',$send_data);


?>
