<?php
// last update : 60-04-22 12.40 //

$client_id = 'TSsCKpdeq6LyZtwzgZjVdF';
$client_secret = 'Q53ll8T7LXdffYA4WH9yYAgH0WibkF0AHkRXjFCKLph';
$session_id = session_id ();
$redirect_uri = 'https://fitness-thai.herokuapp.com/callback.php';

$code =  $POST['code'];
$state =  $POST['state'];

					
					$url = 'https://notify-bot.line.me/oauth/token';

					$data = [
						'grant_type' => ['authorization_code'],
						'code' => [$code],
						'redirect_uri' => [$redirect_uri],
						'client_id' => [$client_id] ,
						'client_secret' => [$client_secret] 
					         ];
					
					$post = json_encode($data);
					$headers = 'Content-Type: application/x-www-form-urlencoded';
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					$result = curl_exec($ch);
					curl_close($ch);
	
		// save data url
		$url = 'http://103.253.75.184/post_callback.php';
				
		$myvars = 'code='.$code.'&state='.$state ;
		
		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec( $ch );
		curl_close($ch);		
	
	
echo 'OK ,content ='.$result.', reponse = '.$response;
?>
