<?php
require_once('mysql_connect.php');
date_default_timezone_set('UTC');

$user_id = '1';
$bet_history_query = "SELECT amount, settled, bet_type_id, game_id, side, line, odds FROM `bets` WHERE user_id = '$user_id'";

//full data attempt
$result = mysqli_query($conn, $bet_history_query);
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

$output = [
    ['gameid' => '123', 'date' =>'2016-10-28 00:25:00','type'=>'moneyline', 'side'=>1,'home'=>'ten','away'=>'jax', 'odds' =>'-110'],
    ['gameid' => '124','date' =>'2016-10-30 13:30:00','type'=>'moneyline', 'side'=>1,'home'=>'cin','away'=>'was','odds' =>'-110'],
    ['gameid' => '125','date' =>'2016-10-30 20:25:00','type'=>'over/under', 'side'=>0,'home'=>'atl','away'=>'gb','odds' =>'-110'],
    ['gameid' => '126','date' =>'2016-10-30 20:05:00','type'=>'spread', 'side'=>0,'home'=>'dal','away'=>'phi','odds' =>'-110'],
    ['gameid' => '127','date' =>'2016-10-31 00:30:00','type'=>'spread', 'side'=>0,'home'=>'chi','away'=>'min','odds' =>'-110'],

];

$encoded_output = json_encode($output);
print($encoded_output);


//json encode the data
//$json_encoded_object = json_encode($data);
//print the json encoded object
//print($json_encoded_object);
?>