<?php
$error_message = $success_message = "";
$query1 = "SELECT booking_id, vehicletype_id, from_lat, from_long FROM view_booking_detail WHERE booking_status = '0' ";
//echo $query1;
if($result1  = loader_query($query1))
{
	//echo "enter";
	if(loader_num_rows($result1))
	{
		while($row1 = loader_fetch_assoc($result1))
		{
			$booking_id = $row1['booking_id'];
			$vehicletype_id = $row1['vehicletype_id'];
			$booking_lat = $row1['from_lat'];
			$booking_long = $row1['from_long'];
			$query2 = "INSERT IGNORE INTO tbl_nearest_vehicle (fld_booking_id, fld_vehicle_id,fld_vehicletype_id, fld_driver_name, fld_driver_no,  fld_booking_status, fld_base_location, fld_distcance)
					  SELECT DISTINCT '".$booking_id."' ,fld_driver_ai_id,fld_vehicletype_id, fld_name, fld_mobile_no, fld_is_busy, fld_location ,
					   ( 3959 * acos( cos( radians('".$booking_lat."')) * cos( radians(fld_location_lat))
					   * cos( radians(fld_location_long) - radians('".$booking_long."')) + sin(radians('".$booking_lat."'))
					   * sin( radians(fld_location_lat)))) AS distance
					   FROM tbl_driver_info
					   WHERE fld_vehicletype_id = '".$vehicletype_id."' AND fld_is_active = '1'
					   HAVING distance < '".AREA_RADIUS."'
					   ORDER BY distance ASC ";

			//echo $query2;
			//echo $ACTION_APTH = ACTION_PATH;
			//echo $AREA_RADIUS = AREA_RADIUS;


			if($result2 = loader_query($query2))
			{
				$success_message .= "UPDATE_SUCCESS";
			}
			else
			{
				$error_message .= SERVER_ERROR;
			}
		}
	}
}
else
{
	$error_message .= SERVER_ERROR;
}




?>
