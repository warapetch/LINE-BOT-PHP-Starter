<?php
//require 'connection.php';  

$access_token = 'E9c+4o7Kfy4N49DvsotR4kI7bZtM6bc8QzZZEcyAarMn0FYEPsIVNVicU7w5BhxcNDelY+ZeMRjk92F8CRniTQXRffGkzhNcP9QVgwUdS9PykBAd1vTSLTfjmL0qmQnucK76cjoDo9e1nX/cbhaxagdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');

// Parse JSON
$events = json_decode($content, true);
$datas = json_encode($events);

if  ($events['events'][0]['source']['type'] == 'user') 
    {
		$userid = $events['events'][0]['source']['userId'];
		$usercaption = ' userid=';
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
			
			// Build message to reply back
			if ($text == 'id'){
			   $messages = [
				           'type' => 'text',
							'text' => 'ข้อมูลคุณคือ '.$text.' Dynamic Token = '.$replyToken.' |'.$usercaption.$userid.'| data='.$datas
							];
				}
			else
			$messages = [
				           'type' => 'text',
							'text' => 'Echo .. '.$text
							];			
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
 // บันทึกลงฐาน
  $sql = "insert ignore into lineuser(userid,linetoken) values ('$userid','$replyToken')";
    
  if ( mysql_query($sql)){ 
	  }else { 
	   echo "error message : ".mysql_error();
      } 
// 
		}
	}
}
echo "OK : token = ".$replyToken.' userid = '.$userid;
?>
