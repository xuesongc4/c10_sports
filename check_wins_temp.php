<?php
require_once('mysql_connect.php');
date_default_timezone_set('UTC');
//make function to format the incoming bet

//make query to db to see unresolved bets
$temp_bets_query = "SELECT b.ID, b.user_id, b.amount, b.bet_type_id, b.side, b.line, b.odds, g.final_score_a, g.final_score_h FROM `bets` AS b JOIN `games` AS g ON g.ID = b.game_id WHERE settled = '0'";
$result = mysqli_query($conn, $temp_bets_query);

$data = [];
if(mysqli_num_rows($result)){
    while($rows = mysqli_fetch_assoc($result)){
        $data[] = $rows;
    }
}