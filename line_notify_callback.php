<?php
// Line Notify Callback
// ได้รับการ ช่วยเหลือจาก คุณ ศุภชัย วิสาชัย  http://www.wisadev.com //
// 26/4/2560
//------------------------------------------------------------------------------
include "line_notify_setup.php";



if (isset($_GET["code"])&&isset($_GET["state"]))
   {
	$postdata = 'grant_type=authorization_code';
	$postdata = $postdata.'&code='.$_GET["code"];
	$postdata = $postdata.'&redirect_uri='.LINE_NOTIFY_CALLBACK_URL;
	$postdata = $postdata.'&client_id='.LINE_NOTIFY_CLIENT_ID;
	$postdata = $postdata.'&client_secret='.LINE_NOTIFY_CLIENT_SECRET;
	
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, LINE_NOTIFY_GET_TOKEN_URL); 
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
			
		$myvars = 'state='.$_GET["state"].'&access_token='.$result_['access_token'];
		
		$ch = curl_init( POST_LINE_NOTIFY_DATA_URL );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec( $ch );
		curl_close($ch);		
	}
	//echo "OK passed 1+2"."\n\r";
        // state = Display Name for bot  
	$myvars = 'state='.urlencode($_GET["state"]).'&access_token='.$result_['access_token'];
    	header("Location: line_notify_success.php?".$myvars);

}
//echo "end process"."\n\r";
?>
