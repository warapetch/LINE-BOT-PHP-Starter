<? php
  
  $response_json_str = file_get_contents('https://notify-bot.line.me/oauth/token', false, $context);
        
  $response = json_decode($response_json_str, true);
  
  if (!isset($response['status']) || $response['status'] != 200 || !isset($response['access_token'])) {
  
        $this->lastError = [
                'message' => 'Request failed',
                'http_response_header' => $http_response_header,
                'response_json' => $response_json_str
            ];
            return false;
            
        } 
        else 
        if (preg_match('/[^a-zA-Z0-9]/u', $response['access_token'])) {
            $this->lastError = [
                'message' => 'access_token',
                'access_token' => $response['access_token'],
                'http_response_header' => $http_response_header,
                'response_json' => $response_json_str
            ];
            return false;
        } else {
            return $response['access_token'];
        }
        
?>        
