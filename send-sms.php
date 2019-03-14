<?php
/*
* Requirements: your PHP installation needs cUrl support, which not all PHP installations
* include by default.
*
* Substitute your own username, password, mno, Sid, fl, mt, ipcl, and message in seven_bit_msg
*then run the code:
*/
$username = 'username';
$password = 'password';
$fl = '0';
$mt = '0';
$ipcl = 'ip address for receiver';
$seven_bit_msg = "Message will be written here";
/*
* Your phone number, including country code, i.e. 60123456756:
*/
$mno = 'Reciever phone number';
$Sid = 'test';
/*
* 
*/
$url = 'https://1s2u.com/sms/sendsms/sendsms.asp';
$post_fields = array(
    'username' => $username,
    'password' => $password,
    'mt' => $mt,
    'fl' => $fl,
    'Sid' => $Sid,
    'mno' => $mno,
    'ipcl' => $ipcl,
    'msg' => $seven_bit_msg
);
$get_url = $url . "?" . http_build_query($post_fields);
/*
* A 7-bit GSM SMS message can contain up to 160 characters (longer messages can be
* achieved using concatenation).
*
* All non-alphanumeric 7-bit GSM characters are included in this example. Note that Greek characters,
* and extended GSM characters (e.g. the caret "^"), may not be supported
* to all networks. Please let us know if you require support for any characters that
* do not appear to work to your network.
*/
/*
* Sending 7-bit message
*/
$post_body = seven_bit_sms( $username, $password, $seven_bit_msg, $mno, $Sid, $fl, $mt, $ipcl);
$result = send_message( $post_body, $get_url );
if( $result['success'] ) {
  print_ln( formatted_server_response( $result ) );
}
else {
  print_ln( formatted_server_response( $result ) );
}
/*
* If you don't see this, and no errors appeared to screen, you should
* check your Web server's error logs for error output:
*/
print_ln("Script completely ran.");
function print_ln($content) {
  if (isset($_SERVER["SERVER_NAME"])) {
    print $content."<br />";
  }
  else {
    print $content."\n";
  }
}
function formatted_server_response( $result ) {
  $this_result = "";
  if ($result['success']) {
    $this_result .= "Success: ID ".$result['id'];
  }
  else {
    $this_result .= "Fatal error: HTTP status " .$result['http_status_code']. ", API status " .$result['api_status_code']. " Full details " .$result['details'];
  }
  return $this_result;
}
function send_message ( $post_body, $get_url ) {
  $ch = curl_init( );
  curl_setopt ( $ch, CURLOPT_URL, $get_url );
  curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
  // Allowing cUrl funtions 20 second to execute
  curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
  // Waiting 20 seconds while trying to connect
  curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response_string = curl_exec( $ch );
  $curl_info = curl_getinfo( $ch );
  $sms_result = array();
  $sms_result['success'] = 0;
  $sms_result['details'] = '';
  $sms_result['http_status_code'] = $curl_info['http_code'];
  $sms_result['api_status_code'] = '';
  $sms_result['id'] = $response_string;
  if ( $response_string == FALSE ) {
    $sms_result['details'] .= "cURL error: " . curl_error( $ch ) . "\n";
  } elseif ( $curl_info[ 'http_code' ] != 200 ) {
    $sms_result['details'] .= "Error: non-200 HTTP status code: " . $curl_info[ 'http_code' ] . "\n";
  }
  else {
    $sms_result['details'] .= "Response from server: $response_string\n";
    $api_result = substr($response_string, 0, 4);
    $status_code = $api_result;
    $sms_result['api_status_code'] = $status_code;
    if ( $api_result != 2019 ) {
      $sms_result['details'] .= "Error: could not parse valid return data from server.\n" . $api_result;
    } else {
      if ($status_code == '2019') {
        $sms_result['success'] = 1;
      }
    }
  }
  curl_close( $ch );
  return $sms_result;
}
function seven_bit_sms ( $username, $password, $message, $mno, $sid, $fl, $mt, $ipcl ) {
  $post_fields = array (
  'username' => $username,
  'password' => $password,
  'mno'   => $mno,
  'sid' => $sid,
  'sfl' => $fl,
  'mt' => $mt,
  'ipcl' => $ipcl,
  'message'  => $message
  );
  return make_post_body($post_fields);
}
function make_post_body($post_fields) {
  $stop_dup_id = make_stop_dup_id();
  if ($stop_dup_id > 0) {
    $post_fields['stop_dup_id'] = make_stop_dup_id();
  }
  $post_body = '';
  foreach( $post_fields as $key => $value ) {
    $post_body .= urlencode( $key ).'='.urlencode( $value ).'&';
  }
  $post_body = rtrim( $post_body,'&' );
  return $post_body;
}
function make_stop_dup_id() {
  return 0;
}
?>
