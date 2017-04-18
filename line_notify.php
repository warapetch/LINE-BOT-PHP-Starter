<?php
/*
 *  original code from
    http://www.thaicreate.com/php/forum/127172.html
    https://havespirit.blogspot.com
    :: Modify by Warapetch rpvs
    
    docuemnt from
    https://notify-bot.line.me/doc/en/
   
 ----------------------------------------------   
 POST https://notify-api.line.me/api/notify
 ----------------------------------------------
Sends notifications to users or groups that are related to an access token.
If this API receives a status code 401 when called, the access token will be deactivated on LINE Notify
(disabled by the user in most cases). Connected services will also delete the connection information.
Requests use POST method with application/x-www-form-urlencoded (Identical to the default HTML form transfer type).

Expected use cases
When a connected service has an event that needs to send a notification to LINE
Request method
Request methods/headers	Value
Method	POST
Content-Type	application/x-www-form-urlencoded
OR
multipart/form-data

Authorization	Bearer <access_token>

Request parameters
The parameters are as follows.
Parameter name	    Required/optional	Type	Description
message	            Required	String	1000 characters max
imageThumbnail	    Optional	HTTP/HTTPS URL	Maximum size of 240×240px JPEG
imageFullsize	    Optional	HTTP/HTTPS URL	Maximum size of 1024×1024px JPEG
imageFile	        Optional	File	
                                Upload a image file to the LINE server.
                                Supported image format is png and jpeg.
                                If you specified imageThumbnail ,imageFullsize and imageFile, imageFile takes precedence.
                                There is a limit that you can upload to within one hour.
                                For more information, please see the section of the API Rate Limit.
stickerPackageId	Optional	Number	Package ID.
                                Sticker List.
stickerId	        Optional	Number	Sticker ID.
*/


// Get query value
$in_token = $_GET['token'];
$in_message = $_GET['msg'];
$in_image_thumb  = $_GET['imgthumb'];
$in_image_full   = $_GET['imgfull'];
$in_stk_pkg      = $_GET['stk_pkg'];
$in_stk_id       = $_GET['stk_id'];

$chOne = curl_init();

curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 

// SSL USE 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 

//POST 
curl_setopt( $chOne, CURLOPT_POST, 1); 

// Message
if ($in_message != '') {
    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$in_message); }

// Image
if ($in_image_full != '') { 
   curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$in_message."&imageThumbnail=".$in_image_thumb."&imageFullsize=".$in_image_full);
}

// Sticker
if ($in_stk_pkg != '') {
    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$in_message."&stickerPackageId=".$in_stk_pkg."&stickerId=".$in_stk_id);    
}
    
// follow redirects 
curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 

//ADD header array 
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$in_token, ); 
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 

//RETURN 
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne ); 

//Check error 
if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); } 
else { $result_ = json_decode($result, true); 
echo "status : ".$result_['status']; echo " message : ". $result_['message']; } 

//Close connect 
curl_close( $chOne );

?>
