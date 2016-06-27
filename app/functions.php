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

function responses_add($code) {
  global $_POST, $data_location, $configure_password;

  if ( $_POST['password'] != $configure_password ) :
    die('Incorrect password provided.');
  endif;

  if ( !$code ) return;

  $code = strtolower(str_replace(' ','',$code));

  $filename = $code.'.txt';

  $file_handle =  fopen($data_location.$filename, "w");
  fwrite ( $file_handle , 'Write a response for this code.' );

  header('Location: http://threetoe.cd/configure/?response='.$code);
  exit;
  return;
}

function responses_edit($code,$response) {
  global $_POST, $data_location, $configure_password;

  if ( $_POST['password'] != $configure_password ) :
    die('Incorrect password provided.');
  endif;

  if ( !$code ) return;

  if ( !$response ) return;

  $code = strtolower(str_replace(' ','',$code));
  $filename = $code.'.txt';

  $file_handle =  fopen($data_location.$filename, "w");
  fwrite ( $file_handle , $response );

  header('Location: http://threetoe.cd/configure/?response='.$code);
  exit;
  return;
}

function responses_delete($code) {
  global $_POST, $data_location, $configure_password;

  if ( $_POST['password'] != $configure_password ) :
    die('Incorrect password provided.');
  endif;

  $code = strtolower($code);
  $filename = $code.'.txt';

  unlink($data_location.$filename);
  header('Location: http://threetoe.cd/configure/');
  exit;
  return;
}

function responses_list() {
  global $data_location;

  $responses = array();

  if ( file_exists($data_location) ) :
    foreach( glob($data_location.'*.txt') as $filename ) :
      $filename = str_replace($data_location, '', $filename); // Remove path
      $filename = str_replace('.txt', '', $filename); // Remove .txt
      $filename = strtolower($filename); // Make lowercase

      $responses[] = $filename;
    endforeach;
  endif;

  return $responses;
}

function responses_load($response) {
  global $data_location;
  $filename = strtolower($response).'.txt';

  //echo $data_location.$filename;

  if ( file_exists($data_location.$filename) ) :
    //echo 'hi 2';
    $file_handle =  fopen($data_location.$filename, "r");
    $response =     fread($file_handle, filesize($data_location.$filename));

    return $response;
  else :
    return false;
  endif;

  return false;
}

?>
