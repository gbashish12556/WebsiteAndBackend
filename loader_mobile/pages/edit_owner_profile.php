<?php
	loader_file_put_content('post_data','edit_owner_profile',$_REQUEST);
if(loader_post_isset("name")&&loader_post_isset("postal_address")&&loader_post_isset("email")&&loader_post_isset("user_token"))
{
    $userRow = array();
	$error_message = $success_message = $name = $postal_address = $email = $user_token = "";

	$name = 	loader_get_post_escape("name");
	$postal_address = 	loader_get_post_escape("postal_address");
	$email = 	loader_get_post_escape("email");
	$user_token = 	loader_get_post_escape("user_token");
	
	if(("" == $name)||("" == $postal_address)||("" == $email)||("" == $user_token))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if((strlen($name)>NAME_MAXLEN)||(strlen($email)>EMAIL_MAXLEN)||(strlen($postal_address)>POSTAL_ADDRESS_MAXLEN))
		{
			$error_message = WRONG_HAPPEN;
		}
		else
		{
			if(loader_isValidName($name))
			{
				if(loader_isValidEmail($email))
				{
					if(owner_isMailExist($email,$user_token))
					{
						$error_message = EXIST_EMAIL;
					}
					else
					{
						if(validate_owner_token($user_token))
						{
							$query2 = " UPDATE tbl_owner_info SET tbl_name = '".$name."', fld_email = '".$email."', fld_postal_address = '".$postal_address."'
									   WHERE fld_user_token = '".$user_token."' ";
							loader_file_put_content('query_data','edit_owner_profile',$query2);
							if(loader_query($query2))
							{
								$success_message .= UPDATE_SUCCESS;
							}
							else
							{
								$error_message = SERVER_ERROR;
							}
						}
						else
						{
							$error_message = USER_INVALID;
						}
					}
				}
				else
				{
					$error_message = EMAIL_INVALID;
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
	loader_file_put_content('send_data','edit_owner_profile',$send_data);
}
?>
