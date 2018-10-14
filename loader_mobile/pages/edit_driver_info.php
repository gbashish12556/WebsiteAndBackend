<?php
	loader_file_put_content('post_data','edit_driver_info',$_REQUEST);
if(loader_post_isset("name")&&loader_post_isset("postal_address")&&loader_post_isset("vehicletype_id")&&loader_post_isset("user_token")&&loader_post_isset("profile_pic")&&loader_post_isset("city_id"))
{
	    $userRow = array();
	$error_message = $success_message = $name = $postal_address = $vehicletype_id = $user_token = $city_id = $profile_pic = "";

	$name = 	loader_get_post_escape("name");
	$postal_address = 	loader_get_post_escape("postal_address");
	$vehicletype_id = 	loader_get_post_escape("vehicletype_id");
	$user_token = 	loader_get_post_escape("user_token");
	$profile_pic = 	loader_get_post("profile_pic");
	$city_id = 	loader_get_post("city_id");
	/*
	 ******  Edited by:           Sourav Halder
	 ******  Last Edit Date:      25/04/2016
	 ******  Works Done:          Validation of input data
	*/
	if(("" == $name)||("" == $postal_address)||("" == $vehicletype_id)||("" == $user_token)||("" == $profile_pic)||("" == $city_id))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if((strlen($name)>NAME_MAXLEN)||(strlen($postal_address)>POSTAL_ADDRESS_MAXLEN))
		{
			$error_message = WRONG_HAPPEN;
		}
		else
		{
			if(loader_isValidName($name))
			{
				if(validate_driver_token($user_token))
				{
					$img = $profile_pic; //to get img from post...
					$img = str_replace('data:image/jpg;base64,', '', $img);
					$img = str_replace(' ', '+', $img);
					$data = base64_decode($img);
					$profile_pic = time()."shipper_".$user_token.'.jpg';
					$file = "upload/".$profile_pic;
					$success = file_put_contents($file, $data);
					$query2 = " UPDATE tbl_driver_info SET fld_name = '".$name."', 
								fld_postal_address = '".$postal_address."' , 
								fld_vehicletype_id = '".$vehicletype_id."',
								fld_profile_pic_url = '".$profile_pic."',
								fld_city_id = '".$city_id."'
								WHERE fld_user_token = '".$user_token."' ";
					loader_file_put_content('query_data','edit_customer_profile',$query2);
					if(loader_query($query2))
					{
						$success_message .= UPDATE_SUCCESS;
					}
					else
					{
						$error_message = SERVER_ERROR;
					}
					/*$query1 = "UPDATE tbl_driver_info SET fld_name = '".$name."',fld_postal_address = '".$postal_address."',fld_vehicletype_id = '".$vehicletype_id."' WHERE fld_user_token = '".$user_token."' ";
					loader_file_put_content('query_data','edit_driver_info',$query1);
					if(loader_query($query1))
					{
						$success_message = UPDATE_SUCCESS;
					}
					else
					{
						$error_message = SERVER_ERROOR;
					}*/
				}
				else
				{
					$error_message = USER_INVALID;
				}
			}
			else
			{
				$error_message = NAME_INVALID;
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
	loader_file_put_content('send_data','edit_driver_info',$send_data);
}
?>
