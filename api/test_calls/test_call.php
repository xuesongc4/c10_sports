<?php
// football: 15
// NFL: 889
// NCAAF: 880

// basketball:4
// NBA preseason id: 5270
// NBA id: 487
// NCAAB: 493
// NCAAB Overtime: 497

// baseball: 3
// MLB: 246

// hockey: 19
// NHL: 1456
// NHL Regular Time: 1461
// NHL OT Included: 1460
// NHL OT Included Alternates: 5445


require('../curl_call_setup.php');

//This fetches the initial feed from the Pinnacle Sports API
$feedUrl = 'https://api.pinnacle.com/v2/leagues?sportid=19';

// // NFL
// $feedUrl = 'https://api.pinnacle.com/v1/odds?sportid=15&leagueids=889';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures?sportid=15&leagueids=889';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures/settled?sportid=15&leagueids=889';

// // NBA
// $feedUrl = 'https://api.pinnacle.com/v1/odds?sportid=4&leagueids=487';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures?sportid=4&leagueids=487';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures/settled?sportid=4&leagueids=487';

// // MLB
// $feedUrl = 'https://api.pinnacle.com/v1/odds?sportid=3&leagueids=246';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures?sportid=3&leagueids=246';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures/settled?sportid=3&leagueids=246';

// // NHL
// $feedUrl = 'https://api.pinnacle.com/v1/odds?sportid=19&leagueids=1460';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures?sportid=19&leagueids=1460';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures/settled?sportid=19&leagueids=1460';

// // CFB
// $feedUrl = 'https://api.pinnacle.com/v1/odds?sportid=15&leagueids=880';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures?sportid=15&leagueids=880';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures/settled?sportid=15&leagueids=880';

// // CBB
// $feedUrl = 'https://api.pinnacle.com/v1/odds?sportid=4&leagueids=493';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures?sportid=4&leagueids=493';
// $feedUrl = 'https://api.pinnacle.com/v1/fixtures/settled?sportid=4&leagueids=493';

curl_setopt($httpChannel, CURLOPT_URL, $feedUrl);

$initialFeed = curl_exec($httpChannel);
$decoded = json_decode($initialFeed);
// echo $initialFeed;
echo "<pre>";
print_r($decoded);
echo "<pre>";


// $file = fopen("test.php","w");
// echo fwrite($file,$initialFeed);
// fclose($file);

// $file = file_get_contents('./test.php', true);
// $decoded = json_decode($file);
// echo "<pre>";
// print_r($decoded);
// echo "<pre>";


// // You need to pick an XML library that is suitable for you, in this case i am using the built-in simple XML feature of PHP.
// $xmlDocument = simplexml_load_string($initialFeed);
// // Simple XML has now build an array of arrays or a dictionary of values, you may access this information by index or name.
// $feedTime = $xmlDocument->rsp->fd[0]->fdTime;
// echo $fdTime;
// // Now we simply alter the URL with the last parameter and feed in the value of fdTime
// $feedUrl = 'https://api.pinnaclesports.com/v1/odds?sportid=29&last=' . $fdTime;
// // Now we can fetch the updates.
// $updates = curl_exec($httpChannel);
// // Build an XML document from simple XML to read your data as an object again.
// // ...
?>