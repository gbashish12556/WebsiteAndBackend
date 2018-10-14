<?php
loader_file_put_content('post_data','change_driver_status',$_REQUEST);
if(loader_post_isset("user_token")&&loader_post_isset("status"))
{

    $userRow = array();
	  $error_message = $success_message = $user_token = $status = "";
    $user_token = loader_get_post_escape("user_token");
    $status = loader_get_post_escape("status");

    if(("" == $user_token)||("" == $status))
  	{
  		$error_message = MANDATORY_MISSING;
  	}
    else
    {
      if(validate_driver_token($user_token))
  		{
  			$query1 = "UPDATE tbl_driver_info SET fld_is_busy = '".$status."' WHERE fld_user_token = '".$user_token."' ";
  			loader_file_put_content('query_data','change_driver_status',$query1);
  			if(loader_query($query1))
  			{
  				$success_message = UPDATE_SUCCESS;
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

    // SEND JSON DATA

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
  	loader_file_put_content('send_data','change_driver_status',$send_data);


}

?>
