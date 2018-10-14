<?php
 //$reg_id = "APA91bH3DyQF0f6JhgbZMdt7YPSBXMiGK4Tk8hlIXO7WERTspOmW-SxYUijMZKF7z1d8QZ-fq6M4mbFw6PckkodxBoIj10o1GwZvtuG9nusQz2fnF14vujm88L7ZYBIt4sLpzEcXm2RC";
// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AIzaSyCF9AFjZ4WcXAH6Qgpxm3VjgjoeuyGAADE');
$registrationIds = array("fyy5JGV-B40:APA91bEy6AIhJpp8wnHo8XjTjsV5LkW3VTZ2YLL8Z2Ob4HiVBASZm-jUrs2W0bSMOYenwyrHAYRXN0zw7owom9rie7PRbQka36BjafF_EJfsfDphqhloIJ7FGhPplHyGBBK-2mHC7B4Q");
// prep the bundle
$msg = array
(
	'message' 	=> 'here is a message. message',
	'title'		=> 'This is a title. title',
	'subtitle'	=> 'This is a subtitle. subtitle'
);
$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key='.API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result;

?>