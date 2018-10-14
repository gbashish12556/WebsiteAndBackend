<?php
	loader_file_put_content('post_data','get_customer_location',$_REQUEST);
if(loader_post_isset("customer_token"))
{
	$userRow = array();
	$error_message = $success_message = $customer_token = "";

	$customer_token = loader_get_post_escape("customer_token");
	/*
	 ******  Edited by:           Sourav Halder
	 ******  Last Edit Date:      25/04/2016
	 ******  Works Done:          Validation of input data
	*/
	if(("" == $customer_token))
	{
		$error_message = MANDATORY_MISSING;
	}
	else
	{
		if(validate_user_token($customer_token))
		{
			$query1 = "SELECT location_lat, location_lng, location_datetime FROM view_customer_info WHERE user_token = '".$customer_token."' ";
			loader_file_put_content('query_data','get_customer_location',$query1);
			if($result1 = loader_query($query1))
			{
				if(0 < loader_num_rows($result1))
				{
					$userRow['likes'] = array();
					$row = loader_fetch_assoc($result1);
					$userRow["likes"][0]["customer_location_datetime"] = $row["location_datetime"]."";
					$userRow["likes"][0]["customer_location_lat"] =  $row['location_lat']."";
					$userRow["likes"][0]["customer_location_lng"]  = $row['location_lng']."";
					$success_message = IS_SUCCESS;
				}
				else
				{
					$error_message = SERVER_ERRROR;
				}
			}
			else
			{
				$error_message = SERVER_ERRROR;
			}
		}
		else
		{
			$error_message = USER_INVALID;
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
	loader_file_put_content('send_data','get_customer_location',$send_data);

}



?>
