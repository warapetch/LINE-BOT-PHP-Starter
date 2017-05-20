<?php
// file : line-bot.php
// last update : 60-04-22 12.40 //
//------------------------------------------------------
include "line_notify_setup.php";

function DateThai($strDate)
{
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strHour= date("H",strtotime($strDate));
	$strMinute= date("i",strtotime($strDate));
	$strSeconds= date("s",strtotime($strDate));
	$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$strMonthThai=$strMonthCut[$strMonth];
	
return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}

// < YOUR CHANNEL_ACCESS_TOKEN >
$channel_access_token = LINE_BOT_CHANNEL_ACCESS_TOKEN;

// Get POST body content
$content = file_get_contents('php://input');

// Parse JSON
$events = json_decode($content, true);
$raw_text_income  = json_encode($events);

// Initialize
$is_type_user     = false;
$dat_displayname  = '<NULL>';
$dat_userid       = '';
$dat_pictureurl   = '';
$dat_statusmsg    = '';
$dat_project_code	  = 'project1';
$dat_project_group_user	  = 'all';

	// Case Message from ...
	if  ($events['events'][0]['source']['type'] == 'user') 
		{
			$userid = $events['events'][0]['source']['userId'];
			$usercaption = ' userid=';
			$is_type_user = true; // for get user profile
		}
	else
		if  ($events['events'][0]['source']['type'] == 'group') 
		{
			$userid = $events['events'][0]['source']['groupId'];
			$usercaption = ' groupid=';
		}
	else
	{
			$userid = $events['events'][0]['source']['roomId'];
			$usercaption = ' roomid=';	
	}


		// Validate parsed JSON data
		if (!is_null($events['events'])) {
			
			// Loop through each event
			foreach ($events['events'] as $event) {
				
				// Reply only when message sent is in 'text' format
				if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
					// Get text sent
					$text = $event['message']['text'];
							
					// Get replyToken
					$replyToken = $event['replyToken'];
					
					
					// Get User Profile Only Message come from User
					if ($is_type_user) 
					 {
						$url = 'https://api.line.me/v2/bot/profile/'.$userid;
						$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $channel_access_token);
						$ch = curl_init($url);
						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);				
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
						$result = curl_exec($ch);
						curl_close($ch);
						
						$raw_text_income  = $result;
						$userprofile      = json_decode($raw_text_income,true);
						$dat_displayname  = $userprofile['displayName'];
						$dat_userid       = $userprofile['userId'];
						$dat_pictureurl   = $userprofile['pictureUrl'];
						$dat_statusmsg    = $userprofile['statusMessage'];
						
					}
					
					// Build message to reply back
					//---------------------------------------------------------------------------------------------------------------------
					if (($text == 'register') || ($text == 'สมัคร')) {
					   $messages = [
								   'type' => 'text',
									'text' => 'ข้อมูลคุณคือ >> '."\n\r".'"Reply Token" = '.$replyToken.
									"\n\r".' "Display" = '.$dat_displayname.
									"\n\r".' "UserId" = '.$dat_userid.
									"\n\r".' "Picture URL" ='.$dat_pictureurl.
									"\n\r".' "Status Message" = '.$dat_statusmsg
									];
						}
					else
					{
					// CASE AI , SEARCH , INQUERY
					if (($text == 'สวัสดี') || (strtolower($text) == 'd') || ($text == 'ไง')) { $text = 'สวัสดีครับ' ;}
					else
					if (($text == 'วันนี้') || ($text == 'เวลา') || ($text == 'วัน')) { $text = DateThai(now); }
						
					$messages = [
							'type' => 'text',
						        'text' => '(พิมพ์คำว่า register หรือ สมัคร เพื่อลงทะเบียนรับข่าวสาร) '."\n\r".'Echo = '.$text
						    ];			
					}
					
					//---------------------------------------------------------------------------------------------------------------------
					// Make a POST Request to Messaging API to reply to sender
					$url = 'https://api.line.me/v2/bot/message/reply';
					$data = [
						'replyToken' => $replyToken,
						'messages' => [$messages],
					         ];
					
					$post = json_encode($data);
					$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $channel_access_token);
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					$result = curl_exec($ch);
					curl_close($ch);
					echo $result . "\r\n";
				} // cast text
			} // loop events
		 
		// save data url
                // <YOUR POST DATA URL> 
		$url = POST_LINE_BOT_DATA_URL;
					
		$myvars = 'userid=' . $userid . 
			  '&display_name='.$dat_displayname.
			  '&status_message='.$dat_statusmsg. 
			  '&picture_url='. $dat_pictureurl. 
			  '&project='.$dat_project_code.
			  '&group_user='.$dat_project_group_user			  
			  ;
		
		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);		
		$response = curl_exec( $ch );
		echo "post data = ".$response;
		curl_close($ch);		
	} // Events <> ''
	
echo "OK : token = ".$replyToken.' userid = '.$userid;
	// OPEN NEW PAGE
	//$myvars = 'userid='.$userid;
    	//header("Location: line_bot_success.php?".$myvars);

?>
