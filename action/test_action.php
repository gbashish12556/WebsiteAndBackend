<?php

$randomarray = "08.07.2015 5:34 am";
					  
//$value = preg_grep("%^mail(<=men)%i",$randomarray);						   
$value = preg_match("/^(0[1-9]|[12][0-9]|3[0-1])\.([0][1-9]|1[0-2])\.(\d{4})\s([0-9]|1[012])\:[0-5][0-9]\s(am|pm)$/",$randomarray);					  
//"/^\d{4,6}/"
?>