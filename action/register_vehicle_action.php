<?php
$owner_name = $owner_mobile_no = $driver_name = $vehicle_no = $vehicle_location = $vehicle_locationcity = $vehicle_locationLat = $vehicle_locationLat = $vehicle_locationLng  = "";
if(loader_post_isset('owner_name'))
{
    $owner_name = loader_ucwords(loader_get_post_escape('owner_name'));
    $owner_mobile_no = loader_get_post_escape('owner_mobile_no');
    $driver_name = loader_ucwords(loader_get_post_escape('driver_name'));
    $driver_mobile_no = loader_get_post_escape('driver_mobile_no');
    $vehicle_type = loader_get_post_escape('vehicle_type');
    $vehicle_no = loader_uppercase(loader_get_post_escape('vehicle_no'));
    $vehicle_location = loader_get_post_escape('vehicle_location');
    $vehicle_locationLat = loader_get_post_escape('vehicle_locationLat');
    $vehicle_locationLng = loader_get_post_escape('vehicle_locationLng');
	$session = loader_get_post_escape('session');
    if($session == loader_get_session('form_session'))
	{
			  //echo '\n owner_name'.$owner_name.'\n owner_mobile_no'.$owner_mobile_no.'\n vehicle_type'.$vehicle_type.'\n driver_name'.$driver_name.'\n driver_mobile_no'.$driver_mobile_no.'\n vehicle_no'.$vehicle_no.'\n vehicle_location:'.$vehicle_location.'\n     vehicle_locationcity'.$vehicle_locationcity.'\n vehicle_locationLat'.$vehicle_locationLat.'\n vehicle_locationLng'.$vehicle_locationLng;
	   if(("" == $owner_name)||("" == $owner_mobile_no)||("" == $driver_name)||("" == $driver_mobile_no)||("" == $vehicle_type)||("" == $vehicle_no)||("" == $vehicle_location)||("" == $vehicle_locationLat)||("" == $vehicle_locationLng))
	   {
		   // echo 'missing';
		$error_message = MANDATORY_MISSING;
	   }
	   else
	   {
		   if((strlen($owner_mobile_no)>MOBILE_MAXLEN)||(strlen($driver_mobile_no)>MOBILE_MAXLEN)||(strlen($owner_mobile_no)<MOBILE_MINLEN)||(strlen($driver_mobile_no)<MOBILE_MINLEN)||(strlen($owner_name)>NAME_MAXLEN)||(strlen($driver_name)>NAME_MAXLEN)||(strlen($vehicle_no)>VEHICLE_NO_MAXLEN)||(strlen($vehicle_no)<VEHICLE_NO_MINLEN))
		   {

			   $error_messages = WRONG_HAPPEN;
		   }
		   else
		   {
			   if(validate_phone_number($owner_mobile_no)&&validate_phone_number($driver_mobile_no))
			   {
				   $where = "WHERE vehicle_no = '".$vehicle_no."' OR mobile_no = '".$driver_mobile_no."' ";
				   $query = "SELECT vehicle_no FROM view_driver_info ".$where." ";
				  // echo $query.'<br/>';
				   if($result = loader_query($query))
				   {
						if(loader_num_rows($result))
						{
						  $error_message = EXIST_VEHICLE;
						}
						else
						{
							$query = "INSERT INTO tbl_driver_info (fld_vehicletype_id,fld_vehicle_no,fld_location_lat,
									 fld_location_lng,fld_owner_name,fld_owner_mobile_no,fld_name,fld_mobile_no)
									 VALUES('".$vehicle_type."', '".$vehicle_no."', '".$vehicle_location."', '".$vehicle_locationLat."'
									,'".$vehicle_locationLng."', '".$owner_name."', '".$owner_mobile_no."', '".$driver_name."', '".$driver_mobile_no."')";
						//	echo $query.'<br/>';
							if($result = loader_query($query))
							{
								$success_message = VEHICLE_SUCCESSFULLY_REGISTERED;
								$recipient = COMPANY_EMAIL;
								$template_data_array = array("SUBJECT","NAME","MAIL","MESSAGE");
					            $template_value_array = array("NEW VEHICLE REGISTERED",$owner_name,$owner_mobile_no,$vehicle_no);
					            global $mailTemplate;
					            $send = loader_send_mail($mailTemplate['contactus_content'],$template_data_array,$template_value_array,$recipient,$email,$mailTemplate['contactus_subject']);
							}
							else
							{
								$error_message =  SERVER_ERROR;
							}
						}
				   }
				   else
				   {
					  $error_message = SERVER_ERROR;
				   }
			   }
			   else
			   {
				   $error_messages = MOBILE_INVALID;
			   }
		   }
	   }
   }
}

?>
