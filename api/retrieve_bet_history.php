<?php
session_start();
require_once('mysql_connect.php');
date_default_timezone_set('UTC');

$user_id = $_SESSION['ID'];
//$user_id = '1';           //for testing only
//$bet_history_query = "SELECT amount, settled, bet_type_id, game_id, side, line, odds FROM `bets` WHERE user_id = '$user_id'";
$bet_history_query = "SELECT b.amount, bs.bet_status, a.full_name AS away_team, a.logo_src AS away_logo, h.full_name AS home_team, h.logo_src AS home_logo, g.game_time, bt.bet_name, b.side, b.odds
FROM `bets` AS b
JOIN `games` AS g ON g.ID = b.game_id
JOIN `bet_status` AS bs ON bs.ID = b.settled
JOIN `teams` AS h ON g.team_h_id = h.ID
JOIN `teams` AS a ON g.team_a_id = a.ID
JOIN `bet_types`AS bt ON bt.ID = b.bet_type_id
WHERE b.user_id = '$user_id'";
//full data attempt
$data = [];
$result = mysqli_query($connection, $bet_history_query);
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

//$output = [
//    ['gameid' => '123', 'date' =>'2016-10-28 00:25:00','type'=>'moneyline', 'side'=>1,'home'=>'ten','away'=>'jax', 'odds' =>'-110'],
//    ['gameid' => '124','date' =>'2016-10-30 13:30:00','type'=>'moneyline', 'side'=>1,'home'=>'cin','away'=>'was','odds' =>'-110'],
//    ['gameid' => '125','date' =>'2016-10-30 20:25:00','type'=>'over/under', 'side'=>0,'home'=>'atl','away'=>'gb','odds' =>'-110'],
//    ['gameid' => '126','date' =>'2016-10-30 20:05:00','type'=>'spread', 'side'=>0,'home'=>'dal','away'=>'phi','odds' =>'-110'],
//    ['gameid' => '127','date' =>'2016-10-31 00:30:00','type'=>'spread', 'side'=>0,'home'=>'chi','away'=>'min','odds' =>'-110'],
//
//];

//$encoded_output = json_encode($output);
//print($encoded_output);


//json encode the data
$json_encoded_object = json_encode($data);
//print the json encoded object
print($json_encoded_object);
?>