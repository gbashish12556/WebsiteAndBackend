<?php
	loader_file_put_content('post_data','accept_booking',$_REQUEST);
if(loader_post_isset('user_token')&&loader_post_isset("crn_no")&&loader_post_isset("accept_flag"))
{
	$userRow = array();
    $succsess_message = $error_message = $user_token = $crn_no = $accept_flag = "";
	loader_file_put_content('post_data','accept_booking',$_REQUEST);
    $user_token = loader_get_post_escape('user_token');
    $crn_no = loader_get_post_escape('crn_no');
    $accept_flag = loader_get_post_escape('accept_flag');

    if( (""== $user_token)||("" == $crn_no)||(""== $accept_flag))
    {
      $error_message = MANDATORY_MISSING;
    }
    else {
      if(validate_driver_token($user_token))
      {
          if($accept_flag == 1) //When accept_flag = 1
          {
              $query1 = "SELECT fld_driver_ai_id FROM tbl_driver_info WHERE fld_user_token = '".$user_token."'";
              loader_file_put_content('query_data','accept_booking',$query1);
              if($result1 = loader_query($query1))
              {
			$row = loader_fetch_assoc($result1);
			$id = $row['fld_driver_ai_id'];
			$query2 = "UPDATE tbl_booking_detail SET fld_booked_vehicle_id = '".$id."'  WHERE fld_crn_no= '".$crn_no."' ";
			loader_file_put_content('query_data','accept_booking',$query2);
			if(loader_query($query2))
			{
				$query3 = "SELECT fld_customer_token FROM tbl_booking_detail WHERE fld_crn_no= '".$crn_no."'";
				loader_file_put_content('query_data','accept_booking',$query3);
				if($result2= loader_query($query3))
				{
					$row2 = loader_fetch_assoc($result2);
					$customer_token = $row2['fld_customer_token'];
					$query4 = "SELECT fld_gcm_regid FROM tbl_customer_info WHERE fld_user_token = '".$customer_token."'";
					loader_file_put_content('query_data','accept_booking',$query4);
					if($result3 = loader_query($query4))
					{
						$row3 = loader_fetch_assoc($result3);
						$gcm_regid = $row3['fld_gcm_regid'];
						$msg = array
						(
						  'message' 	=> 'Truck Allocated to you booking',
						  'title'		=> 'Truck Allocated',
						  
						  'menuFragment' => 'BookingDetails',
						  'crn_no'	=> $crn_no
						);

						loader_push_message($gcm_regid,$msg,'accept_booking');


					}

				}
				 $success_message = UPDATE_SUCCESS;
			}
			else
			{
			  $error_message= SERVER_ERROR;
			}
              }
              else
			  {
                $error_message = SERVER_ERROR;
              }
          }
          else
		  {
              $query3 = "SELECT customer_location_lat, customer_location_lng FROM view_booking_detail WHERE crn_no = '".$crn_no."'";
              loader_file_put_content('query_data','accept_booking',$query3);
              if($result3 = loader_query($query3))
              {
                $row1 = loader_fetch_assoc($result3);
                $customer_lat = $row1['customer_location_lat'];
                $customer_lng = $row1['customer_location_lng'];
                $query4 =  "SELECT fld_driver_ai_id, ( 3959 * acos( cos( radians('".$customer_lat."') ) * cos( radians(fld_location_lat ) ) *
                cos( radians( fld_location_lng ) - radians('".$customer_lng."') ) + sin( radians( '".$customer_lat."') ) *
                sin( radians( fld_location_lat ) ) ) ) AS distance FROM tbl_driver_info   WHERE (fld_user_token <> '".$user_token."')  ORDER BY distance ";
                loader_file_put_content('query_data','accept_booking',$query4);
                if($result4 = loader_query($query4))
                {
                  if(loader_num_rows($result4>0))
                  {
                    $row2 = loader_fetch_assoc($result4);
                    $id = $row2['fld_driver_ai_id'];
                    $query5 = "UPDATE tbl_booking_detail SET fld_booked_vehicle_id = '".$id."' WHERE fld_crn_no= '".$crn_no."'";
                    loader_file_put_content('query_data','accept_booking',$query5);
                    if(loader_query($query5))
                    {

						$success_message =  UPDATE_SUCCESS;
                    }
                    else
					{
                    	$error_message = SERVER_ERROR;
                    }
                  }
                  else {
                    $success_message = NO_MATCH_FOUND;
                  }
                }
                else {
                  $error_message = SERVER_ERROR;
                }
              }
              else {
                $error_message = SERVER_ERROR;
              }
          }
      }
      else {
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


    $send_data = json_encode($userRow);
    loader_display($send_data);
    loader_file_put_content('send_data','accept_booking',$send_data);
}


?>
