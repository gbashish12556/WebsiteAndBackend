<?php
$error_message = $success_message = "";
$query3 = "SELECT booking_id FROM view_booking_detail WHERE booking_status = '1' ";
if($result3  = loader_query($query3))
{
	if(loader_num_rows($result3))
	{
		while($row3 = loader_fetch_assoc($result3))
		{
			$query4 = "DELETE FROM tbl_nearest_vehicle WHERE fld_booking_id = ".$row3['booking_id']." ";
			echo $query4;
			if($result4  = loader_query($query4))
			{
				$success_message .= "DELETE SUCCESS";
			}
		}
	}
}
//echo $success_message.' '.$error_message;

?>