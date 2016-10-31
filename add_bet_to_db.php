<?php
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 10/26/2016
 * Time: 12:14 PM
 */

require_once('mysql_connect.php');
date_default_timezone_set('UTC');

//variables coming in
$user_id = 2;
$game_number = 4;
$bet_amount = 100;

//$type_of_bet = 'spread';            //bet_type = 1
//$type_of_bet = 'moneyline';       //bet_type = 2
$type_of_bet = 'over/under';      //bet_type = 3

//$first_side = true;
$first_side = false;


//variables to be stored for next query
$bet_type; //either 1 for spread, 2 for moneyline, 3 for over/under
$side;  //either 1 for true or 0 for false
$line;  //only necessary for bet_type 1 and 3
$odds;  //dependent on bet_type and first_side

if($type_of_bet === "spread"){
    $bet_type = 1;
    $line = "home_spread";
    if($first_side){
        $odds = "spread_odds_a";
        $side = 1;
    }else{
        $odds = "spread_odds_h";
        $side = 0;
    }
}else if($type_of_bet === "moneyline"){
    $bet_type = 2;
    $line = null;
    if($first_side){
        $odds = "moneyline_odds_a";
        $side = 1;
    }else{
        $odds = "moneyline_odds_h";
        $side = 0;
    }
}else{
    $bet_type = 3;
    $line = "overunder_points";
    if($first_side){
        $odds = "overunder_odds_o";
        $side = 1;
    }else{
        $odds = "overunder_odds_u";
        $side = 0;
    }
}

if ($type_of_bet !== "moneyline") {
    $game_line_query = "SELECT `$line` FROM `games` WHERE ID = '$game_number'";
    $game_line_result = mysqli_query($conn, $game_line_query);
    $data = [];
    if (mysqli_num_rows($game_line_result)) {
        while ($row = mysqli_fetch_assoc($game_line_result)) {
            $data[] = $row;
        }
        $bet_line = $data[0];
        print_r($bet_line);
        $bet_line = $data[0][$line];
    }
}else{
    $bet_line = null;
}
$game_odds_query = "SELECT `$odds` FROM `games` WHERE ID = '$game_number'";
$game_odds_result = mysqli_query($conn, $game_odds_query);
$data = [];
if(mysqli_num_rows($game_odds_result)) {
    while($row = mysqli_fetch_assoc($game_odds_result)){
        $data[] = $row;
    }
    $bet_odds = $data[0];
    print_r($bet_odds);
    $bet_odds = $data[0][$odds];
}
print('<br>');

$bet_query = "INSERT INTO `bets`(`user_id`, `amount`, `game_id`, `bet_type_id`, `side`, `line`, `odds`) VALUES ('$user_id', '$bet_amount', '$game_number', '$bet_type', '$side', '$bet_line', '$bet_odds')";
$bet_result = mysqli_query($conn, $bet_query);
//verification that bet writing worked
print_r(mysqli_affected_rows($conn));

//old but good example for game result
//if(mysqli_num_rows($game_result)) {
//    while($row = mysqli_fetch_assoc($game_result)){
//        $games[] = $row;
//    }
//    print_r($games);
//}
?>