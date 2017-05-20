<?php
// file : line_notify_setup.php

date_default_timezone_set('Asia/Bangkok');

define('LINE_NOTIFY_GET_TOKEN_URL','https://notify-bot.line.me/oauth/token');
define('LINE_NOTIFY_CLIENT_ID', 'TSsCKpdeq6LyZtwzgZjVdF');
define('LINE_NOTIFY_CLIENT_SECRET', 'Q53ll8T7LXdffYA4WH9yYAgH0WibkF0AHkRXjFCKLph');

define('LINE_NOTIFY_CALLBACK_URL', 'http://103.253.75.184/line_notify_callback.php');
define('POST_LINE_NOTIFY_DATA_URL','http://103.253.75.184/line_notify_post_token.php');

?>
