<?php

function threetoe_send_sms() {
  global $_POST, $data_location, $twilio_sid, $twilio_token, $twilio_phonenumber, $test_phonenumber;
  $message_from_user = '';

  if ( isset($_POST['Body']) ) :
    $filename = $_POST['Body'];
  endif;

  if ( isset($_POST['From']) ) :
    $send_to = $_POST['From'];
  else :
    $send_to = $test_phonenumber;
  endif;

  $filename = ( isset($filename) ) ? strtolower($filename) . '.txt' : 'noinfo.txt';

  if ( file_exists($data_location.$filename) ) :
    $file_handle =  fopen($data_location.$filename, "r");
    $response =     fread($file_handle, filesize($data_location.$filename));
  else :
    $response =     'House information not found.';
  endif;

  /*DEBUG if ( isset($_POST) ) :
    foreach ($_POST as $k=>$v) :
      $post_response .= $k . ' = ' . $v;
    endforeach;
  endif;*/

  $client = new Services_Twilio($twilio_sid, $twilio_token);
  $message = $client->account->messages->create(array(
    'From' => $twilio_phonenumber, // Valid Twilio number
    'To' => $send_to, // Text this number
    'Body' => $response
  ));

  return;

}
?>
