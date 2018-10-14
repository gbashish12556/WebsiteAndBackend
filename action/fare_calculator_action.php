<?php
 $toll_charge = $total_distance = $total_time = $fare = $actual_time = $list1 = $list2 =  $total_time =  "";
$fare_min  = $total_km_charge = $distance = $base_fare = $total_km = $dummy_distance = $chargabale_time = 0;
if("" == $case)
{ 

	if(loader_post_isset('total_distance'))
	{
		$total_distance = loader_get_post_escape('total_distance');
		$total_time = loader_get_post_escape('total_time');
		$vehicle_type = loader_get_post_escape('vehicle_type');
		$toll_charge = loader_get_post_escape('toll_charge');
		$dummy_distance = $total_km =$total_distance;
		//echo 'total_km'.$total_km;
		$where = " WHERE vehicletype_id = '".$vehicle_type."' ";
		$query = "SELECT base_fare, transit_charge, freewaiting_time FROM view_base_fare ".$where." ";
		if($result = loader_query($query))
		{
			$row = loader_fetch_assoc($result);
			$base_fare = $row['base_fare'];
			$transit_charge = $row['transit_charge'];
			$freewaiting_time = $row['freewaiting_time'];
			if($total_time>$freewaiting_time){
			$chargabale_time = ($total_time-$freewaiting_time);}
			$total_transit_charge = $chargabale_time*$transit_charge;
			//echo 'freewaiting_time'.$freewaiting_time;
			$base_fare_min = $row['base_fare']+$total_transit_charge;
			//pricing calculation
			$list2 .= '<div class="table-container">
				 <table class="price margin-bottom-10">
				  <colgroup>
					<col width="400px">
					<col width="200px">
				  </colgroup>
				  <tbody>
				  <tr>
					<th><b>Parameter</b></th>
					<th><b>Values</b></th>
				  </tr>
				  <tr>
					 <td>Transit Time</td>
					 <td>'.$total_time.' minute</td>
				  </tr>
				  <tr>
					 <td>Free time</td>
					 <td>'.$freewaiting_time.' minute </td>
				  </tr>
				  <tr>
					 <td>Chargable time</td>
					 <td>'.$chargabale_time.' minute </td>
				  </tr>
				  <tr>
					 <td>Transit charge</td>
					 <td>'.$transit_charge.' Rs / minute </td>
				  </tr>
				  <tr bgcolor="#CCCCCC">
					 <td>Total transit charge</td>
					 <td>'.$total_transit_charge.' Rs. </td>
				  </tr>
				  <tr bgcolor="#CCCCCC">
					 <td>Base Fare</td>
					 <td>'.$base_fare.' Rs. </td>
				  </tr>';
			$where = " WHERE vehicletype_id = '".$vehicle_type."' ";
			$pricing_query = "SELECT from_distance, to_distance, price_km FROM view_pricing ".$where." ORDER BY to_distance ASC ";
			//echo $pricing_query;
			if($result = loader_query($pricing_query))
			{
				$list1 .= '<div class="table-container">
				 <table class="price margin-bottom-10">
				  <colgroup>
					<col width="150px">
					<col width="150px">
					<col width="150px">
					<col width="150px">
				  </colgroup>
				  <tbody>
				  <tr>
					<th><b>From(km)</b></th>
					<th><b>To(km)</b></th>
					<th><b>Rate</b></th>
					<th><b>Charge</b></th>
				  </tr>';
				//$fare  = $base_fare;
				//echo $fare;
				while($row = loader_fetch_assoc($result))
				{
					 $dist_gap = ($row['to_distance'] - $row['from_distance']);	
					 if($dummy_distance > 0)
					 {	
						 if($dummy_distance > $dist_gap)
						 {
								 $total_km_charge = $total_km_charge+ $dist_gap*$row['price_km'];
							     //echo $fare;
								 $dummy_distance = $dummy_distance-$dist_gap;
            				 $list1 .= '<tr>
					             <td>'.$row['from_distance'].'</td>
					             <td>'.$row['to_distance'].'</td>
								 <td>'.$row['price_km'].' Rs / km</td>
								 <td>'.$dist_gap*$row['price_km'].' Rs. </td>
				              </tr>';
						 }	
						 else
						 {
								 $total_km_charge = $total_km_charge+$dummy_distance*$row['price_km'];
								 //echo $fare;
				 $list1 .= '<tr>
					             <td>'.$row['from_distance'].'</td>
					             <td>'.$total_km.'</td>
								 <td>'.$row['price_km'].' Rs / km</td>
								 <td>'.$dummy_distance*$row['price_km'].' Rs. </td>
				              </tr>';
								 $dummy_distance = 0;
						 }
					 }

				}
		             $list1 .= '
		          </tbody>
				</table>
			  </div> 
			<!-- table-container -->
		</div>';
					$list2 .= '
				  <tr bgcolor="#CCCCCC" >
					 <td>Total Km charge</td>
					 <td>'.$total_km_charge.' Rs. </td>
				  </tr>
				  <tr bgcolor="#CCCCCC" >
					 <td>Toll Charge</td>
					 <td>'.$toll_charge.' Rs. </td>
				  </tr>
				  <tr bgcolor="#99CC99">
					 <td>Total Fare( Total transit charge + Base Fare + Total km charge + Toll Charge)</td>
					 <td>'.($total_transit_charge+$base_fare+$total_km_charge+$toll_charge).' Rs. </td>
				  </tr>

  		          </tbody>
				</table>
			  </div> 
			<!-- table-container -->
		</div>';
			   $fare_min = $fare+$base_fare_min;
			   $case = "final_bill";
			}
			else
			{
					$error_message = SERVER_ERROR;
			}
		}
		else
		{
			$error_message = SERVER_ERROR; 
		}
	}
}
if("final_bill" == $case){
	
	}
?>
