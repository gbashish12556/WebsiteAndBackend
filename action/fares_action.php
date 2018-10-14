<?php

						$query1 = "SELECT base_fare, vehicletype_id,vehicle_name,maximum_weight,night_holding_charge,hard_copy_challan, freewaiting_time,waiting_charge,dimension, transit_charge,hard_copy_challan FROM view_base_fare WHERE is_active='1'";
						//echo  $query;
						$list_tab = "";
						$list = "";
						$i = 0;
						$class= "active";
						if($result1 = loader_query($query1))
						{
							while($row1 = loader_fetch_assoc($result1))
							{  
								$list_rate = "";
								$list_main = "";
								$list_milestone = "";
							    $tab = 'tab'.$i;
								$base_fare = $row1['base_fare'];
								$vehicle_type = $row1['vehicletype_id'];
								$vehicle_name = $row1['vehicle_name'];
								//pricing calculation
								$where = " WHERE vehicletype_id = '".$vehicle_type."' ";
								$pricing_query = "SELECT to_distance, price_km FROM view_pricing ".$where." ORDER BY to_distance ASC ";
								//echo $pricing_query;
								if($result2 = loader_query($pricing_query))
								{
									 $fare  = $base_fare;
									 //echo $fare;
		$list_tab .= '<li class="'.$class.' margin-bottom-5" ><a href="#'.$tab.'" data-toggle="tab">'.$vehicle_name.'</a></li>
				  ';
$list_main .=  '
<!--start '.$tab.'-->
     <div class="tab-pane '.$class.' text-center" id="'.$tab.'">
		 <div class="distancechart">';
$list_rate .= '
            <div class="col-sm-12">
			  <p class="rate_group">';
$list_milestone .= '
			 <div class="col-sm-12">
			   <div class="distance-line">
				<span> </span>
				<span class="main-combo">
				  <div class="main-tria"></div>
				  <div class="milestone"> 0 km</div>
				</span>';						
									while($row2 = loader_fetch_assoc($result2))
									{
/*$dist_gap = ($row2['to_distance'] - $row2['from_distance']);	
if($dummy_distance > 0)
{	
 if($dummy_distance > $dist_gap)
 {
		 $fare = $fare+ $dist_gap*$row['price_km'];
	 //echo $fare;
		 $dummy_distance = $dummy_distance-$dist_gap;
 }	
 else
 {
		 $fare = $fare+$dummy_distance*$row['price_km'];
		 //echo $fare;
		 $dummy_distance = 0;
 }
}*/
$list_rate .= '
               <span class="small_dot"></span>
			   <span class="rate_distance"><i class="fa fa-rupee"></i> Rs.'.$row2['price_km'].'/km </span>';
$list_milestone .= '
                 <span class="line"></span>`
				<span class="main-combo">
				  <div class="main-tria"></div>
				  <div class="milestone"> '.$row2['to_distance'].' km</div>
				</span>';
									}
$list_rate .= '
                <span class="small_dot"></span>
               </p>
		     </div>';
$list_milestone .= '</div>
			      </div>
			  </div>';
$list .= $list_main.$list_rate.$list_milestone.'
              <div class="table-container">
				 <table class="price table-distance margin-bottom-10">
				  <colgroup>
					<col width="200px">
					<col width="150px">
				  </colgroup>
				  <tbody>
				  <tr>
					<th><b>Parameters</b></th>
					<th><b>Values</b></th>
				  </tr>
				  <tr>
					<td>Base Fare</td>
					<td>Rs. '.$row1['base_fare'].'</td>
				  </tr>
				  <tr>
					<td>Night holding Charge</td>
					<td>Rs. '.$row1['night_holding_charge'].'</td>
				  </tr>
				  <tr>
					<td>Free loading & unloading time </td>
					<td>'.$row1['freewaiting_time'].' minute</td>
				  </tr>
				  <tr>
					<td>Waiting Charge</td>
					<td>Rs.'.$row1['waiting_charge'].' / min</td>
				  </tr>
				  </tbody>
				</table>
				<table class="price table-distance">
				  <colgroup>
					<col width="250px">
					<col width="100px">
				  </colgroup>
				  <tbody>
				  <tr>
					<th><b>Parameters</b></th>
					<th><b>Values </b> </th>
				  </tr>
				  <tr>
					  <td>Capacity</td>
					  <td>'.$row1['maximum_weight'].' Ton</td>
				  </tr>
				  <tr>
					<td>Dimension</td>
					<td>'.$row1['dimension'].' </td>
				  </tr>
				  <tr>
					<td>Transit Charge</td>
					<td>Rs.'.$row1['transit_charge'].' / min </td>
				  </tr>
				   <tr>
					<td>Hard Copy of Challan</td>
					<td>Rs.'.$row1['hard_copy_challan'].'</td>
				  </tr>
				  </tbody>
				</table>
			</div> 
			<!-- table-container -->
		</div>
<!--end '.$tab.'-->';
                                                  
								}
								else
								{
										$error_message = SERVER_ERROR;
								}
								$i++;
							    $class = "";
							}
						}
						else
						{
							$error_message = SERVER_ERROR; 
						}

?>