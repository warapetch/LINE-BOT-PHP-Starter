<?php
$access_token = 'E9c+4o7Kfy4N49DvsotR4kI7bZtM6bc8QzZZEcyAarMn0FYEPsIVNVicU7w5BhxcNDelY+ZeMRjk92F8CRniTQXRffGkzhNcP9QVgwUdS9PykBAd1vTSLTfjmL0qmQnucK76cjoDo9e1nX/cbhaxagdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
