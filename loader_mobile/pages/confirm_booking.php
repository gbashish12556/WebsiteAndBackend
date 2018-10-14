<?php
//ini_set('allow_url_fopen', 'On');

function find_min_distance($user_token, $msg, $vehicle_type)
{
	$query1= "SELECT fld_location_lat , fld_location_lng FROM tbl_customer_info WHERE fld_user_token = '".$user_token."' ";
	loader_file_put_content('query_data','confirm_booking',$query1);
	if($result1 = loader_query($query1))
	{
		if(loader_num_rows($result1)>0){
				$row1 = loader_fetch_assoc($result1);
				$user_lat = $row1['fld_location_lat'];
				$user_lng =$row1['fld_location_lng'];
				$query2 =  "SELECT fld_gcm_regid, (3959*acos(cos(radians('".$user_lat."'))*cos(radians(fld_location_lat))*
				cos(radians(fld_location_lng) - radians('".$user_lng."') ) + sin(radians('".$user_lat."'))*
				sin(radians(fld_location_lat)))) AS 'distance' FROM tbl_driver_info
				WHERE (fld_vehicletype_id = '".$vehicle_type."') AND  (fld_is_busy = '0') AND (fld_is_active = '1')
				HAVING distance < ".GET_AVAILABLE_VEHILCE_RADIUS."
				ORDER BY distance ASC LIMIT 0,1 ";
				loader_file_put_content('query_data','confirm_booking',$query2);
				if($result2= loader_query($query2))
				{
					if(loader_num_rows($result2)>0){
						$row2 = loader_fetch_assoc($result2);
						$device_id = $row2['fld_gcm_regid'];
						loader_push_message($device_id, $msg, 'confirm_booking');
				    }
				}
				else
				{
					$error_message= SERVER_ERROR;
				}
		}		
	}
	else
	{
		$error_message= SERVER_ERROR;
	}
}
	loader_file_put_content('post_data','confirm_booking',$_REQUEST);
if(loader_post_isset('user_token')&&loader_post_isset('vehicle_type')&&loader_post_isset('pickup_point')&&loader_post_isset('dropoff_point')&&loader_post_isset('booking_date')&&loader_post_isset('total_distance')&&loader_post_isset('fare_min')&&loader_post_isset('fare_max')&&loader_post_isset('total_time')&&loader_post_isset("material_image")&&loader_post_isset("material_weight"))
{
	$userRow = array();
    $succsess_message = $error_message = $crn_no = $vehicle_type = $tot_time = $pickup_point = $drop_point = $datetime = $distance = $fare_min = $fare_max =  $user_token = $material_weight = $material_image = "";
    $user_token = loader_get_post_escape('user_token');
	$row = get_customer($user_token);
    if("" == $row)
    {
      $error_message = SERVER_ERROR;
    }
    else
    {
		$name = $row['name'];
		$mobile_no = $row['mobile_no'];
		$vehicle_type = loader_get_post_escape('vehicle_type');
		$pickup_point = loader_get_post_escape('pickup_point');
		$drop_point = loader_get_post_escape('dropoff_point');
		$datetime = loader_get_post_escape('booking_date');
		$distance = loader_get_post_escape('total_distance');
		$fare_min = loader_get_post_escape('fare_min');
		$fare_max = loader_get_post_escape('fare_max');
		$tot_time = loader_get_post_escape('total_time');
		$material_image = 	loader_get_post("material_image");
		$material_weight = 	loader_get_post("material_weight");
		if(("" == $name)||("" == $mobile_no)||("" == $datetime)||("" == $vehicle_type)||("" == $pickup_point)||("" == $drop_point)||("" == $distance)||("" == $fare_min)||("" ==$fare_max)||("" == $tot_time)||("" == $material_image)||("" == $material_weight))
		{
				$error_message = MANDATORY_MISSING;
		}
		else
		{
			if(loader_isValidDateTime($datetime))
			{
			   $date = DateTime::createFromFormat('d/m/Y g:i a',$datetime);
			   $datetime = $date->format('Y-m-d H:i:s');
			   if(validate_vehicletype($vehicle_type))
			   {
				   $img = $material_image; //to get img from post...
						$img = str_replace('data:image/jpg;base64,', '', $img);
						$img = str_replace(' ', '+', $img);
						$data = base64_decode($img);
						$material_image = time()."shipper_".$user_token.'.jpg';
						$file = "upload/".$material_image;
						$success = file_put_contents($file, $data);

					$actual_time = "";
					$fare_min = $actual_time_value = $fare_max = $fare = $distance = $base_fare =  0;
					$from = urlencode($pickup_point);
					$to = urlencode($drop_point);
					$data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=en-EN&sensor=false");
					$data = json_decode($data);
					//echo $data;
					$actual_time = "";
					$distance = 0;
					foreach($data->rows[0]->elements as $road) {
							$actual_time .= $road->duration->text;
							$actual_time_value += $road->duration->value;
							$distance += $road->distance->value;
					}
					$distance = $distance/1000;
					//echo 'distance'.$distance;
					//$hr = intval($time/3600);
					//$min  = intval(($time%3600)/60);
					//$actual_time= $hr.' hr '.$min.' min';
					$travel_min  = intval(($actual_time_value)/60);
					$dummy_distance = $distance;
					//echo 'travel_min'.$travel_min;
					//base fare calculation
					$where = " WHERE vehicletype_id = '".$vehicle_type."' ";
					$query = "SELECT base_fare, transit_charge, freewaiting_time FROM view_base_fare ".$where." ";
					loader_file_put_content('query_data','confirm_booking',$query);
					//echo  $query;
					if($result = loader_query($query))
					{
						$row = loader_fetch_assoc($result);
						$base_fare = $row['base_fare'];
						$transit_charge = $row['transit_charge'];
						$freewaiting_time = $row['freewaiting_time'];
						//echo 'freewaiting_time'.$freewaiting_time;
						$base_fare_min = $row['base_fare']+$travel_min*$row['transit_charge'];
						$base_fare_max = $row['base_fare']+$travel_min*$row['transit_charge']*2.5;
						//pricing calculation
						$where = " WHERE vehicletype_id = '".$vehicle_type."' ";
						$pricing_query = "SELECT from_distance, to_distance, price_km FROM view_pricing ".$where." ORDER BY to_distance ASC ";
						loader_file_put_content('query_data','confirm_booking',$pricing_query);
						//echo $pricing_query;
						if($result = loader_query($pricing_query))
						{
							//$fare  = $base_fare;
							//echo $fare;
							while($row = loader_fetch_assoc($result))
							{
								 $dist_gap = ($row['to_distance'] - $row['from_distance']);
								 if($dummy_distance > 0)
								 {
									 if($dummy_distance > $dist_gap)
									 {
											 $fare = $fare+ $dist_gap*$row['price_km'];
										 //echo $fare;
											 $dummy_distance = $dummy_distance-$dist_gap;
									 }
									 else
									 {
											 $fare = $fare+$dummy_distance*$row['price_km'];
											 //echo $fare;
											 $dummy_distance = 0;
									 }
								 }
							}
						   $fare_min = $fare+$base_fare_min;
						   $fare_max = $fare+$base_fare_max;
						}
						else
						{
								$error_message = SERVER_ERROR;
						}
					}
					else
					{
						$error_message = SERVER_ERROR;
					}
			   }
			   else
			   {
				   $error_message = VEHICLETYPE_INVALID;
			   }
			}
			else
			{
				$error_message = DATETIME_INVALID;
			}
			if(("" == $error_message)&&(0 != $distance)&&($fare >0))
			{
				 loader_commit_off();
				 $crn_no = 'CRN'.strtotime($datetime);
				 $insert_query = "INSERT INTO tbl_booking_detail (fld_vehicletype_id, fld_from_point, fld_to_point,
								 fld_customer_name, fld_contact_no, fld_total_distance, fld_fare_min, fld_fare_max, fld_total_time, fld_crn_no, fld_customer_token,fld_booking_datetime,fld_material_image,fld_material_weight)
								 VALUES('".$vehicle_type."', '".$pickup_point."', '".$drop_point."'
								 , '".$name."', '".$mobile_no."', '".$distance."', '".$fare_min."', '".$fare_max."', '".$actual_time."','".$crn_no."','".$user_token."','".$datetime."','".$material_image."','".$material_weight."')";
				loader_file_put_content('query_data','confirm_booking',$insert_query);
				//echo $insert_query;
				$result1 = loader_query($insert_query)	;
				$booking_id = loader_last_inserted();
				if($result1)
				{
					$msg = array
					(
						'message' 	=> 'New Booking in your Area',
						'title'		=> 'New Booking',
						'menuFragment' => 'NewBooking',
						'crn_no'	=> $crn_no,

					);
					find_min_distance($user_token, $msg, $vehicle_type);
					$userRow['likes'] = array();
					$userRow['likes'][0]['crn_no'] = $crn_no."";
					$success_message = 'Booked successfully .Your Booking ID for tracking is '.$crn_no;
					loader_set_session('form_session','processed');
					//echo 'OR NOT'.loader_get_session('form_session');
					 $booking_confirm_message = 'Thank you for booking with us. Your order ID is '.$crn_no.' . '.$freewaiting_time.' minute for loading plus unloading is free, post that Rs '.$transit_charge.' per minute is applicable. Tolls and Parking charges are also applicable. Please track your order on www.theshipper.co.in/track_order';
					 $new_booking_message = 'New booking-CRN:'.$crn_no.' pickup_point: '.$pickup_point.'<br>drop_off_point: '.$drop_point.'<br> distance: '.$distance.'<br>fare: '.$fare_max.'<br>mobile: '.$mobile_no.'<br>vehicle_type: '.$vehicle_type;
					 loader_send_sms($booking_confirm_message, $mobile_no,'confirm_booking');
					 loader_send_promotional_sms($new_booking_message,ADMIN_MOBILE_NO,'confirm_booking');
					 $recipient = COMPANY_EMAIL;
					 $subject = 'New booking'.$crn_no;
					 $customer_name = $name;
					 $email = $mobile_no;
					 $message = 'pickup_point: '.$pickup_point.'<br>drop_off_point: '.$drop_point.'<br> distance: '.$distance.'<br>fare: '.$fare_max.'<br>vehicle_type: '.$vehicle_type;
					$template_data_array = array("SUBJECT","NAME","MAIL","MESSAGE");
					$template_value_array = array($subject,$customer_name,$email,$message);
					global $mailTemplate;
					$send = loader_send_mail($mailTemplate['contactus_content'],$template_data_array,$template_value_array,$recipient,$email,$mailTemplate['contactus_subject']);
					 loader_commit();
				}
				else
				{
					$error_message .= SERVER_ERROR;
					loader_rollback();
				}
				loader_commit_on();
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
	loader_file_put_content('send_data','confirm_booking',$send_data);
}
?>
