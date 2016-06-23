<?php

function threetoe_send_sms($filename) {
  global $data_location, $twilio_sid, $twilio_token, $twilio_phonenumber, $test_phonenumber;

  $filename = ( isset($filename) ) ? $filename . '.txt' : '0001.txt';

  if ( file_exists($data_location.$filename) ) :
    $file_handle =  fopen($data_location.$filename, "r");
    $response =     fread($file_handle, filesize($data_location.$filename));
  else :
    $response =     'House information not found.';
  endif;

  return $response;

  $client = new Services_Twilio($sid, $token);
  $message = $client->account->messages->sendMessage(
    $twilio_phonenumber, // Valid Twilio number
    $test_phonenumber, // Text this number
    $response
  );

}
?>
