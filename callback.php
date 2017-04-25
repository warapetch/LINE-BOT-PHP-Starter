<?php
// last update : 60-04-22 12.40 //

$content = file_get_contents('php://input');

// Parse JSON
$response = json_decode($content, true);

//$code = $response['code'];
//$redirect_uri = $response['redirect_uri'];
$client_id = 'TSsCKpdeq6LyZtwzgZjVdF';
$client_secret = 'Q53ll8T7LXdffYA4WH9yYAgH0WibkF0AHkRXjFCKLph';
					
/*					
					
					//---------------------------------------------------------------------------------------------------------------------
					// Make a POST Request to Messaging API to reply to sender
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
	*/	 
		// save data url
		$url = 'http://103.253.75.184/post_callback.php';
				
		$myvars = 'rawdata=' . $response ;
		
		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec( $ch );
		curl_close($ch);		
	
	
echo "OK , reponse = ".$response.;
?>
