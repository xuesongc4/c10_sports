<?php
session_start();
require_once('mysql_connect.php');
require_once('check_wins.php');
date_default_timezone_set('UTC');

$user_id = $_SESSION['ID'];
//$user_id = '1';           //for testing only

$bet_history_query = "SELECT b.amount, b.settled AS bet_status_id, bs.bet_status, a.full_name AS away_team, a.logo_src AS away_logo, h.full_name AS home_team, h.logo_src AS home_logo, g.game_time, g.final_score_a, g.final_score_h, b.bet_type_id, bt.bet_name, b.side, b.line, b.odds, b.time_placed
FROM `bets` AS b
JOIN `games` AS g ON g.ID = b.game_id
JOIN `bet_status` AS bs ON bs.ID = b.settled
JOIN `teams` AS h ON g.team_h_id = h.ID
JOIN `teams` AS a ON g.team_a_id = a.ID
JOIN `bet_types`AS bt ON bt.ID = b.bet_type_id
WHERE b.user_id = '$user_id'
ORDER BY b.time_placed DESC";
//full data attempt
$result = mysqli_query($connection, $bet_history_query);
$data = [];
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)) {
        if($row['bet_status_id'] > 0){
            $row['win_amount'] = check_for_a_win($row['final_score_a'], $row['final_score_h'], $row['amount'], $row['bet_type_id'], $row['side'], $row['odds'], $row['line']);
        }
        $data[] = $row;
    }
}

//json encode the data
$json_encoded_object = json_encode($data);
//print the json encoded object
print($json_encoded_object);
?>