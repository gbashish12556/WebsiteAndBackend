<?php
$list = $vehicletype_id = $vehicle_name = $from_point = $to_point = $datetime1 =$booking_datetime =  $total_distance = $total_time = $total_fare = $crn_no = $booking_status = $vehicle_no = $location = $driver_name = $driver_mobile_no = "";
if(loader_post_isset('crn_no'))
{
   $crn_no = loader_get_post_escape('crn_no');
   if("" != $crn_no)
   {
	   $where = "WHERE crn_no = '".$crn_no."' ";
	   $query = "SELECT vehicletype_id,vehicle_name, from_point,to_point, booking_datetime ,total_distance,  fare_min,  
	             fare_max,  booking_id, crn_no, booked_vehicle_id,driver_vehicle_no, driver_name,driver_mobile_no,
				 driver_location_lat,driver_location_lng,driver_location_datetime FROM view_booking_detail ".$where." ";
	   //echo $query;
	   if($result = loader_query($query))
	   {
		   if(loader_num_rows($result))
		   {
				$row = loader_fetch_assoc($result);
				$vehicletype_id = $row['vehicletype_id'];
				$vehicle_name = $row['vehicle_name'];
				$from_point = $row['from_point'];
				$to_point = $row['to_point'];
				$booking_datetime = date('d.m.Y g:i a', strtotime($row['booking_datetime']));
				$total_distance = $row['total_distance'];
				//$total_time = $row['total_time'];
				$total_fare = $row['fare_min'].' -- '.$row['fare_max'];
				//echo $total_fare;
				$crn_no = $row['crn_no'];
				$booked_vehicle_id = $row['booked_vehicle_id'];
				$booking_id = $row['booking_id'];
				if($booked_vehicle_id > 0)
				{
					
					$vehicle_no = $row['driver_vehicle_no'];
					$driver_name = $row['driver_name'];
					$driver_mobile_no = $row['driver_mobile_no'];
					$lattitude = $row['driver_location_lat'];
					$longitude = $row['driver_location_lng'];
					if(loader_get_address($lattitude,$longitude)){
				   $list = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="manage-table price">
								<tbody>
								  <tr>
									<th width="20%" height="30">Date</th>
									<th width="20%" height="30">Time</th>
									<th width="20%" height="30">Location</th>
								  </tr>
								   <tr>
									  <td>'.date('d.m.Y',strtotime($row['driver_location_datetime'])).'</td>
									  <td>'.date('g:i a',strtotime($row['driver_location_datetime'])).'</td>
			
									  <td>'.loader_get_address($lattitude,$longitude).'</td>
								  </tr>
								</tbody>
							</table>';
					}
					
				}
				else
				{
					    $vehicle_no = 'Vehicle Allocation Pending';
						
						$driver_name = 'Driver Allocation Pending';
						$driver_mobile_no = 'N.A.';
				}

		   }
		   else
		   {
			   $error_message = CRN_INVALID;
			   header('Location: '.ROOT_PATH.'track_order');
		   }

	   }
	   else
	   {
		   $error_message = SERVER_ERROR;
	   }
   }
   else
   {
	   $error_message = MANDATORY_MISSING;
   }
}
?>
