<?php
 //$reg_id = "APA91bH3DyQF0f6JhgbZMdt7YPSBXMiGK4Tk8hlIXO7WERTspOmW-SxYUijMZKF7z1d8QZ-fq6M4mbFw6PckkodxBoIj10o1GwZvtuG9nusQz2fnF14vujm88L7ZYBIt4sLpzEcXm2RC";
// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AIzaSyCF9AFjZ4WcXAH6Qgpxm3VjgjoeuyGAADE');
$registrationToken = "edAp67Af274:APA91bGXeqfDEHA72x1Q16efDgB5xBy9uVTQjYYZMkVgjIxLHtfzLZhrMukKB0xJ-vwaN8KCyXz0Atsew4sMLuLjX_lg5U_UY-MQnB66wksrT8Mss9wSDYUyUzRKPf8dngj1Z31X7-FB";
// prep the bundle
$msg = array
(
	'message' 	=> 'here is a message. message',
	'title'		=> 'This is a title. title',
	'subtitle'	=> 'This is a subtitle. subtitle'
);
$fields = array
(
	'to' 	=> $registrationToken,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization:key='.API_ACCESS_KEY,
	'Content-Type:application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result;
?>