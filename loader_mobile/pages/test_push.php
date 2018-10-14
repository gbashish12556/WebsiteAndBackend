<!-- <?php

var_dump(extension_loaded('curl'));
// phpinfo();
		// $msg = array
		// (
		// 	'message' 	=> 'New Booking in your Area',
		// 	'title'		=> 'New Booking',
		// 	'menuFragment' => 'NewBooking',
		// 	'crn_no'	=> 'CRN2133',

		// );

	 //    // loader_file_put_content('push_data',$page,'device_id:'.$gcm_regid);
	 //    // var_dump($msg);
	 //    define('API_ACCESS_KEY','AIzaSyCF9AFjZ4WcXAH6Qgpxm3VjgjoeuyGAADE');
	 //    $registrationIds = array('ejdnmn5rbFw:APA91bFtCWZx9NRoYm7ZhIOzNYEX4A423fv4bmXmh99-N5CiGy2h3ZjelACuktjiktlrp6JqfSV-gfxm6IFrAl3k8h4ippzLrJ301yyk61ebuzrMj9wvRwwdFxJQrn-QVaP_1HMXCN86');
		
		// // var_dump($registrationIds);
		// $fields = array
		// (
		// 	'registration_ids' 	=> $registrationIds,
		// 	'data'			=> $msg
		// );
		
		// $headers = array
		// (
		// 	'Authorization: key='.API_ACCESS_KEY,
		// 	'Content-Type: application/json'
		// );
		

  //       // var_dump($headers);

  //       // var_dump($fields);



		// $ch = curl_init();
		// curl_setopt($ch,CURLOPT_URL,'https://android.googleapis.com/gcm/send');
		// curl_setopt($ch,CURLOPT_POST,true);
		// curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
		// curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		// curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		// curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($fields));
		// $result = curl_exec($ch);
		// var_dump($result);
		// curl_close($ch);
		// loader_file_put_content('push_data',$page,'device_id:'.$gcm_regid."".$msg."".$result);





// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AIzaSyCF9AFjZ4WcXAH6Qgpxm3VjgjoeuyGAADE');
$registrationIds = array('ejdnmn5rbFw:APA91bFtCWZx9NRoYm7ZhIOzNYEX4A423fv4bmXmh99-N5CiGy2h3ZjelACuktjiktlrp6JqfSV-gfxm6IFrAl3k8h4ippzLrJ301yyk61ebuzrMj9wvRwwdFxJQrn-QVaP_1HMXCN86');
// prep the bundle
$msg = array
(
	'message' 	=> 'here is a message. message',
	'title'		=> 'This is a title. title',
	'subtitle'	=> 'This is a subtitle. subtitle',
	'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
	'vibrate'	=> 1,
	'sound'		=> 1,
	'largeIcon'	=> 'large_icon',
	'smallIcon'	=> 'small_icon'
);
$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
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


?> -->