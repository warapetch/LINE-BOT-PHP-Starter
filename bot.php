<?php
// last update : 60-04-21 15.30 //
	
function DateThai($strDate)
{
$time_zone = 7;
$strYear = date("Y",strtotime($strDate))+543;
$strMonth= date("n",strtotime($strDate));
$strDay= date("j",strtotime($strDate));
$strHour= date("H",strtotime($strDate))+$time_zone;
$strMinute= date("i",strtotime($strDate));
$strSeconds= date("s",strtotime($strDate));
$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
$strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}

$channel_access_token = 'E9c+4o7Kfy4N49DvsotR4kI7bZtM6bc8QzZZEcyAarMn0FYEPsIVNVicU7w5BhxcNDelY+ZeMRjk92F8CRniTQXRffGkzhNcP9QVgwUdS9PykBAd1vTSLTfjmL0qmQnucK76cjoDo9e1nX/cbhaxagdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');

// Parse JSON
$events = json_decode($content, true);
$raw_text_income  = json_encode($events);


// Initialize
$is_type_user     = false;
$dat_displayname  = '';
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
			if ($is_type_user) {
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
			if ($text == 'data'){
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
			if (($text == 'สวัสดี') || ($text == 'd') || ($text == 'ไง')) { $text = 'สวัสดีครับ' ;}
			else
			if (($text == 'วันนี้') || ($text == 'เวลา') || ($text == 'วัน')) { $text = DateThai(now); }
				
			$messages = [
			           'type' => 'text',
			   	   'text' => '(พิมพ์คำว่า data เพื่อดูข้อมูล) .. Bot Echo = '.$text
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
		}
	}
 
// save data url
//$url = 'http://www.plkhealth.go.th/script/updateuser.php';
$url = 'http://103.253.75.184/updateuser.php';
//$dat_displayname = quoted_printable_decode($dat_displayname);
//$dat_statusmsg   = html_entity_decode(preg_replace("/U\+([0-9A-F]{4,5})/", "&#x\\1;", $dat_statusmsg), ENT_COMPAT | ENT_HTML401, 'UTF-8');	
$myvars = 'userid=' . $userid . 
	  '&display_name='.$dat_displayname.
	  '&status_message='.$dat_statusmsg. 
	  '&picture_url='. $dat_pictureurl. 
	  '&project='.$dat_project_code.
	  '&group_user='.$dat_project_group_user;

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
curl_close($ch);	
	
}
	
echo "OK : token = ".$replyToken.' userid = '.$userid;
?>
