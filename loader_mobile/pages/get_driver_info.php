<?php
	loader_file_put_content('post_data','get_driver_info',$_REQUEST);
if(loader_post_isset("mobile_no"))
{
	$userRow = array();
	$error_message = $success_message = $mobile_no= "";
	//file_put_contents("post_data/".date('d_m_Y', time())."customer_registration.txt", date('d/m/Y h:i:s a', time())." ".print_r($_REQUEST,true), FILE_APPEND);
	//$error_message = $success_message = "";
	$mobile_no = loader_get_post_escape("mobile_no");

	/*
	 ******  Edited by:           Sourav Halder
	 ******  Last Edit Date:      26/04/2016
	 ******  Works Done:          Validation of input data
	*/

	if("" == $mobile_no)
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if((strlen($mobile_no)>MOBILE_MAXLEN)||(strlen($mobile_no)<MOBILE_MINLEN))
		{
			$error_message = WRONG_HAPPEN;
		}
		else
		{
			if(validate_phone_number($mobile_no))
			{
				$query1 = "SELECT name, vehicletype_id, postal_address ,user_token,profile_pic_url,city_id FROM view_driver_info WHERE mobile_no = '".$mobile_no."' ";
	                        loader_file_put_content('query_data','get_driver_info',$query1);
				if($result1 = loader_query($query1))
				{
					if(0 == loader_num_rows($result1))
					{
							$msg = "Driver registered with mobile no: ".$mobile_no;
							loader_send_promotional_sms($msg,ADMIN_MOBILE_NO);
							loader_file_put_content('sms_data','driver_registration',$msg);
						$query2 = "INSERT INTO tbl_driver_info (fld_mobile_no) VALUES('".$mobile_no."')";
						loader_file_put_content('query_data','get_driver_info',$query2);
						if(loader_query($query2))
						{
							$last_inserted_id = loader_last_inserted();
							$user_token = loader_hash($last_inserted_id);

							loader_file_put_content('query_data','get_driver_info',$query3);
							if(customer_isTokenExist($user_token))
							{
								$query3 = "DELETE FROM tbl_driver_info WHERE fld_driver_ai_id = '".$last_inserted_id."' ";
								if(loader_query($query3))
								{
									loader_file_put_content('token_collisions','collided_and_removed','Driver id:'.$last_inserted_id.' Token:'.$user_token."\r\n");
									$error_message = REGISTRATION_FAILED;
								}
								else
								{
									loader_file_put_content('token_collisions','collided_not_removed','Driver id:'.$last_inserted_id.' Token:'.$user_token."\r\n");
									$error_message = SERVER_ERROR;
								}
							}
							else
							{
								$query3 = "UPDATE tbl_driver_info SET fld_user_token = '".$user_token."' WHERE fld_driver_ai_id = '".$last_inserted_id."' ";
								if(loader_query($query3))
								{
									$userRow['likes'] = array();
									$success_message = REGISTRATION_SUCCESS;
									$userRow["likes"][0]["user_token"] =  $user_token ;
									$userRow["likes"][0]["vehicletype_id"] =  "";
									$userRow["likes"][0]["name"]  = "";
									$userRow["likes"][0]["postal_address"]  = "";
									$userRow["likes"][0]["profile_pic_url"] = "";
									$userRow["likes"][0]["city_id"] = "";
								}
								else
								{
									$error_message = SERVER_ERROR;
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
						$userRow['likes'] = array();
						$row = loader_fetch_assoc($result1);
						$userRow["likes"][0]["user_token"] =  $row['user_token']."";
						$userRow["likes"][0]["name"]  = $row['name']."";
						$userRow["likes"][0]["vehicletype_id"]  = $row['vehicletype_id']."";
						$userRow["likes"][0]["postal_address"]  = $row['postal_address']."";
						$userRow["likes"][0]["city_id"]  = $row['city_id']."";
					    if((NULL == $row['profile_pic_url']) || ("" == $row['profile_pic_url']))
						{
							$userRow["likes"][0]["profile_pic_url"] = "";
						}
						else
						{
							$image_path  = ('upload/'.$row['profile_pic_url']);
							if(loader_file_exists($image_path))
							{
								$userRow["likes"][0]["profile_pic_url"] = $image_path."";
							}
							else
							{
								$userRow["likes"][0]["profile_pic_url"]  = "";
							}
						}
						$success_message = IS_SUCCESS;
					}
				}
				else
				{
					$error_message = SERVER_ERROR;
				}
			}
			else
			{
				$error_message = MOBILE_INVALID;
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
		//$userRow['likes'][0]['isupdated'] = "0";
	}
	$userRow["errFlag"] = $errFlag."";
	$userRow["errMsg"] = $errMsg."";

	//$json = array("errFlag" => $errFlag, "errMsg" => $errMsg, "likes" => $noteRow);
	//header('Content-Type: application/json');
	$send_data = json_encode($userRow);
	echo $send_data;
	loader_file_put_content('send_data','get_driver_info',$send_data);
}

?>
