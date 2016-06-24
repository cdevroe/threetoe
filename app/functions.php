<?php
/**
 * Functions
*/

function threetoe_respond() {
  global $_POST, $data_location, $twilio_sid, $twilio_token, $twilio_phonenumber, $test_phonenumber;
  $message_from_user = '';

  // Did sender post a code?
  if ( isset($_POST['Body']) ) :
    $filename = $_POST['Body'];
  endif;

  // Get phone number of sender to respond to
  if ( isset($_POST['From']) ) :
    $respond_to = $_POST['From'];
  else :
    $respond_to = $test_phonenumber;
  endif;

  // If no code given, automatically respond with nopropertyinfo.txt
  $filename =     ( isset($filename) ) ? strtolower($filename) . '.txt' : 'nopropertyinfo.txt';
  // If code response found, use file, if not, automatically respond with nopropertyinfo.txt
  $filename =     ( file_exists($data_location.$filename) ) ? $filename : 'nopropertyinfo.txt';

  $file_handle =  fopen($data_location.$filename, "r");
  $response =     fread($file_handle, filesize($data_location.$filename));

  // Use Twilio to respond
  $client = new Services_Twilio($twilio_sid, $twilio_token);
  $message = $client->account->messages->create(array(
    'From' => $twilio_phonenumber, // Valid Twilio number
    'To' => $respond_to, // Send SMS response to this number
    'Body' => $response
  ));

  return;
}
?>
