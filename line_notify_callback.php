<?php
// Line Notify Callback
// ได้รับการ ช่วยเหลือจาก คุณ ศุภชัย วิสาชัย  http://www.wisadev.com //
// 26/4/2560
$client_id = 'TSsCKpdeq6LyZtwzgZjVdF';
$client_secret = 'Q53ll8T7LXdffYA4WH9yYAgH0WibkF0AHkRXjFCKLph';
$redirect_uri = 'https://fitness-thai.herokuapp.com/callback.php';

//echo "Enter process ...#1"."\n\r";
if (isset($_GET["code"])&&isset($_GET["state"]))
   {
	$postdata = 'grant_type=authorization_code';
	$postdata = $postdata.'&code='.$_GET["code"];
	$postdata = $postdata.'&redirect_uri='.$redirect_uri;
	$postdata = $postdata.'&client_id='.$client_id;
	$postdata = $postdata.'&client_secret='.$client_secret;
	
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-bot.line.me/oauth/token"); 
	// SSL USE 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	//POST 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	// Message 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, $postdata); 
	curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
	//RETURN 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 
        
	$result_ = json_decode($result, true); 
	//echo "post get token : ".$result." status = ".$result_['status']."\n\r";
	
	if(curl_error($chOne))
	  {
				echo 'error get token :' . curl_error($chOne)."\n\r";
			 }

	
	if ($result_['status'] == 200) 
	   {	
		//echo "enter post data ..."."\n\r";
		// save data url
		$url = 'http://103.253.75.184/post_callback.php';
	
		$myvars = 'state='.$_GET["state"].'&access_token='.$result_['access_token'];
		
		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec( $ch );
		curl_close($ch);		
	}
	//echo "OK passed 1+2"."\n\r";
	$myvars = 'state='.$_GET["state"].'&access_token='.$result_['access_token'];
    	header("Location: line_notify_success.php?".$myvars);

}
//echo "end process"."\n\r";
?>
