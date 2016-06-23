<?php

function threetoe_send_sms($filename) {
  global $data_location, $twilio_sid, $twilio_token;

  $filename = ( isset($filename) ) ? $filename . '.txt' : '0001.txt';

  if ( file_exists($data_location.$filename) ) :
    $file_handle = fopen($data_location.$filename, "r");
    $response =    fread($file_handle, filesize($data_location.$filename));
  else :
    $response = 'House information not found.';
  endif;

  return $response;

  /*$client = new Services_Twilio($sid, $token);
  $message = $client->account->messages->sendMessage(
    '9991231234', // From a valid Twilio number
    '5702674662', // Text this number
    "Hello there."
  );*/

}






<?php
// Install the library via PEAR or download the .zip file to your project folder.
// This line loads the library
require('/path/to/twilio-php/Services/Twilio.php');

$sid = "ACXXXXXX"; // Your Account SID from www.twilio.com/user/account
$token = "YYYYYY"; // Your Auth Token from www.twilio.com/user/account

$client = new Services_Twilio($sid, $token);
$message = $client->account->messages->sendMessage(
  '9991231234', // From a valid Twilio number
  '8881231234', // Text this number
  "Hello monkey!"
);

print $message->sid;


 ?>
