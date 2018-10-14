<?php

	//require_once("dbcontroller.php");
	//$db_handle = new DBController();
	if(loader_post_isset("country_id")) {
		$country_id = loader_get_post_escape("country_id");
		$query ="SELECT  fld_location_code,fld_location_name FROM tbl_to_location WHERE fld_from_location_code = '".$country_id."'";
	    ?>
		<option value="">Select State</option>
	    <?php
		if($result = loader_query($query))
		{
				while($row = loader_fetch_assoc($result))
				{
					?>
						<option value="<?php echo $row["fld_location_code"]; ?>"><?php echo $row["fld_location_name"]; ?></option>
					<?php
					//echo $list;
					
				}
		}
		else
		{
			$error_message = SERVER_ERROR;
		}
	}

?>