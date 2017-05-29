<?php
// file : line_notify_setup.php
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
define('POST_LINE_BOT_DATA_URL','http://103.253.75.184/post_user_id.php');
 
 
 // LINE NOTIFY
$Line_Notify_GetToken_URL      = 'https://notify-bot.line.me/oauth/token';
$Line_Notify_GetAuthorize_URL  = 'https://notify-bot.line.me/oauth/authorize';
$Line_Notify_Callback_URL  = 'http://103.253.75.184/line_notify_callback.php';
$Line_Notify_Client_ID     = 'TSsCKpdeq6LyZtwzgZjVdF';
$Line_Notify_Client_Secret = 'Q53ll8T7LXdffYA4WH9yYAgH0WibkF0AHkRXjFCKLph';
$Post_Line_Notify_Data_URL = 'http://103.253.75.184/line_notify_post_token.php';

define('LINE_NOTIFY_GET_TOKEN_URL',$Line_Notify_GetToken_URL);
define('LINE_NOTIFY_CLIENT_ID', $Line_Notify_Client_ID);
define('LINE_NOTIFY_CLIENT_SECRET', $Line_Notify_Client_Secret);
 
define('LINE_NOTIFY_CALLBACK_URL', $Line_Notify_Callback_URL);
define('POST_LINE_NOTIFY_DATA_URL',$Post_Line_Notify_Data_URL);

define('LINE_NOTIFY_AUTHORIZE_URL_FOR_CLIENT',$Line_Notify_GetAuthorize_URL.'?response_type=code'.
              '&client_id='+$Line_Notify_Client_ID.'&redirect_uri='+$Line_Notify_Callback_URL+
              '&scope=notify'+
              '&state='; // State wait for Bot

?>
