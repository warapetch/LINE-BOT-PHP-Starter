<?php
// file : line_notify_setup.php
//------------------------------------------------------------------------------------
// Set time zone = thai +7
date_default_timezone_set('Asia/Bangkok');

// BOT LINE@
define('LINE_BOT_CHANNEL_ACCESS_TOKEN','doQP7zT8D1d55KBBmrSlkuYsRQL2x6I+xAQvTI963bInXFZp+gjYXLRic73R4Cwy90xFMfs/W3XPONeFmTQ+bbZAcGy/XshJDppaQfpXywrAkGfIEvcxbfwc/98W2ilmiAAjkRXafEGd0vAI6bIkjwdB04t89/1O/w1cDnyilFU=');
define('POST_LINE_BOT_DATA_URL','http://103.253.75.184/post_user_id.php');


// LINE NOTIFY
define('LINE_NOTIFY_GET_TOKEN_URL','https://notify-bot.line.me/oauth/token');
define('LINE_NOTIFY_CLIENT_ID', 'TSsCKpdeq6LyZtwzgZjVdF');
define('LINE_NOTIFY_CLIENT_SECRET', 'Q53ll8T7LXdffYA4WH9yYAgH0WibkF0AHkRXjFCKLph');

define('LINE_NOTIFY_CALLBACK_URL', 'http://103.253.75.184/line_notify_callback.php');
define('POST_LINE_NOTIFY_DATA_URL','http://103.253.75.184/line_notify_post_token.php');

?>
