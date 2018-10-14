<?php
loader_file_put_content('post_data','bill_generated',$_REQUEST);
if(loader_post_isset('user_token')&&loader_post_isset("crn_no")&&loader_post_isset("total_distance")&&loader_post_isset("total_time")&&loader_post_isset("total_fare")&&loader_post_isset("exact_pickup_point")&&loader_post_isset("exact_dropoff_point")&&loader_post_isset('base_fare')&&loader_post_isset('loading_start_time')&&loader_post_isset('unloading_end_time')&&loader_post_isset('journey_start_time')&&loader_post_isset('journey_end_time'))
{
	$userRow = array();
    $succsess_message = $error_message = $user_token = $crn_no = $total_distance = $total_fare = $exact_from_point = $exact_to_point = $total_time =$loading_start_time=$unloading_end_time=$journey_end_time=$journey_start_time= "";
    $user_token = loader_get_post_escape('user_token');
    $crn_no = loader_get_post_escape('crn_no');
    $total_distance = loader_get_post_escape('total_distance');
    $total_fare = loader_get_post_escape('total_fare');
    $total_time = loader_get_post_escape('total_time');
	$exact_from_point = loader_get_post_escape('exact_pickup_point');
	$exact_to_point = loader_get_post_escape('exact_dropoff_point');
	$base_fare = loader_get_post_escape('base_fare');

    if( ("" == $user_token)||("" == $crn_no)||("" == $total_distance)||("" == $total_fare)||("" == $total_time))
    {
      $error_message = MANDATORY_MISSING;
    }
    else
	{
		  if(validate_driver_token($user_token))
		  {
				loader_commit_off();
				$query1 = "UPDATE tbl_booking_detail SET fld_total_distance= '".$total_distance."',fld_exact_from_point= '".$exact_from_point."',fld_exact_to_point= '".$exact_to_point."',fld_total_fare = '".$total_fare."', fld_total_time = '".$total_time."',fld_is_completed = '1' WHERE fld_crn_no = '".$crn_no."' ";
				loader_file_put_content('query_data','bill_generated',$query2);
				$query2 = "SELECT customer_gcm_regid,customer_mobile_no FROM view_booking_detail WHERE crn_no = '".$crn_no."'";
				loader_file_put_content('query_data','bill_generated',$query2);
				$result1 = loader_query($query1);
				$result2 = loader_query($query2);
				loader_file_put_content('query_data','bill_generated',$query1);
				if($result1&&$result2)
				{
					if(loader_num_rows($result2)>0)
					{
						loader_commit_on();
						$success_message = UPDATE_SUCCESS;
						$row = loader_fetch_assoc($result2);
						$gcm_regid = $row['customer_gcm_regid'];
						$customer_mobile_no = $row['customer_mobile_no'];
						$msg = array
						(
						  'message' 	=> 'Please make the payment',
						  'title'		=> 'Bill Generated',
						  
						  'menuFragment' => 'FinishedBookingDetails',
						  'crn_no'	=>   $crn_no
						);
						loader_push_message($gcm_regid,$msg,'bill_generated');
						$mobile_msg ="Your Fare Rs.".$total_fare.". Minimum Fare of Rs ".$base_fare." is included. Toll and Taxes will be extra.Kindly pay the driver Rs ".$total_fare."+(Toll and Taxes).
   					(Distance - ".$total_distance." km Journey Time ".$total_time.")-TheShipper";
						loader_send_sms($mobile_msg,$customer_mobile_no,'bill_generated');
					}
					else
					{
						 loader_rollback();
					     $error_message = NO_MATCH_FOUND;
					}
				}
				else
				{
					loader_rollback();
				    $error_message = SERVER_ERROR;
				}
				loader_commit_on();
		  }
		  else
		  {
			$error_message = USER_INVALID;
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
  	loader_file_put_content('send_data','bill_generated',$send_data);

}
?>
