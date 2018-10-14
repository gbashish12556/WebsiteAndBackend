<?php
ini_set('allow_url_fopen', 'On');

if(loader_post_isset('confirm_booking'))
{
	$error_message = $fare =  $name = $vehicle_type =  $mobile_no =  $drop_point = $pickup_point =  $distance = $fare_max =  $fare_min = $session =  ""; 
   if(loader_session_isset('username'))
   {
	   $user_token = loader_get_session('user_token');
   }
   else
   {
	   $user_token = 'DefaultIsNothing';
   }
    $name = loader_ucwords(loader_get_post_escape('name'));
    $vehicle_type = loader_get_post_escape('vehicle_type');
    $mobile_no = loader_get_post_escape('mobile_no');
    $pickup_point = loader_get_post_escape('pickup_point');
    $drop_point = loader_get_post_escape('drop_point');
	$datetime = loader_get_post_escape('datetime');
    $distance = loader_get_post_escape('distance');
    $fare_min = loader_get_post_escape('fare_min');
	 $fare_max = loader_get_post_escape('fare_max');
	$session = loader_get_post_escape('session');
	if($session == loader_get_session('form_session'))
	{
		if(("" == $name)||("" == $mobile_no)||("" == $datetime)||("" == $vehicle_type)||("" == $pickup_point)||("" == $drop_point)||("" == $distance)||("" == $fare_min)||("" == $fare_max))
		{
				$error_message = MANDATORY_MISSING;
		}
		else
		{
			if((strlen($name)>NAME_MAXLEN)||(strlen($mobile_no)>MOBILE_MAXLEN)||(strlen($mobile_no)<MOBILE_MINLEN))
			{
				$error_message = WRONG_HAPPEN;
			}
			else
			{
				if(loader_isValidDateTime($datetime))
				{
				   		   $date = DateTime::createFromFormat('d/m/Y g:i a',$datetime);
						   $datetime = $date->format('Y-m-d H:i:s');
				   if(validate_phone_number($mobile_no))
				   {
					   if(validate_vehicletype($vehicle_type))
					   {
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
					   $error_message = MOBILE_INVALID;
				   }
				}
				else
				{
					$error_message = DATETIME_INVALID;
				}

			}
			if(("" == $error_message)&&(0 != $distance)&&($fare >0))
			{
				 loader_commit_off();
				 //$crn_no = 'CRN'.strtotime($datetime);
				 $crn_no = 'CRN'.time();
				 $insert_query = "INSERT INTO tbl_booking_detail (fld_vehicletype_id,fld_customer_token, fld_from_point, fld_to_point,
								 fld_customer_name, fld_contact_no,fld_booking_datetime, fld_total_distance, fld_fare_min, fld_fare_max, fld_crn_no)
								 VALUES('".$vehicle_type."','".$user_token."', '".$pickup_point."', '".$drop_point."', '".$name."', '".$mobile_no."', '".$datetime."', '".$distance."', '".$fare_min."', '".$fare_max."','".$crn_no."')";
				//echo $insert_query;
				$result1 = loader_query($insert_query)	;
				$booking_id = loader_last_inserted();

					//echo "enter";
				/*$query2 = "INSERT IGNORE INTO tbl_nearest_vehicle (fld_booking_id, fld_vehicle_id, fld_vehicletype_id, fld_driver_name, fld_driver_no,  fld_booking_status, fld_base_location, fld_distcance)
						   SELECT DISTINCT ".$booking_id." ,fld_vehicle_ai_id, fld_vehicletype_id, fld_driver_name, fld_driver_mobile_no, fld_booking_status, fld_location ,
						   ( 3959 * acos( cos( radians(".$pickupLat.")) * cos( radians(fld_location_lat))
						   * cos( radians(fld_location_long) - radians(".$pickupLng.")) + sin(radians(".$pickupLat."))
						   * sin( radians(fld_location_lat)))) AS distance
						   FROM tbl_vehicle
						   WHERE fld_vehicletype_id = '".$vehicle_type."' AND fld_is_active = '1'
						   HAVING distance < '".AREA_RADIUS."'
						   ORDER BY distance ASC ";
				$result2 = loader_query($query2);*/
				//echo $query2;
				if($result1)
				{
					$success_message = 'Booked successfully .Your Booking ID for tracking is '.$crn_no;
					loader_set_session('form_session','processed');
					//echo 'OR NOT'.loader_get_session('form_session');
					 $booking_confirm_message = 'Thank you for booking with us. Your order ID is '.$crn_no.' . '.$freewaiting_time.' minute for loading plus unloading is free, post that Rs '.$transit_charge.' per minute is applicable. Tolls and Parking charges are also applicable. Please track your order on www.theshipper.co.in/track_order';
					 $new_booking_message = 'New booking-CRN:'.$crn_no.' pickup_point: '.$pickup_point.'<br>drop_off_point: '.$drop_point.'<br> distance: '.$distance.'<br>fare: '.$fare_max.'<br>mobile: '.$mobile_no.'<br>vehicle_type: '.$vehicle_type;
					 loader_send_sms($booking_confirm_message, $mobile_no,'track_order_action');
					 loader_send_promotional_sms($new_booking_message,'8276097972','track_order_action');
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
}
?>
