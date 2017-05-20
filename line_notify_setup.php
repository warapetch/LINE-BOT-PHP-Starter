<?php
// file : line_notify_setup.php
//------------------------------------------------------------------------------------
// Set time zone = thai +7
date_default_timezone_set('Asia/Bangkok');

// BOT LINE@
define('LINE_BOT_CHANNEL_ACCESS_TOKEN', <YOUR_ACCESS_TOKEN> );
define('POST_LINE_BOT_DATA_URL',<YOUR_URL_PHP_POST_USER_ID>);


// LINE NOTIFY
define('LINE_NOTIFY_GET_TOKEN_URL','https://notify-bot.line.me/oauth/token');
define('LINE_NOTIFY_CLIENT_ID', <YOUR_CLIENT_ID>);
define('LINE_NOTIFY_CLIENT_SECRET', <YOUR_CLIENT_SECRET>);

define('LINE_NOTIFY_CALLBACK_URL', <YOUR_URL_CALLBACK>);
define('POST_LINE_NOTIFY_DATA_URL',<YOUR_URL_POST_TOKEN>);

?>
