<?php
session_start();
require_once('mysql_connect.php');
date_default_timezone_set('UTC');

////hardcorded constants for testing
//$user_id = '2';             //do i need session variable and user now that this is not generic but specific to user because
//$time_frame = 'current';
//////day one
//$start_day = '2016-11-04 00:00:00';
//$end_day = '2016-11-05 00:00:00';
////second test day
////$start_day = '2016-11-09 00:00:00';
////$end_day = '2016-11-10 00:00:00';
////league
//$league = 'NFL';

//print(json_encode($_POST));     //for testing purposes

$time_frame = $_POST['game_block'];
$start_day = $_POST['start_end']['startDay'];
$end_day = $_POST['start_end']['endDay'];
//collect league from index
$league = $_POST['league'];
//gather user id
$user_id = $_SESSION['ID'];

//lookup the league in league table
$league_query = "SELECT ID FROM `leagues` WHERE league = '$league'";
$result = mysqli_query($connection, $league_query);

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
    $game_query_where_clause = "WHERE g.league_id = '$league_id' AND '$start_day' <= g.game_time AND g.game_time < '$end_day' ";
    $game_query_order_clause = "ORDER BY g.game_time ASC ";
    $game_query_limit_clause = "";
}else if($time_frame === 'future'){
    $game_query_where_clause = "WHERE g.league_id = '$league_id' AND g.game_time >= '$end_day' ";
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
$game_result = mysqli_query($connection, $game_query);

$bets_placed = ['bets_placed'=>['spread'=>'0','moneyline'=>'0','over/under'=>'0']];

if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($game_result)) {
        $data[] = array_merge($row, $bets_placed);
//        $data[] = $row;
    }
}

//run query to see if games were bet on

//separated query clauses for bet
$bet_query_select_clause = "SELECT bt.bet_name, b.game_id, COUNT(b.ID) AS bet_qty ";
$bet_query_from_clause = "FROM `bets` AS b ";
$bet_query_join_clause = "JOIN `bet_types` AS bt ON b.bet_type_id = bt.ID JOIN games as g ON b.game_id = g.ID ";
$bet_query_where_clause = $game_query_where_clause . "AND b.user_id = '$user_id' ";
$bet_query_group_clause = "GROUP by g.ID, b.bet_type_id ";
$bet_query_order_clause = "ORDER BY g.ID, b.bet_type_id";
//concatenate query clauses together
$bet_query = $bet_query_select_clause . $bet_query_from_clause . $bet_query_join_clause . $bet_query_where_clause . $bet_query_group_clause . $bet_query_order_clause;
$bet_results = mysqli_query($connection, $bet_query);

$games_bet = [];
if(mysqli_num_rows($bet_results)){
    //if there are any results see if there are any of the appropriate keys in the result
    $old_game_id = null;
    $this_game = null;
    while($row = mysqli_fetch_assoc($bet_results)){
        if($old_game_id != $row['game_id']){
            $games_bet[$row['game_id']] = $this_game;
            $this_game = [
//                'game_id'=> $row['game_id'],
                'spread'=>0,
                'moneyline'=>0,
                'over/under'=>0
            ];
            $old_game_id = $row['game_id'];
        }
        $this_game[$row['bet_name']] = $row['bet_qty'];
        $games_bet[$row['game_id']] = $this_game;
    }
}
//place the bets_placed into the data for each game
for($i = 0; $i < count($data); $i++) {
    $index = $data[$i]['game_id'];
    if(array_key_exists($index, $games_bet)){
        $data[$i]['bets_placed'] = $games_bet[$index];
    }
    //convert values to true or false
    if($data[$i]['bets_placed']['spread']){
        $data[$i]['bets_placed']['spread'] = 'true';
    }else{
        $data[$i]['bets_placed']['spread'] = 'false';
    }
    if($data[$i]['bets_placed']['moneyline']){
        $data[$i]['bets_placed']['moneyline'] = 'true';
    }else{
        $data[$i]['bets_placed']['moneyline'] = 'false';
    }
    if($data[$i]['bets_placed']['over/under']){
        $data[$i]['bets_placed']['over/under'] = 'true';
    }else{
        $data[$i]['bets_placed']['over/under'] = 'false';
    }
}

//////for testing
//print('<pre>');
//print_r($data);
//print('<br>');
////print_r($games);
//print('</pre>');

//json encode the data
$json_encoded_object = json_encode($data);
//print the json encoded object
print($json_encoded_object);
?>