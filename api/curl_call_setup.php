<?php 
require('mysql_connect.php');
// Set your credentials here, format = clientid:password from your account.
$credentials = base64_encode(API_CLIENT_ID . ':' . API_PASS);
// Build the header, the content-type can also be application/json if needed
$header[] = 'Content-length: 0';
$header[] = 'Content-type: application/json';
$header[] = 'Authorization: Basic ' . $credentials;
// Set up a CURL channel.
$httpChannel = curl_init();
// Prime the channel
curl_setopt($httpChannel, CURLOPT_RETURNTRANSFER, true);
curl_setopt($httpChannel, CURLOPT_HTTPHEADER, $header);
curl_setopt($httpChannel, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)' );
// Unless you have all the CA certificates installed in your trusted root authority, this should be left as false.
curl_setopt($httpChannel, CURLOPT_SSL_VERIFYPEER, false);
 ?>