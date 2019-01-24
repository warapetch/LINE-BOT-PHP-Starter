<?php
// file : line_notify_setup.php
// Create : 60-04-22 12.40 //
// last update : 60-05-29 12.40 //
//------------------------------------------------------------------------------
// Set time zone = thai +7
date_default_timezone_set('Asia/Bangkok');

// BOT LINE@
//define('LINE_BOT_CHANNEL_ACCESS_TOKEN', <YOUR_ACCESS_TOKEN> );
//define('POST_LINE_BOT_DATA_URL',<YOUR_URL_PHP_POST_USER_ID>);


// LINE NOTIFY
//define('LINE_NOTIFY_GET_TOKEN_URL','https://notify-bot.line.me/oauth/token');
//define('LINE_NOTIFY_CLIENT_ID', <YOUR_CLIENT_ID>);
//define('LINE_NOTIFY_CLIENT_SECRET', <YOUR_CLIENT_SECRET>);

//define('LINE_NOTIFY_CALLBACK_URL', <YOUR_URL_CALLBACK>);
//define('POST_LINE_NOTIFY_DATA_URL',<YOUR_URL_POST_TOKEN>);
//------------------------------------------------------------------------------
 
 // BOT LINE@
define('LINE_BOT_CHANNEL_ACCESS_TOKEN','doQP7zT8D1d55KBBmrSlkuYsRQL2x6I+xAQvTI963bInXFZp+gjYXLRic73R4Cwy90xFMfs/W3XPONeFmTQ+bbZAcGy/XshJDppaQfpXywrAkGfIEvcxbfwc/98W2ilmiAAjkRXafEGd0vAI6bIkjwdB04t89/1O/w1cDnyilFU=');
define('POST_LINE_BOT_DATA_URL','https://fitness-thai.herokuapp.com/post_user_id.php');
 
 
 // LINE NOTIFY
$XLine_Notify_GetToken_URL      = 'https://notify-bot.line.me/oauth/token';  // FIXED
$XLine_Notify_GetAuthorize_URL  = 'https://notify-bot.line.me/oauth/authorize'; // FIXED
$XLine_Notify_Callback_URL      = 'https://fitness-thai.herokuapp.com/line_notify_callback.php'; // ดูจาก Line Notify ว่ากำหนดไว้ว่าอะไร
$XPost_Line_Notify_Data_URL     = 'https://fitness-thai.herokuapp.com/line_notify_post_token.php'; // สำหรับ ส่งข้อมูลไป บันทึก

$XLine_Notify_Client_ID     = 'TSsCKpdeq6LyZtwzgZjVdF';  // ดูจาก Line Notify
$XLine_Notify_Client_Secret = 'Q53ll8T7LXdffYA4WH9yYAgH0WibkF0AHkRXjFCKLph';  // ดูจาก Line Notify


define('LINE_NOTIFY_GET_TOKEN_URL',$XLine_Notify_GetToken_URL);
define('LINE_NOTIFY_CLIENT_ID', $XLine_Notify_Client_ID);
define('LINE_NOTIFY_CLIENT_SECRET', $XLine_Notify_Client_Secret);
 
define('LINE_NOTIFY_CALLBACK_URL', $XLine_Notify_Callback_URL);
define('POST_LINE_NOTIFY_DATA_URL',$XPost_Line_Notify_Data_URL);


define('LINE_NOTIFY_AUTHORIZE_URL_FOR_CLIENT',$XLine_Notify_GetAuthorize_URL.'?response_type=code'.
              '&client_id='.$XLine_Notify_Client_ID.'&redirect_uri='.$XLine_Notify_Callback_URL.
              '&scope=notify&state='); // ค่า State รอ BOT เอา DisplayName มาผนวก

?>
