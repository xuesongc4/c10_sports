<?php
require_once('mysql_connect.php');
date_default_timezone_set('UTC');

//print(json_encode($_POST));     //for testing purposes
$time_frame = $_POST['game_block'];
$start_day = $_POST['start_end']['startDay'];
$end_day = $_POST['start_end']['endDay'];
//collect league from index
$league = $_POST['league'];  //may not need to upper
//lookup the league in league table
$league_query = "SELECT ID FROM `leagues` WHERE league = '$league'";
$result = mysqli_query($connection, $league_query);
//print_r($result);             //for testing
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)) {
        $league_id = $row['ID'];
    }
}

//create empty array (of object)
$data = [];

//static game query clauses
$game_query_select_clause = "SELECT g.ID AS game_id, a.full_name AS full_name_a, a.abbr_name AS abbr_name_a, a.logo_src AS logo_src_a, h.full_name AS full_name_h, h.abbr_name AS abbr_name_h, h.logo_src AS logo_src_h, g.home_spread, g.spread_odds_a, g.spread_odds_h, g.moneyline_odds_a, g.moneyline_odds_h, g.overunder_points, g.overunder_odds_o, g.overunder_odds_u, g.game_time, g.final_score_a, g.final_score_h ";
$game_query_from_clause = "FROM `games` AS g ";
$game_query_join_clause = "JOIN `teams` AS h ON g.team_h_id = h.ID JOIN `teams` AS a ON g.team_a_id = a.ID ";

//conditional to determine dynamic query clauses based on time_frame
if($time_frame === 'current'){
    $game_query_where_clause = "WHERE g.league_id = '$league_id' AND '$start_day' <= g.game_time AND g.game_time <= '$end_day' ";
    $game_query_order_clause = "ORDER BY g.game_time ASC ";
    $game_query_limit_clause = "";
}else if($time_frame === 'future'){
    $game_query_where_clause = "WHERE g.league_id = '$league_id' AND g.game_time > '$end_day' ";
    $game_query_order_clause = "ORDER BY g.game_time ASC ";
    $game_query_limit_clause = "";
}else {
    $game_query_where_clause = "WHERE g.league_id = '$league_id' AND g.game_time < '$start_day' ";
    $game_query_order_clause = "ORDER BY g.game_time DESC ";
    $game_query_limit_clause = "LIMIT 20";
}
//compile query clause
$game_query = $game_query_select_clause . $game_query_from_clause . $game_query_join_clause . $game_query_where_clause . $game_query_order_clause . $game_query_limit_clause;
//query the db
$result = mysqli_query($connection, $game_query);

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