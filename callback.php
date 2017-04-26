<?php
$client_id = 'TSsCKpdeq6LyZtwzgZjVdF';
$client_secret = 'Q53ll8T7LXdffYA4WH9yYAgH0WibkF0AHkRXjFCKLph';
$redirect_uri = 'https://fitness-thai.herokuapp.com/callback.php';
$code  = $_GET['code'];
$state = $_GET['state'];

$url = 'https://notify-bot.line.me/oauth/token';
$data = 'grant_type=authorization_code&code='.$code.'&redirect_uri='.$redirect_uri.'&client_id='.$client_id.'&client_secret='.$client_secret;
			   
					
        $post = json_encode($data);
		$headers = ['content-type: application/x-www-form-urlencoded'];
		$ch = curl_init($url);
		curl_setopt($ch, curlopt_customrequest, "post");
		curl_setopt($ch, curlopt_returntransfer, true);
		curl_setopt($ch, curlopt_postfields, $post);
		curl_setopt($ch, curlopt_httpheader, $headers);
		curl_setopt($ch, curlopt_followlocation, 1);
		$result = curl_exec($ch);
		curl_close($ch);
        
       
	
		// save data url
		$url = 'http://103.253.75.184/post_callback.php';
				
		$myvars = 'rawdata='.$post ;
		
		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec( $ch );
		curl_close($ch);		
	
	
?>
