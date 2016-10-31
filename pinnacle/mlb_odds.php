<?php 
require('odds_call.php');
odds_call(3,246);

// // This fetches the initial feed from the Pinnacle Sports API
// $feedUrl = 'https://api.pinnacle.com/v1/odds?sportid=3&leagueids=246';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures?sportid=3&leagueids=246';
// // Set your credentials here, format = clientid:password from your account.
// $credentials = base64_encode("DC914164:D042290lp!");
// // Build the header, the content-type can also be application/json if needed
// $header[] = 'Content-length: 0';
// $header[] = 'Content-type: application/json';
// $header[] = 'Authorization: Basic ' . $credentials;
// // Set up a CURL channel.
// $httpChannel = curl_init();
// // Prime the channel
// curl_setopt($httpChannel, CURLOPT_URL, $feedUrl);
// curl_setopt($httpChannel, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($httpChannel, CURLOPT_HTTPHEADER, $header);
// curl_setopt($httpChannel, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)' );
// // Unless you have all the CA certificates installed in your trusted root authority, this should be left as false.
// curl_setopt($httpChannel, CURLOPT_SSL_VERIFYPEER, false);
// // This fetches the initial feed result. Next we will fetch the update using the fdTime value and the last URL parameter
// $initialFeed = curl_exec($httpChannel);
// $decoded = json_decode($initialFeed);
// // echo $initialFeed;
// echo "<pre>";
// print_r($decoded);
// echo "<pre>";
 ?>