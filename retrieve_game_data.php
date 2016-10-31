<?php
require_once('mysql_connect.php');
date_default_timezone_set('UTC');
//create empty array (of object)
$data = [];
//full data attempt
$game_query = "SELECT a.full_name AS full_name_a, a.abbr_name AS abbr_name_a, a.logo_src AS logo_src_a, h.full_name AS full_name_h, h.abbr_name AS abbr_name_h, h.logo_src AS logo_src_h, g.home_spread, g.spread_odds_a, g.spread_odds_h, g.moneyline_odds_a, g.moneyline_odds_h, g.overunder_points, g.overunder_odds_o, g.overunder_odds_u, g.date FROM `games` AS g JOIN `teams` AS h ON g.team_a_id = h.ID JOIN `teams` AS a ON g.team_H_id = a.ID WHERE g.league_id = 1";
$result = mysqli_query($conn, $game_query);
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
//json encode the data
$json_encoded_object = json_encode($data);
//print the json encoded object
print($json_encoded_object);
?>