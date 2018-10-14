<?php

  loader_file_put_content('post_data','rate_customer',$_REQUEST);
if(loader_post_isset("booking_id"))
{
    $userRow = array();
    $error_message = $success_message = $booking_id = $customer_rating = $driver_feedback = "";
    $booking_id = loader_get_post_escape("booking_id");
    $customer_rating = loader_get_post_escape("customer_rating");
    $driver_feedback = loader_get_post_escape("driver_feedback");

    if(("" == $booking_id)||("" == $customer_rating))
  	{
  		$error_message = MANDATORY_MISSING;
  	}
    else {
      $query1 = "UPDATE tbl_booking_detail SET fld_customer_rating= '".$customer_rating."', fld_driver_feedback ='".$driver_feedback."'
      WHERE fld_booking_ai_id = '".$booking_id."'";
      loader_file_put_content('query_data','rate_customer',$query1);
      if($result = loader_query($query1))
      {
        $success_message = UPDATE_SUCCESS;
      }
      else
      {
        $error_message = SERVER_ERRROR;
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
    loader_file_put_content('send_data','rate_customer',$send_data);

}

?>
