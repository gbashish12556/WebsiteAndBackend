<?php
ini_set("allow_url_fopen","On");
$name = $mobile_no = $pickup_point = $drop_point = $datetime3 = "";
if(loader_post_isset('pickup_point'))
{
    //$name = loader_ucwords(loader_get_post_escape('name'));
    $mobile_no = loader_get_post_escape('mobile_no');
    //$datetime3 = loader_get_post_escape('datetime3');
	//echo 'converted'.$datetime3; 
    $vehicle_type = loader_get_post_escape('vehicle_type');
    $pickup_point = loader_get_post_escape('pickup_point');
   
    //echo $pickup_point;
    //**$pickupLat = loader_get_post_escape('pickupLat');
    //**$pickupLng = loader_get_post_escape('pickupLng');
    $drop_point = loader_get_post_escape('drop_point');
    //echo $drop_point;
    //**$dropLat = loader_get_post_escape('dropLat');
    //**$dropLng = loader_get_post_escape('dropLng');

	if(("" == $mobile_no)||("" == $vehicle_type)||("" == $pickup_point)||("" == $drop_point))
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
			   if(validate_phone_number($mobile_no))
			   {
				   if(validate_vehicletype($vehicle_type))
				   {
						
					$actual_time = "";
					$fare_min = $actual_time_value = $fare_max = $fare = $distance = $base_fare =  0;
					$from = urlencode($pickup_point);
					//echo 'from'.$from.'<br/>';
					$to = urlencode($drop_point);
					//echo 'to'.$to.'<br/>';
					$data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$from."&destinations=".$to."&language=en-EN&sensor=false");
					//echo "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$from."&destinations=".$to."&language=en-EN&sensor=false";
					   //echo $data;
					$data = json_decode($data);
				        //var_dump($data);
					foreach($data->rows[0]->elements as $road) {
						$actual_time .= $road->duration->text;
						$actual_time_value += $road->duration->value;
						$distance += $road->distance->value;
						//echo 'actual_time_value'.$actual_time_value;
					}
					//echo $distance;
					//echo $time;
					$distance = $distance/1000;
					//echo 'distance'.$distance;
					//$hr = intval($time/3600);
					$travel_min  = intval(($actual_time_value)/60);
					//$actual_time= $hr.' hours '.$min.' mins';
					//$actual_time= $time;
					//echo 'travel_min'.$travel_min;
					$dummy_distance = $distance;
					//base fare calculation
					$where = " WHERE vehicletype_id = '".$vehicle_type."' ";
					$query = "SELECT base_fare ,transit_charge FROM view_base_fare ".$where." ";
					//echo $query;
					if($result = loader_query($query))
					{
						$row = loader_fetch_assoc($result);
						$base_fare = $row['base_fare'];
						$base_fare_min = $row['base_fare']+$travel_min*$row['transit_charge'];
						$base_fare_max = $row['base_fare']+$travel_min*$row['transit_charge']*2.5;
						//pricing calculation
						$where = " WHERE vehicletype_id = '".$vehicle_type."' ";
						$pricing_query = "SELECT from_distance, to_distance, price_km FROM view_pricing ".$where." ORDER BY to_distance ASC ";
						//echo $pricing_query;
						if($result = loader_query($pricing_query))
						{
							//$list = "";
							$fare_min  = $base_fare_min;
							//echo $fare;
							while($row = loader_fetch_assoc($result))
							{
								/*  $list .= '<tr>
											 <td>'.$row['from_distance'].' km</td>
											 <td>'.$row['to_distance'].' km</td>
											 <td>Rs.'.$row['price_km'].' / km</td>
											</tr>';*/
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
                                     //echo $fare;
								 }
							}
							 
							  $fare_min = $fare+$base_fare_min;
							  $fare_max = $fare+$base_fare_max;
						}
						else
						{
							$error_message = SERVER_ERROR;
						}
							//$query_enquiry  = "INSERT INTO tbl_rate_enquiry (fld_vehicletype_id,fld_from_point,fld_to_point,fld_contact_no,fld_total_distance,fld_total_fare)
							  //                 VALUES('".$vehicle_type."','".$pickup_point."','".$drop_point."','".$mobile_no."','".$distance."','".$fare_max."')";
				            //loader_query($query_enquiry);
					}
					else
					{
						$error_message = SERVER_ERROR;
					}
		
				   }
				   else
				   {
					   $error_message = WRONG_HAPPEN;
				   }
			   }
			   else
			   {
				   $error_message = MOBILE_INVALID;
			   }
		}
	}
}
?>
